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

/**
 * A Card of type Gift Card
 * Class GiftCard
 * @package Union\API\Cards
 */
class GiftCard extends Card {

    // Transactions waiting to be executed
    /**
     * @var array
     */
    public $awaiting_transactions;

    /**
     * GiftCard constructor.
     * @param null $id
     * @throws \Union\Exceptions\TransactionAccountCreationFailure
     * @throws \Union\Exceptions\Unauthorized
     */
    public function __construct( $id=null){
        parent::__construct($id);
        if ($id === null) {
            $this->properties->type = 'balance_card';
            $this->properties->amount_current = -1;
            $this->properties->amount_start = -1;
        }else{
            // Get card balance
            $this->update_card_balance();
        }
        $this->awaiting_transactions = [];
    }

    /**
     * Reset the card amount legally
     * @param $amount double The amount that the account should be set to
     * @param $description string An authorization string
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws \Union\Exceptions\Unauthorized Thrown if account is not authorized to do this transaction or if the user is not logged in.
     */
    public function reset_amount( $amount, $description): void
    {

        // Create new transaction
        $this->properties->amount_current = $amount;
        $this->properties->amount_start = $amount;
        $transaction = new Transaction();
        $transaction->set_destination((new Account($this->properties->card_id)));
        $transaction->set_amount($amount);
        $transaction->set_type('set');
        $transaction->description = $description;

        // Add transaction to list
        $this->awaiting_transactions[] = $transaction;
    }


    // Over loaded methods helper methods

    /**
     * Forces a transaction account to be created
     * @throws CardTransactionAccountCreationFailure Transaction accounts are created using this method. This class is unusable without this helper infrastructure.
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Will Throw the exception CardTransactionAccountCreationFailure
     * @throws \Union\Exceptions\Unauthorized Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function create_transaction_account(): void
    {
        // Ensure that card_id is set
        if (!isset($this->properties->card_id)){
            throw new CardTransactionAccountCreationFailure("Transaction account could not be created due to an account id not specified. Use load() or create() first.");
        }
        // Create new Transaction account if it does not alrady exist
        $account = new Account($this->properties->card_id, false, 'balance_card');
        $account->set_isCard(true);
    }

    /**
     * Attempts to execute the awaiting transactions and will update the object upon completion
     * @throws \Union\Exceptions\AccountLocked Will throw this exception if the account is locked
     * @throws \Union\Exceptions\InsufficientFunds Will throw this exception if the amount of funds is insufficient to the transaction amount
     * @throws \Union\Exceptions\InvalidTransaction A general syntax error
     * @throws \Union\Exceptions\TransactionAlreadyExists Will throw this exception if the transaction already exists
     * @throws \Union\Exceptions\Unauthorized|\Union\Exceptions\TransactionAccountCreationFailure Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function update_transaction_account(){
        // Execute every waiting transaction
        foreach ($this->awaiting_transactions as $transaction)
            TransactionManager::post($transaction);

        // Clear transactions
        $this->awaiting_transactions = [];

        // Update the card balance
        $this->update_card_balance();
    }

    /**
     * Updates the card balance from the transactional record
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws \Union\Exceptions\Unauthorized Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function update_card_balance(){
        // Update card balance from account balance
        $this->properties->amount_current = (new Account($this->properties->card_id))->get_balance();
    }

    // Overloaded methods

    /**
     * Creates framework for a new card of type gift card
     * @throws CardAlreadyExistsException Thrown if the card already exists
     * @throws CardTransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws ImproperCardTypeException Thrown if the card type is incorrect
     * @throws IncompleteCardException Thrown when there are parameters missing
     * @throws UnknownCardException Thrown if the card is unknown (should never throw using this method)
     * @throws \Union\Exceptions\TransactionAccountCreationFailure Transaction accounts are created when they are needed. If there is some sort of error with it, this exception will be thrown. This is a fatal error and all processes should be aborted.
     * @throws \Union\Exceptions\Unauthorized Thrown if the account is not authorized to do this transaction or if the user is not logged in.
     */
    public function create(): void{
        // Check the proper type
        if ($this->properties->type !== 'balance_card'){
            throw new ImproperCardTypeException("The card type '".$this->properties->type."' is not supported by this class.");
        }
        if (!isset($this->properties->amount_start, $this->properties->amount_current)){
            throw new IncompleteCardException("Not all parameters were provided.");
        }

        parent::create();
        $this->create_transaction_account();
    }

