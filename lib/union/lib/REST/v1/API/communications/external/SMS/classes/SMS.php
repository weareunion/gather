<?php


namespace Union\API\communications\external;

use Twilio\Rest\Client;
use Union\API\accounts\Account;
use Union\PKG\Autoloader;

require_once __DIR__ . "/../../libs/twilio/authentication/keys.php";
require_once __DIR__ . "/../../libs/twilio/numbers/numbers.php";
require_once __DIR__ . "/../../libs/twilio/twilio-php-master/Twilio/autoload.php";

Autoloader::import__require("API.accounts");

class SMS
{
    public $number_to;
    public $body;
    function set_body($content){
        $this->body = $content;
    }
    function set_to($account){
        // Check if account exists
        if (!Account::account_exists($account)) return false;
        $this->number_to = Account::get_phone_number($account);
        return true;
    }
    function set_to_number($number){
        $this->number_to = $number;
    }
    function send()
    {
        $twilio = new Client(COMMS_TWILIO_KEYS_ACCOUNT_SID_PUBLIC, COMMS_TWILIO_KEYS_ACCOUNT_TOKEN_PRIVATE);

        $message = $twilio->messages
            ->create("+1" . $this->number_to, // to
                array(
                    "body" => $this->body,
                    "from" =>  COMMS_TWILIO_NUMBERS['standard']
                )
            );
    }
}