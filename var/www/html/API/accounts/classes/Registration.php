<?php


namespace Union\API\accounts;


use Moycroft\API\internal\mysql\Connect;
use Union\API\communications\external\SMS;
use Union\API\managers\GUID;

class Registration
{
    static function add_to_registration($name_first, $name_last, $phone_number, $email_address, $password){
        // Clean input strings
        $phone_number = preg_replace('/[^0-9.]+/', '', $phone_number);
        $email_address = Account::clean_string($email_address);
        $name_first = preg_replace("/[^a-zA-Z0-9-]/","", $name_first);
        $name_last = preg_replace("/[^a-zA-Z0-9-]/", "",$name_last);
        // Validate E-Mail
        if ($email_address != null && !filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            throw new \InvalidParams(
                "Invalid Email Address",
                "The supplied email is not valid.",
                "Whoops! That doesn't look like a valid email address.",
                "The email does not seem like it is a valid email address. Please try again",
                false,
                1012110);
        }
        if(!(strlen((string)$phone_number) == 10
            || strlen((string)$phone_number) == 11)) {
            throw new \InvalidParams(
                "Invalid Phone Number",
                "The supplied phone number is not valid.",
                "Whoops! That doesn't look like a valid phone number. $phone_number",
                "The email does not seem like it is a valid phone number. Please try again",
                false,
                1012110);
        }
        if(trim($password) == "" || trim($password) == null) {
            throw new \InvalidParams(
                "Missing Password",
                "The supplied password is not valid.",
                "Whoops! That doesn't look like a valid password.",
                "The email does not seem like it is a Password. Please try again",
                false,
                1012110);
        }
        if(trim($name_first) == "" || trim($name_first) == null ||
            trim($name_last) == "" || trim($name_last) == null) {
            throw new \InvalidParams(
                "Missing Name",
                "The supplied name is not valid.",
                "Whoops! That doesn't look like a valid name.",
                "The email does not seem like it is a name. Please try again",
                false,
                1012110);
        }



        // Check if there is at least a phone number or email address
        if ($phone_number == null && $email_address == null){
            throw new \InvalidParams("Invalid Parameters",
                "A phone number or email is required.",
                null,
                null,
                true,
                1012120);
        }
        if (Account::lookup_phone_number($phone_number)){
            throw new \AccountAlreadyExists(
                "Account already exists with this phone number",
                "",
                "It seems like there is already an account with this phone number!",
                "You can sign in here: {{SIGNIN}}",
                false,
                2011000);
        }
        if (Account::lookup_email($email_address)){
            throw new \AccountAlreadyExists(
                "Account already exists with this email",
                "",
                "It seems like there is already an account with this Email address!",
                "You can sign in here: {{SIGNIN}}",
                false,
                2011000);
        }
        if (self::is_in_registration($phone_number, $email_address)){
            return ["status" => "already_in"];
        }
        $password = Account::hash_password($password);
        $guid = GUID::generate();
        try {
            $connection = new Connect();
            $connection->connect();
            $result = $connection->query("INSERT INTO `gather-accounts-registration_holding` (
                                                    account_phone_number,
                                                    account_email,
                                                    account_name_first,
                                                    account_name_last,
                                                    password_hashed,
                                                    added_on,
                                                    guid
                                                    ) VALUE (
                                                        '$phone_number',
                                                        '$email_address',
                                                        '$name_first',
                                                        '$name_last',
                                                        '$password',
                                                        NOW(),
                                                        '$guid'
                                                    )");
            $connection->disconnect();
            self::send_confirmation_sms($phone_number);
            self::send_conformation_email($email_address, $name_first);
        }catch (\Exception $exception){
            throw new \DatabaseInsertionError("Failed to update account to database during account linking. Exception caught.",
                "SQL Query failed and caught in an exception: '$exception'.",
                null,
                null,
                false,
                1011230);
        }
        return ["status" => "OK", "identification" => $guid];
    }
    static function is_in_registration($phone_number=null, $email=null){
        $connect = new Connect();
        $connect->connect();
        $phone_number = ($phone_number != null) ? ($connect->cleanString(preg_replace("/[^0-9]/", "", $phone_number))) : null;
        $email = ($email != null) ? ($connect->cleanString($email)) : null;

        if ($phone_number !== null){
            $return = $connect->query("SELECT * FROM `gather-accounts-registration_holding` WHERE account_phone_number='$phone_number'", true);
            if (sizeof($return) != 0){
                return [
                    'verified' => [
                        'phone' => [
                            'status' => ($return[0]['verification_phone_number'] == 1),
                            'target' => self::obfuscate_phone($return[0]['account_phone_number'])
                        ],
                        'email' => [
                            'status' => ($return[0]['verification_email'] == 1),
                            'target' => self::obfuscate_email($return[0]['account_email'])
                        ],
                    ],
                    'info' => [
                        'name' => $return[0]['account_name_first']
                    ],
                    'identifier' => $return[0]['guid']
                ];
            }
        }
        if ($email !== null){
            $return = $connect->query("SELECT * FROM `gather-accounts-registration_holding` WHERE account_email='$email'", true);
            if (sizeof($return) != 0){
                return [
                    'verified' => [
                        'phone' => [
                            'status' => ($return[0]['verification_phone_number'] == 1),
                            'target' => self::obfuscate_phone( $return[0]['account_phone_number'])
                        ],
                        'email' => [
                            'status' => ($return[0]['verification_email'] == 1),
                            'target' => self::obfuscate_email($return[0]['account_email'])
                        ],
                        'info' => [
                            'name' => $return[0]['account_name_first']
                        ]
                    ],
                    'identifier' => $return[0]['guid']
                ];
            }
        }
        return false;
    }