    /**
     * Load from an ID
     * @param $id string ID to load object from
     */
    public function load( $id){
        $res = parent::load($id);
        $this->update_transaction_account();
        return $res;
    }

    /**
     * Update the card object from the according databases
     */
    public function update(): void{
        $this->update_transaction_account();
        parent::update();
    }

}

// Helper Classes for Card Parent Class

/**
 * Class Lockdown
 * @package Union\API\Cards
 */
class Lockdown {
    private $properties;
    private $parent;

    /**
     * Lockdown constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        $this->properties = $properties;
        $this->parent = $parent;
    }

    /**
     * Lock down card and transaction account
     * @param $reason string Reason that the card was locked_reason
     * @param null $origin The origin of the lock
     * @throws CardDoesNotExistException Throws if the card does not exist
     * @throws \Union\Exceptions\Unauthorized Throws if the user is not authorized to do this action.
     */
    public function lockdown( $reason, $origin = null): void
    {
        // Ignore if transaction account cannot be created
        try {
            ( new Account($this->properties->card_id) )->lock($reason);
        }catch (TransactionAccountCreationFailure $e) {}
        $this->properties->lockdown->active = true;
        $this->properties->lockdown->reason = $reason;
        $this->properties->lockdown->origin = $origin;
        $this->parent->update();
    }

    /**
     * Unlock the card and transaction account. Keep in mind that the reason that the card might
     * have been locked in the first place might have not been resolved
     * @throws CardDoesNotExistException Throws if the card does not exist
     * @throws \Union\Exceptions\Unauthorized Throw an exception if the user is not authorized to do this action
     */
    public function unlock(): void
    {
        try {
            ( new Account($this->properties->card_id) )->unlock();
        }catch (TransactionAccountCreationFailure $e) {}
        $this->properties->lockdown->active = false;
        $this->parent->update();
    }
}

/**
 * Class Authentication
 *
 * This class is used to authenticate (or unlock) the card for use. This class
 * is NOT responsible for transaction validation and authentication
 *
 * @package Union\API\Cards
 */
class Authentication {
    /**
     * @var
     */
    public $parent;
    private $properties;

    /**
     * Authentication constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        $this->properties = $properties;
        $this->parent = $parent;
    }

    /**-------------SESSION AUTHENTICATION METHODS-------------**/


