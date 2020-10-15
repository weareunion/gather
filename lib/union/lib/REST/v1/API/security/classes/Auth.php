<?php


namespace Union\API\security;


use Moycroft\API\internal\mysql\Connect;
use Union\API\accounts\Account;
use Union\API\communications\external\SMS;
use Union\API\managers\GUID;
use Union\Exceptions\AuthControllerException;
use Union\Exceptions\Invalid2FA;

\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.communications.external, API.accounts");
class Auth
{
    public static $login_target = SLATELY_WEBSTACK_HREF_PAGE_LOGIN;
    static function verify_credentials($account_id, $password){
        if (!Account::account_exists($account_id)){
            return false;
        }
        $connection = new Connect();
        $connection->connect();
        $data = $connection->query("SELECT `password_hashed` FROM slately_users.`security_auth-general_account_profiles` WHERE account_id='$account_id'", true);
        if (sizeof($data) == 0){
            return false;
        }
        if (!password_verify($password, $data[0]['password_hashed'])){
            $_SESSION['auth']['password_active'] = false;
           return false;
        }
        $_SESSION['auth']['password_active'] = true;
        self::set_session($account_id);
        return true;
    }

    static function require2FA($accountID){
        session_start();
        $_SESSION['auth']['2FA']['required'] = true;
        $_SESSION['auth']['2FA']['confirmed'] = false;
        $_SESSION['auth']['2FA']['in2FA'] = false;
        return false;
    }

    static function send2FA($accountID){
        if (!Account::account_exists($accountID)) return false;
        $SMS = new SMS();
        $SMS->set_to_number(Account::get_phone_number($accountID));
        session_start();
        $_SESSION['auth']['2FA']['code'] = rand(100000,999999);
        $_SESSION['auth']['2FA']['in2FA'] = true;
        $SMS->set_body("Your Slately confirmation code is ". $_SESSION['auth']['2FA']['code'] . ".");
        $SMS->send();
        return true;
    }

    static function confirm2FA($number){
        if (isset($_SESSION['auth']['2FA']['tries'])){
            if ($_SESSION['auth']['2FA']['tries'] < 1){
                throw new Invalid2FA("Too many attempts.", "", "Unfortunately this code has been attempted too many times. Please close the page and try again.", "", false);
            }
        }
        if (!isset($_SESSION['auth']['2FA']['code'] )){
            throw new AuthControllerException(
                "2FA Code has not been sent yet.",
                ""
            );
        }
        if ($_SESSION['auth']['2FA']['code'] == preg_replace("/[^0-9.]/", '', $number)){
            return true;
        }else{
            if (!isset($_SESSION['auth']['2FA']['tries'])){
                $_SESSION['auth']['2FA']['tries'] = 5;
            }else{
                $_SESSION['auth']['2FA']['tries']--;
            }
            throw new Invalid2FA("Incorrect 2FA code",
            "",
            "The code is incorrect.",
            "",
            false);
        }
    }

    static function set_session($account_id){
        if (!Account::account_exists($account_id)){
            return false;
        }
        self::close_session();
        $session = session_start();
        $_SESSION['auth']['user'] = $account_id;
        return session_id();
    }

    static function close_session(){
        return session_destroy();
    }

    static function set_remember_me($account_id){
        $email = Account::get_email($account_id);
        setcookie('PERSISTENCE', null, -1, '/');
        $id = GUID::generate();
        $connection = new Connect();
        $connection->connect();
        $connection->query("DELETE FROM slately_users.`security_auth-persistence` WHERE account_id= '$account_id';");
        $connection->query("INSERT INTO slately_users.`security_auth-persistence` (user, additional_data, age, token, IP_address, IP_trusted, account_id) VALUES ('$email', '', NOW(), '$id', '".self::ip_get()."', '".self::ip_check(self::ip_get())."', '".$account_id."');");
        setcookie("PERSISTENCE", $id, time()+(3600*24*31));
    }

    static function get_remember_me(){
        if (!isset($_COOKIE['PERSISTENCE'])) return false;
        $connection = new Connect();
        $connection->connect();
        $val = $connection->query("SELECT * FROM slately_users.`security_auth-persistence` WHERE token='".$_COOKIE['PERSISTENCE']."';", true);
        if (sizeof($val) == 0){
            setcookie('PERSISTENCE', null, -1, '/');
            return false;
        }else{
            return $val[0];
        }
    }

    static function activate_session(){
        $session = session_start();
        $_SESSION['auth']['active'] = true;
    }

    static function bounce_back(){
        if (self::logged_in()){ return true;}
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ob_clean();
        header("Location: " . self::$login_target . "?destination=".urlencode(base64_encode(urlencode($actual_link))));
    }

    static function logged_in(){
        session_start();
        if (!isset($_SESSION['auth']['active']) || !$_SESSION['auth']['active'] || !isset($_SESSION['auth']['user'])){
            return false;
        }else{

//            if (!Account::account_exists($_SESSION['auth']['user'])){
//                self::close_session();
//                return false;
//            }
            return $_SESSION['auth']['user'];
        }
    }
    //Get client's IP or null if nothing looks valid
    static function ip_get($allow_private = false)
    {
        //Place your trusted proxy server IPs here.
        $proxy_ip = ['127.0.0.1'];

        //The header to look for (Make sure to pick the one that your trusted reverse proxy is sending or else you can get spoofed)
        $header = 'HTTP_X_FORWARDED_FOR'; //HTTP_CLIENT_IP, HTTP_X_FORWARDED, HTTP_FORWARDED_FOR, HTTP_FORWARDED

        //If 'REMOTE_ADDR' seems to be a valid client IP, use it.
        if(self::ip_check($_SERVER['REMOTE_ADDR'], $allow_private, $proxy_ip)) return $_SERVER['REMOTE_ADDR'];

        if(isset($_SERVER[$header]))
        {
            //Split comma separated values [1] in the header and traverse the proxy chain backwards.
            //[1] https://en.wikipedia.org/wiki/X-Forwarded-For#Format
            $chain = array_reverse(preg_split('/\s*,\s*/', $_SERVER[$header]));
            foreach($chain as $ip) if(ip_check($ip, $allow_private, $proxy_ip)) return $ip;
        }

        return null;
    }

//Check for valid IP. If 'allow_private' flag is set to truthy, it allows private IP ranges as valid client IP as well. (10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16)
//Pass your trusted reverse proxy IPs as $proxy_ip to exclude them from being valid.
    static function ip_check($ip, $allow_private = false, $proxy_ip = [])
    {
        if(!is_string($ip) || is_array($proxy_ip) && in_array($ip, $proxy_ip)) return false;
        $filter_flag = FILTER_FLAG_NO_RES_RANGE;

        if(!$allow_private)
        {
            //Disallow loopback IP range which doesn't get filtered via 'FILTER_FLAG_NO_PRIV_RANGE' [1]
            //[1] https://www.php.net/manual/en/filter.filters.validate.php
            if(preg_match('/^127\.$/', $ip)) return false;
            $filter_flag |= FILTER_FLAG_NO_PRIV_RANGE;
        }

        return filter_var($ip, FILTER_VALIDATE_IP, $filter_flag) !== false;
    }

}