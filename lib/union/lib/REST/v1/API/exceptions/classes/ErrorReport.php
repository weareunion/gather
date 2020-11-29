<?php


namespace Union\API\exceptions\reporting;


use Moycroft\API\internal\mysql\Connect;
use Union\Exceptions\FormattedException;
use Union\Exceptions\UncaughtException;
use Union\PKG\Autoloader;

class ErrorReport
{
    static function report($e){
        try {
            require_once "/lib/union/lib/REST/v1/build.php";

            Autoloader::import__require("API.managers.mysql");
            $error_code = bin2hex(random_bytes((int)( 1 ))). "" . bin2hex(random_bytes((int)( 1 ))) . "-" . bin2hex(random_bytes((int)( 1 ))) . "" . bin2hex(random_bytes((int)( 1 )));
            $exception_message_internal = "";
            $exception_message_external = "";
            if ($e instanceof \Union\Exceptions\FormattedException || is_subclass_of($e, '\Union\Exceptions\FormattedException')){
                $exception_message_internal = self::clean_string($e->data['internal']['title'] . " - " . $e->data['internal']['description']);
                $exception_message_external = self::clean_string($e->data['external']['title'] . " - " . $e->data['external']['description']);
            }else{
                $exception_message_internal = self::clean_string($e->getMessage());
            }
            $stack = self::clean_string($e->getTraceAsString());
            $throw_location = self::clean_string($e->getFile());
            $classname = self::clean_string(get_class($e));
            $connection = new Connect();
            $connection->connect();
           $connection->query("INSERT INTO slately_bigData.`exceptions_reporting-error_report` (
                                                                 error_issued, 
                                                                 IP, 
                                                                 IP_location, 
                                                                 exception_classname, 
                                                                 exception_message_internal, 
                                                                 exception_message_external, 
                                                                 exception_stack, 
                                                                 exception_throw_location, 
                                                                 exception_origin_file, 
                                                                 lookup_code,
                                                                 server_IP
                                                                 ) VALUES  (
                                                                            NOW(),
                                                                            '".self::ip_get()."',
                                                                            '".self::get_ip_location_string(self::ip_get())."',
                                                                            '$classname',
                                                                            '$exception_message_internal',
                                                                            '$exception_message_external',
                                                                            '$stack',
                                                                            '$throw_location',
                                                                            '',
                                                                            '$error_code',
                                                                            '".$_SERVER['SERVER_NAME']."'
                                                                            
                                                                 )");
            $connection->disconnect();
            return $error_code;
        }catch(\Exception $e){
            return false;
        }
    }
    static function clean_string($string){
        return str_replace(array( "'", "\\" ), array( "", "\\\\" ), $string);
    }
    static function get_ip_location_string($ip){
        try {
            $ipdat = json_decode(file_get_contents(
                "http://www.geoplugin.net/json.gp?ip=" . $ip));
            return str_replace("'", "", "$ipdat->geoplugin_city, $ipdat->geoplugin_regionCode $ipdat->geoplugin_countryName ( $ipdat->geoplugin_latitude,  $ipdat->geoplugin_longitude)");
        }catch(\Exception $e){
            return "N\A";
        }
    }

    static function listen(){
        set_exception_handler(function($e){

            // Only log if the class is not a Formatted Exception type (Would be a duplicate)
            if (!($e instanceof FormattedException || is_subclass_of($e, FormattedException::class))) {
                var_dump($e);

                self::report($e);
            }
            throw $e;
        });
    }
    static function listen_all(){
        set_error_handler(function($errno, $errstr, $errfile, $errline ){
            if (!(strpos($errstr, "session_start()") !== false)) {
                $exc = new UncaughtException("CRITICAL: Uncaught Exception found by Error Handler", "ErrNo: $errno, Message: $errstr, File: $errfile, Line: $errline");
                self::report($exc);
            }
        });
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
            foreach($chain as $ip) if(self::ip_check($ip, $allow_private, $proxy_ip)) return $ip;
        }

        return null;
    }

//Check for valid IP. If 'allow_private' flag is set to truthy, it allows private IP ranges as valid client IP as well. (10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16)
//Pass your trusted reverse proxy IPs as $proxy_ip to exclude them from being valid.
    static function ip_check($ip, $allow_private = false, $proxy_ip = [])
    {
        /** @noinspection SuspiciousBinaryOperationInspection */
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

