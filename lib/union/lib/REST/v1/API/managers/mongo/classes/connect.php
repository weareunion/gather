<?php


namespace Union\API\managers\mongo;


class connect
{
    static function get_obj(){
        \Union\PKG\Autoloader::import__require("drivers.external.MongoDB->composer");
        return new \MongoDB\Client("mongodb://10.142.0.3:27017");
    }
}