    /**
     * Authenticate the current card and bind it to the current session.
     * If no pin number is supplied, use the current session. If none of these methods work,
     * the method will throw a CardAuthenticationFailure exception.
     *
     * @param null $pin If this parameter is set, then the method will attempt to use the pin authentication method.
     * @throws CardAuthenticationFailure Thrown if all possible authentication methods have been exhausted.
     */
    public function authenticate($pin=null){
        if ($pin !== null && !$this->pin_validate($pin)){
            throw new CardAuthenticationFailure(
                "Supplied PIN does not match records.",
                "",
                "Incorrect Code",
                "It seems like the code you entered does not match our records.
                 You can enter in the recovery code that you recived upon the activation of your card.");
        }
        if ($pin === null && !$this->current_account_authenticated()){
            throw new CardAuthenticationFailure(
                "The current account is not linked to this card.",
                "",
                "The ",
                "It seems like your account is not linked to this card.
                 You can enter in the recovery code that you recived upon the activation of your card to revert this change.");
        }

        // ------ Begin Session Auth -----

        // Get activated cards
        $exsts = Session::get_current_session()->get("API.cards.session.active");

        // Check if any activated cards already exist
        if ($exsts === null) {
            $exsts = [];
        }

        // Add card ID
        $exsts[] = $this->properties->card_id;

        // Add to session
        Session::get_current_session()->set("API.cards.session.active", $exsts);
    }

    /**
     * Check if current card is authenticated for session
     * @return bool returns true if authenticated for the current session
     */
    public function is_authenticated(){
        // Get activated cards
        $exsts = Session::get_current_session()->get("API.cards.session.active");

        // If none are registered, return false
        if ($exsts === null) return false;

        // For every key that is registered, check if there is a registration
        foreach ($exsts as $key) if ($key === $this->properties->card_id) return true;

        // Otherwise, return false
        return false;
    }

    /**
     * Removes current card from authentication list
     */
    public function deauthenticate(){
        // Get activated cards
        $exsts = Session::get_current_session()->get("API.cards.session.active");

        // If none are registered, return
        if ($exsts === null) return;

        // For every key that is registered, check if there is a registration
        foreach ($exsts as &$key)
            // If the key is found, remove it from the registration list
            if ($key === $this->properties->card_id) {
            unset($key);
            return;
            }
    }

    /**-------------PIN NUMBER AUTHENTICATION METHODS-------------**/

    private function generate_pin(){
        return str_pad(random_int(0,9999), 8, '0', STR_PAD_LEFT);
    }

    public function pin_attach($pin){

    }

    public function pin_validate($pin): bool{

    }

    public function pin_revoke($pin){

    }

    public function pin_change($pin){

    }

    /**
     * Generates and sets a backup authentication PIN for the card.
     * @return string Generated backup pin
     * @throws CardDoesNotExistException Throws if the card does not exist
     */
    public function issue_backup_pin(){
        // Generate pin
        $backup_pin = $this->generate_pin();

        // Generate random salt
        $bytes = random_bytes(32);
        $salt = bin2hex($bytes);

        // Add to properties list
        $this->properties->security->authentication->methods->pin->recovery->pin_SHA = password_hash($backup_pin.$salt, PASSWORD_DEFAULT);
        $this->properties->security->authentication->methods->pin->recovery->pin_SHA_salt = $salt;

        // Push update
        $this->parent->update();

        return $backup_pin;
    }

    /**-------------ACCOUNT AUTHENTICATION METHODS-------------**/

    public function current_account_authenticated(): bool{

    }

    public function link_account($account_id=null){

    }

    public function unlink_account($account_id=null){

    }

}

/**
 * Class Authorization
 * @package Union\API\Cards
 */
class Authorization {
    /**
     * @var
     */
    public $parent;

    /**
     * Authorization constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, Card $parent)
    {

    }

}

/**
 * Class Validity
 * @package Union\API\Cards
 */
class Validity {
    /**
     * @var
     */
    public $parent;

    /**
     * Validity constructor.
     * @param $properties
     * @param $parent
     */
    public function __construct( &$properties, &$parent)
    {

    }
}

/**
 * Class Security
 * @package Union\API\Cards
 */
class Security  {
    /**
     * Object to manage structure
     * @var
     */
    public $parent;
    /**
     * Object to manage structure
     * @var Lockdown
     */
    public $lockdown;
    /**
     * Object to manage structure
     * @var Authentication
     */
    public $authentication;
    /**
     * Object to manage structure
     * @var Authorization
     */
    public $authorization;
    /**
     * Object to manage structure
     * @var Validity
     */
    public $validity;

    /**
     * Security constructor.
     * @param $properties
     * @param Card $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        // create helper classes
       $this->lockdown = new Lockdown($properties, $parent);
       $this->authentication = new Authentication($properties, $parent);
       $this->authorization = new Authorization($properties, $parent);
       $this->validity = new Validity($properties, $parent);
    }
}

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
                        'linked_on' => ''
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
                'SHA_credential' => '',
                'SHA_salt' => ''
            ],
            // Card validity
            'validity' => [
                'validity_start' => '',
                'validity_end' => '',
                'activated_on' => '',
                'expires_if_not_activated_after' => '',
                'card_created_on' => ''
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
     * Load and inject card from the storage infrastructure
     * @param $id string ID to load
     * @return false|mixed Returns the header of the cards properties
     */
    function load( $id)
    {
        // Check if ID exists
        $record = self::static_exists($id);
        if (!$record) {
            return false;
        }
        // if so, return and install the record
        $this->properties = $record[0];
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

}
