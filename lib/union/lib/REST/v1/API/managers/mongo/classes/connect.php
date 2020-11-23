<?php


namespace Union\API\managers\mongo;


use MongoDB\Collection;

class connect
{
    static public $connection_uri = "mongodb://10.142.0.3:27017";
    static function get_obj(){
        \Union\PKG\Autoloader::import__require("drivers.external.MongoDB->composer");
        return new \MongoDB\Client(self::$connection_uri);
    }

}