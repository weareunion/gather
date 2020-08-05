<?php


namespace Union\API\communications\external;

use Twilio\Rest\Client;

require_once __DIR__ . "/../../libs/twilio/authentication/keys.php";
require_once __DIR__ . "/../../libs/twilio/numbers/numbers.php";
require_once __DIR__ . "/../../libs/twilio/twilio-php-master/Twilio/autoload.php";

class SMS
{
    public $number_to;
    public $body;
    function set_body($content){
        $this->body = $content;
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
                    "from" => "+18645019952"
                )
            );
    }
}