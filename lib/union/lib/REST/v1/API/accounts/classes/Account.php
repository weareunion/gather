<?php

namespace Union\API\accounts;
use Moycroft\API\internal\mysql\Connect;
use Union\API\security\Auth;
use Union\Exceptions\AccountAlreadyExists;
use Union\Exceptions\DatabaseInsertionError;
use Union\Exceptions\InvalidParams;
use Union\Exceptions\Unauthorized;
use Union\PKG\Autoloader;

\Union\PKG\Autoloader::import__require("API.managers.mysql");
class Account
{
    static function create($name_first, $name_last, $phone_number=null, $email_address=null, $password=null, $password_is_hashed=false){
        //Flow Options
        $link_account = false;
        \Union\Grooped\gameserver\logging\Log::message("Account creation started");

        // Validate E-Mail
        if ($email_address != null && !filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            throw new InvalidParams(
                "Invalid Email Address",
                "The supplied email is not valid.",
                "Whoops! That doesn't look like a valid email address.",
                "The email does not seem like it is a valid email address. Please try again",
                false,
                1012110);
        }

        // Clean input strings
        $phone_number = preg_replace('/[^0-9.]+/', '', $phone_number);
        $email_address = self::clean_string($email_address);
        $name_first = preg_replace("/[^a-zA-Z0-9-]/","", $name_first);
        $name_last = preg_replace("/[^a-zA-Z0-9-]/", "",$name_last);

        // Check if there is at least a phone number or email address
        if ($phone_number == null && $email_address == null){
            throw new InvalidParams("Invalid Parameters",
                "A phone number or email is required.",
                null,
                null,
                true,
                1012120);
        }

        // Check if accounts already exist and if the account is being activated or its just a duplicate.
        $lookup_results = false;
        if ($phone_number != null){
            $lookup_results = self::lookup_phone_number($phone_number);
        }
        if (!$lookup_results && $email_address != null){
            $lookup_results = self::lookup_email($email_address);
        }
        if ($lookup_results){
            if ($password != null && self::is_unlinked($lookup_results)){
                // Set protocol to link existing password to client
                $link_account = true;
            }else{
                // Account already exists. Throw error with external message
                $descriptor = ($phone_number != null && self::lookup_phone_number($phone_number)) ? "Phone Number" : "E-Mail Address";
                $code = ($phone_number != null && self::lookup_phone_number($phone_number)) ? 1011120 : 1011110;
                throw new AccountAlreadyExists("This account already exists for this $descriptor",
                    "The account already exists and is linked, or password needs to be supplied. Account ID: {$lookup_results}",
                    "Looks like you already have an account!",
                    "We have found an account with that $descriptor. <union dynamic url service='API.accounts' target='links.signin'> Are you trying to sign in? </union>",
                    false,
                    $code);
            }
        }

        if ($password == null){
            $password = 'UNLINKED';
        }else{
            if (!$password_is_hashed) $password = self::hash_password($password);
        }

        if (!$link_account){
            $account_id = \Union\API\managers\GUID::generate();
            $connection = new Connect();
            $connection->connect();
            $query = "INSERT INTO slately_users.`security_auth-general_account_profiles` (
                                          account_id, 
                                          first_name, 
                                          last_name, 
                                          phone_number, 
                                          email_address, 
                                          password_hashed, 
                                          phone_activated, 
                                          email_activated
                               ) VALUES (
                                         '$account_id',
                                         '$name_first',
                                         '$name_last',
                                         '$phone_number',
                                         '$email_address',
                                         '$password',
                                         FALSE,
                                         FALSE
                               );
                    ";
            try {
                if (!$connection->query($query)) {
                    throw new DatabaseInsertionError("Failed to insert account into database",
                        "SQL Query '$query' failed.",
                        null,
                        null,
                        true,
                        1011210);
                }
            }catch (\Exception $exception){
                throw new DatabaseInsertionError("Failed to insert account into database. Exception caught.",
                    "SQL Query '$query' failed and caught in an exception: '$exception'.",
                    null,
                    null,
                    1011220);
            }
            $connection->disconnect();
            return true;
        }else{
            try {
                $connection = new Connect();
                $connection->connect();
                $result = true;
                if ($phone_number != null) {
                    $result = $connection->query("UPDATE slately_users.`security_auth-general_account_profiles` SET phone_number='$phone_number' WHERE account_id = '$lookup_results'");
                }
                if ($email_address != null) {
                    $result = $connection->query("UPDATE slately_users.`security_auth-general_account_profiles` SET email_address='$email_address' WHERE account_id = '$lookup_results'");
                }
                $connection->query("UPDATE `gather-accounts` SET password_hashed='$password' WHERE account_id = '$lookup_results'");
            }catch (\Exception $exception){
                throw new DatabaseInsertionError("Failed to update account to database during account linking. Exception caught.",
                    "SQL Query failed and caught in an exception: '$exception'.",
                    null,
                    null,
                    1011230);
            }
        }
    }

    static function lookup_phone_number($phone_number){
        $phone_number = preg_replace('/[^0-9.]+/', '', $phone_number);
        $connect = new Connect();
        $connect->connect();
        $results = $connect->query("SELECT account_id FROM slately_users.`security_auth-general_account_profiles` WHERE phone_number = '$phone_number'", true);
        $connect->disconnect();
        if (sizeof($results) == 0){
            return false;
        }else{
            if (is_array($results)){
                if (sizeof($results) > 0){
                    return $results[0]['account_id'];
                }
                return $results['account_id'];
            }else{
                return $results;
            }
        }
    }
    static function account_exists($account_id){
        $account_id = self::strict_logged_in($account_id);
        $connection = new Connect();
        $connection->connect();
        return !(sizeof($connection->query("SELECT * FROM slately_users.`security_auth-general_account_profiles` WHERE account_id='$account_id'", true)) == 0);
    }
    static function get_first_name($account_id=null){
        $account_id = self::strict_logged_in($account_id);
        return self::get_account_param($account_id, 'first_name');
    }
    static function get_last_name($account_id=null){
        $account_id = self::strict_logged_in($account_id);
        return self::get_account_param($account_id, 'last_name');
    }
    static function get_phone_number($account_id=null){
        $account_id = self::strict_logged_in($account_id);
        return self::get_account_param($account_id, 'phone_number');
    }
    static function get_email($account_id=null){
        $account_id = self::strict_logged_in($account_id);
        return self::get_account_param($account_id, 'email_address');
    }
    static function get_current_account(){
        Autoloader::import__require("API.security");
        return Auth::logged_in();
    }
    static function strict_logged_in($alt=null){
        $status = self::get_current_account();
        if ($status == null && $alt == null){
            throw new Unauthorized("User account must be given.", "", "You must log in before you can do this action.", "");
        }else{
            if ($status == null) return $alt;
            return $status;
        }
    }
    static function get_account_param($account_id, $peram_name){
        if (!self::account_exists($account_id)) return false;
        $connection = new Connect();
        $connection->connect();
        $res = $connection->query("SELECT `$peram_name` FROM slately_users.`security_auth-general_account_profiles` where account_id ='$account_id'", true)[0];
        if (!isset($res[$peram_name])) return false;
        return $res[$peram_name];
    }
    static function lookup_email($email){
        $email = self::clean_string($email);
        $connect = new Connect();
        $connect->connect();
        $results = $connect->query("SELECT account_id FROM slately_users.`security_auth-general_account_profiles` WHERE email_address = '$email'", true);
        $connect->disconnect();
        if (sizeof($results) == 0){
            return false;
        }else{
            if (is_array($results)){
                if (sizeof($results) > 0){
                    return $results[0]['account_id'];
                }
                return $results['account_id'];
            }else{
                return $results;
            }
        }
    }

    static function hash_password($password){
        return password_hash($password, PASSWORD_DEFAULT, ["cost" => 10]);
    }

    static function clean_string($string){
        $connection = new Connect();
        $connection->connect();
        $retval = mysqli_real_escape_string($connection->getConn(),$string);
        $connection->disconnect();
        return $retval;
    }

    static function is_unlinked($account_id){
        $connect = new Connect();
        $connect->connect();
        $results = $connect->query("SELECT account_id FROM slately_users.`security_auth-general_account_profiles` WHERE account_id = '$account_id' AND password_hashed = 'UNLINKED'", true);
        $connect->disconnect();
        return (!(sizeof($results) == 0));
    }

    static function modify($accountID, $param, $value){

    }
}