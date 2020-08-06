<?php

\Union\PKG\Autoloader::import__require("API.managers.mysql");
class Card
{
    public $card_type, $sequence, $card_code, $account_id, $group_id, $card_active_on, $card_expiry, $balance, $balance_type, $active, $invalidation_message, $email_association, $phone_number_association;

    function __construct($card_code)
    {
        $this->open($card_code);
    }

    /**
     * Creates the framework for a card in the database
     *
     * @param string $type Type of card. 'gift', 'rewards', 'id', 'admin'
     * @return Card Card object.
     * @throws CardCreation Exception Row could not be inserted
     * @throws TooManyLoops Exception Too many loops during duplicate check. Assume broken.
     */
    static function create($type='gift', $card_number="NS"){
        $connection = new \Moycroft\API\internal\mysql\Connect();
        $connection->connect();
        \Union\Grooped\gameserver\logging\Log::message("Adding new card framework to database...");

        // Generate Card Number if card number not forced
        $card_number_fixed = false;
        if ($card_number == "NS"){
            $card_number = "G359022178";
        }else{
            $card_number_fixed = true;
        }

        // Assume the ID card has already been used. If true, find another.
        $invalid_card_number = true;
        // If loops for too many times, assume that there is something broken and throw.
        $pass_catchfall = 0;

        // Run check
        while ($invalid_card_number){
            if (sizeof($connection->query("SELECT * FROM gather.`gather-known_cards` WHERE card_code = '$card_number'", true)) == 0){
                $invalid_card_number = false;
                break 1;
            }else{
                if ($card_number_fixed){
                    throw new CardNumberTaken("Card Number has already been taken", 10015, "Card number has already been created.");
                }
                $card_number = "". strtoupper($type)[0] . rand(100000000,999999999);
            }
            if ($pass_catchfall > 40){
                throw new TooManyLoops("Loop threshold exceeded while trying to find a card id. Terminating to save thread.", 10011, "Unfortunately, the card was not created. Please contact support.");
            }
            $pass_catchfall++;
        }

        // Add card to database
        if (!$connection->query("INSERT INTO gather.`gather-known_cards` (card_code, card_type, card_active_on) VALUES ('$card_number', '$type', CURRENT_TIMESTAMP)")){
            throw new CardCreation("Row addition failed due to an unknown error.", 10012, "Unfortunately, the card was not created. Please contact support.");
        }

        return (new Card($card_number));
    }

    function open($card_code){
        return 0;
    }
}
