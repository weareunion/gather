<?php


namespace Union\API\Cards\Issuing;


use Union\API\Cards\GiftCard;
use Union\API\communications\external\SMS;
use Union\Exceptions\DisabledIssueOnTypeException;
use Union\Exceptions\InvalidIssueOnTypeException;
use Union\PKG\Autoloader;

class GiftCardIssuing
{
    public static $possible_on_type_states = [
        "phone_number" => [
            "status" => "OK",
            "display_name" => "Phone Number",
        ], "email" => [
            "status" => "disabled",
            "display_name" => "Email Address",
        ], "account_id" => [
            "status" => "disabled",
            "display_name" => "Slately Account"
        ]
    ];
    public static function quick_issue( float $amount, string $payment_method, string $on, string $type = 'phone_number', array $payment_attributes = []): array{

        //Check if method of issuing is valid
        if (!array_key_exists($type, self::$possible_on_type_states)){
            throw new InvalidIssueOnTypeException(
                "The issue type of $type is not supported",
                "",
                "Contact method currently not supported.",
                "Unfortunately, this method of issuing a card is not supported. Please try another contact method.");
        }

        // Check if the method is enabled
        if (self::$possible_on_type_states[$type]['status'] === 'disabled'){
            throw new DisabledIssueOnTypeException(
                "The issue type of $type is not enabled at this time.",
                "",
                "This method has been temporarily disabled",
                "Using a ".self::$possible_on_type_states[$type]['display_name']." to issue a card has been disabled for the time being.");
        }

        $status_tree = [];

            Autoloader::import__require("API.cards");
            // Create actual gift card object
            $card = new GiftCard();
            $card->create();

            // Create contingency code
            $contingency = $card->create_contingency();

            // Set amount
            $card->reset_amount($amount, "Initial set of amount", $payment_method);

            $status_tree['client_message_sent'] = true;

            // Issue a backup pin
            $backup_pin = $card->security->authentication->issue_backup_pin();

            try {
                switch ($type) {
                    case "phone_number":
                        Autoloader::import__require("API.communications.external.SMS");

                        // Send user messages
                        $text = new SMS();
                        $text->set_to_number($on);
                        $text->set_body("Hey! Your Gift Card has arrived! Click the link to activate it! " . $card->get_URL());
                        $text->send();

                        // Issue and send backup pin message
                        $text = new SMS();
                        $text->set_to_number($on);
                        $text->set_body("Your backup pin is " . $backup_pin . ". If you forget your pin, or your login this is your only way to recover it. Make note of it somewhere safe.");
                        $text->send();
                        break;
                }
            }catch (\Exception $e){
                $status_tree['client_message_sent'] = false;
            }
            $status_tree['card_contingency_id'] = $card->properties->contingency_id;
            $status_tree['card_access_URL'] = $card->get_URL();
            $status_tree['backup_pin'] = $backup_pin;
            return $status_tree;
    }
}