    static function activate($GUID){
        $database = Registration::getRegistrarData($GUID);
        if (!$database){
            throw new \InvalidParams(
                "Missing Parameters",
                "",
                "Invalid Request",
                "The request that was sent is invalid.",
                false,
                1001);
        }
        if ($database[0]['verification_phone_number'] == 0 || $database[0]['verification_email'] == 0){
            throw new \AccountActivationException(
                "Not all params have been confirmed",
                "Phone number and or email have not been confirmed",
                "You have not confirmed both your email and your phone number yet",
                "",
                false
            );
        }
        Account::create($database[0]['account_name_first'],
            $database[0]['account_name_last'],
            $database[0]['account_phone_number'],
            $database[0]['account_email'],
            $database[0]['password_hashed'],
            true);
        $connection = new Connect();
        $connection->connect();
        $connection->query("DELETE FROM `gather-accounts-registration_holding` WHERE guid='$GUID'");
        $connection->disconnect();
        return true;
    }
    static function send_confirmation_sms($number){
        $number = preg_replace('/[^0-9.]+/', '', $number);
        if(!(strlen((string)$number) == 10
            || strlen((string)$number) == 11)) {
            throw new \InvalidParams(
                "Invalid Phone Number",
                "The supplied phone number is not valid.",
                "Whoops! That doesn't look like a valid phone number. $number",
                "The email does not seem like it is a valid phone number. Please try again",
                false,
                1012110);
        }
        if (!self::is_in_registration($number)){
            throw new \AccountAlreadyExists(
                "Confirmation attempted to be sent before being in registrar",
                "",
                "",
                "",
                true,
                2011000);
        }
        $connection = new Connect();
        $connection->connect();
        if (sizeof($connection->query("SELECT * FROM `gather-accounts-registration_holding` where TIMESTAMPDIFF( SECOND , last_sms_sent, NOW()) < 60 and account_phone_number = '$number'", true)) > 0){
            throw new \APIException("Too many requests too quickly", null, "You must wait 60 seconds before you can request again.", "", false);
        }
        $connection->query("UPDATE `gather-accounts-registration_holding` SET last_sms_sent=NOW() WHERE account_phone_number='$number'");
        $SMS = new SMS();
        $SMS->set_to_number($number);
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $confirmation_hash = urlencode(password_hash("CONFIRM".$number, PASSWORD_BCRYPT));
        $number = urlencode(base64_encode($number));
        $append = "?wakeRespondus=false&action=accountAspectValidation&type=phone&target=$number&validation=$confirmation_hash";
        $SMS->set_body("Hey! Thanks for joining Slately 🥳! To confirm this phone number, this link $actual_link$append");
        $SMS->send();
    }

