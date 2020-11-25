<?php
namespace Union\API\Cards;
use MongoDB\Collection;
use MongoDB\Database;
use Union\API\managers\GUID;
use Union\API\managers\mongo\connect;
use Union\API\transactions\Account;
use Union\API\transactions\Transaction;
use Union\API\transactions\TransactionManager;
use Union\Exceptions\CardAlreadyExistsException;
use Union\Exceptions\CardAuthenticationFailure;
use Union\Exceptions\CardDoesNotExistException;
use Union\Exceptions\CardTransactionAccountCreationFailure;
use Union\Exceptions\ImproperCardTypeException;
use Union\Exceptions\IncompleteCardException;
use Union\Exceptions\TransactionAccountCreationFailure;
use Union\Exceptions\UnknownCardException;
use Union\session\Session;

\Union\PKG\Autoloader::import__require("API.managers.mongo");
\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.transactions");
\Union\PKG\Autoloader::import__require("API.managers");
\Union\PKG\Autoloader::import__require("API.communications");
\Union\PKG\Autoloader::import__require("API.sessions");

// Import GiftCard Extension

require_once __DIR__ . '/../stack/extensions/GiftCard.php';

// Helper Layers for Card Parent Class
require_once __DIR__ . '/../stack/layers/security/_classes/Security.php';



/**
 * Class Card
 * @package Union\API\Cards
 */
class Card
{
    /**
     * Default constructor and values of properties
     * @var array
     */
    public $defaults = [
        'type' => '',
//        Balance card / Event Card:
//        'balance' => [
//          'amount_start' => 0,
//          'amount_current' => 0,
//         ]
//        ID Card:
//        account_id => '[GUID]'

//        Event Ticket:
//        event_id => '[GUID]'
        'card_id' => '',
        // Shown to the user. Lookup ID
        'contingency_id' => '',
        'security' => [
            // Lock down card from being used
            'lockdown' => [
                'active' => false,
                'reason' => '',
                'origin' => null
            ],
            // Authentication types
            'authentication' => [
                // Authentication methods
                'methods' => [
                    'account' => [
                        'account_linked' => false,
                        'account_id' => '',
                        'changed_on' => ''
                    ],
                    // If account has not been linked, use a pin method
                    'pin' => [
                        'pin_SHA' => '',
                        'pin_SHA_salt' => '',
                        'recovery' => [
                            'phone_number' => '',
                            'email' => '',
                            'pin_SHA' => '',
                            'pin_SHA_salt' => '',
                        ]
                    ]
                ]
            ],
            'authorization' => [
                'SHA_credential_set' => []
            ],
            // Card validity
            'validity' => [
                'validity_start' => null,
                'validity_end' => null,
                'activated_on' => null,
                'expires_if_not_activated_after' => null,
                'card_created_on' => null
            ]
        ]

    ];
    /**
     * general properties
     * @var mixed
     */
    public $properties;
    /**
     * Security object
     * @var Security
     */
    public $security;
    /**
     * Database connection
     * @var \MongoDB\Client
     */
    public $db;

    /**
     * Card constructor.
     * @param null $id
     */
    public function __construct( $id=null){
        // Set up defaults
        $this->properties = json_decode(json_encode($this->defaults, JSON_THROW_ON_ERROR), FALSE, 512, JSON_THROW_ON_ERROR);

        // Create database
        $this->db = connect::get_obj();

        // Overload if exists
        $this->load($id);

        // Create Objects
        $this->security = new Security($this->properties->security, $this);
    }


    /**
     * OOP version to check if exists
     * @param null $id string card to check
     * @return array|bool returns records if found
     */
    public function exists( $id=null){
        if ($id === null){
            $id = $this->properties->card_id;
        }
        return $this->static_exists($id);
    }

    /**
     * Static version to check if a card exists
     * @param $id string card to check
     * @param false $return_bool return records if found
     * @return array|bool returns records if found
     */
    public static function static_exists( $id, $return_bool=false){
        // Try to find in bucket
        $records = connect::get_obj()->slately->cards->find(
            [
                'card_id' => $id
            ]
        );
        $records = $records->toArray();
        if (count($records) === 0) {
            return false;
        }
        if ($return_bool) return true;
        return $records;
    }

    /**
     * Static version to check if a card exists based on contingency id
     * @param $id string contingency id of card to check
     * @param false $return_bool return records if found
     * @return array|bool returns records if found
     */
    public static function static_exists_contingency( $id, $return_bool=false){
        // Try to find in bucket
        $records = connect::get_obj()->slately->cards->find(
            [
                'contingency_id' => $id
            ]
        );
        $records = $records->toArray();
        if (count($records) === 0) {
            return false;
        }
        if ($return_bool) return true;
        return $records;
    }

    /**
     * Load and inject card from the storage infrastructure
     * @param $id string ID to load
     * @return false|mixed Returns the header of the cards properties
     */
    public function load( $id )
    {
        // Check if ID exists
        $record = self::static_exists($id);
        if (!$record) {
            return false;
        }
        // if so, return and install the record
        return $this->load_from_document($record[0]);
    }

    /**
     * Load and inject card from the storage infrastructure based on contingency id
     * @param $id string ID to load
     * @return false|mixed Returns the header of the cards properties
     */
    public function load_contingency( $id )
    {
        // Check if ID exists
        $record = self::static_exists_contingency($id);
        if (!$record) {
            return false;
        }
        // if so, return and install the record
        return $this->load_from_document($record[0]);
    }

    protected function load_from_document($document){
        // if so, return and install the record
        $this->properties = $document;
        return $this->properties;
    }

    /**
     * Creates a new card in the respective infrastructure
     * @throws CardAlreadyExistsException Thrown if the card already exists
     * @throws UnknownCardException An unknown error occurred
     */
    protected function create(){
        // Check if the card already exists
        if ($this->exists()){
            throw new CardAlreadyExistsException("A card with the ID '".$this->properties->card_id."' already exists. ");
        }

        // Assign card ID
        $this->properties->card_id = GUID::generate();

        // Add record to DB
        $this->db->slately->cards->insertOne($this->properties);

        // Create contingency code
        $this->create_contingency(false);

        // Set up Security
        $this->security->create();

        // Verify record exists
        if (!$this->exists()){
            throw new UnknownCardException(
                "The card could not be created. Database did not pick up record",
            "",
            "Whoops! We couldn't create the card due to an unknown error.");
        }
    }


    /**
     * Update the Card
     * @throws CardDoesNotExistException Throw if the card does not exist
     */
    function update(){

        if (!$this->exists()){
            throw new CardDoesNotExistException("This card(".$this->properties->card_id.") cannot be updated because it does not exist.");
        }

        // Replace record
        $this->db->slately->cards->replaceOne(
            ["card_id" => $this->properties->card_id],
            $this->properties
        );
    }

    /**
     * Creates contingency string to be looked up from
     * @param bool $update Updates the card in the database if true
     * @return string
     * @throws CardDoesNotExistException
     */
    public function create_contingency($update = true): string
    {
        do {
            //Generate crypto using security salt function
            $string = $this->security->authentication->generate_crypto_string(6);
        }while(Card::static_exists_contingency($string));

        // Set string
        $this->properties->contingency_id = $string;

        // Update card
        $this->update();

        return $string;
    }

}