    static function send_conformation_email($email, $name){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidParams(
                "Invalid Phone Number",
                "The supplied email is not valid.",
                "Whoops! That doesn't look like a valid email. $email",
                "The email does not seem like it is a valid phone number. Please try again",
                false,
                1012110);
        }
        if (!self::is_in_registration(null, $email)){
            throw new \AccountAlreadyExists(
                "Confirmation attempted to be sent before being in registrar",
                "",
                "",
                "",
                true,
                2011000);
        }
        $email_standard = $email;
        $connection = new Connect();
        $connection->connect();
        $connection->query("UPDATE `gather-accounts-registration_holding` SET last_email_sent=NOW() WHERE account_email='$email' and account_email = '$email_standard'");
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $confirmation_hash = urlencode(password_hash("CONFIRM".$email, PASSWORD_BCRYPT));
        $email = urlencode(base64_encode($email));
        $append = "?wakeRespondus=false&action=accountAspectValidation&type=email&target=$email&validation=$confirmation_hash";
            $email_obj = new \Union\API\communications\external\email\outgoing\Email();
            $email_obj->set_from("2fa_setup", "Slately Account Confirmation");
            $email_obj->set_to($email_standard, $name);
            $email_obj->set_subject("Test");
            $email_obj->set_template_id("d-5a91f4566be64192ba1bbd41417f5944");
            $email_obj->set_options(['name_first' => $name, 'confirm_link' => $actual_link.$append]);
            echo "gg";
            var_dump($email_obj->send());

    }

    static function confirm_number($number, $validation_hash){
        $number = preg_replace('/[^0-9.]+/', '', $number);
        if(!(strlen((string)$number) == 10
            || strlen((string)$number) == 11)) {
//            echo "Invalid Phone Number $number";
            return false;
        }
        if (!self::is_in_registration($number)){
            echo "Not Found";
            return false;
        }
        if (!password_verify( "CONFIRM".$number, $validation_hash)){
            echo "hash Failed ";
            return false;
        }
        $connection = new Connect();
        $connection->connect();
        $connection->query("UPDATE `gather-accounts-registration_holding` SET verification_phone_number='1' WHERE account_phone_number='$number'");
        self::attemptActivation();
        return true;
    }

    static function confirm_email($email, $validation_hash){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidParams(
                "Invalid Phone Number",
                "The supplied email is not valid.",
                "Whoops! That doesn't look like a valid email. $email",
                "The email does not seem like it is a valid phone number. Please try again",
                false,
                1012110);
        }
        if (!self::is_in_registration(null, $email)){
            throw new \AccountAlreadyExists(
                "Confirmation attempted to be confirmed before being in registrar",
                "",
                "",
                "",
                true,
                2011000);
        }
        if (!password_verify( "CONFIRM".$email, $validation_hash)){
            echo "hash Failed ";
            return false;
        }
        $connection = new Connect();
        $connection->connect();
        $connection->query("UPDATE `gather-accounts-registration_holding` SET verification_email='1' WHERE account_email='$email'");
        self::attemptActivation();
        return true;
    }

    static function getRegistrarData($GUID){
        $connection = new Connect();
        $connection->connect();
        $data = $connection->query("SELECT * FROM `gather-accounts-registration_holding` WHERE guid = '$GUID'", true);
        if (sizeof($data) == 0){
            return false;
        }
        return $data;
    }

    private static function attemptActivation(){

    }

    private static function obfuscate_email($email){
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    private static function obfuscate_phone($number){
        // Allow only Digits, remove all other characters.
        $number = preg_replace("/[^\d]/","",$number);

        // get number length.
        $length = strlen($number);

        // if number = 10
        if($length == 10) {
            $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "(***) ***-$3", $number);
        }

        return $number;
    }


}