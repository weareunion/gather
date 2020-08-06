<?php

\Union\PKG\Autoloader::import__require("API.managers.mysql");
class Event
{
    static function create($title, $host_name, $host_phone_number, $unix_start, $unix_end){
        $connection = new \Moycroft\API\internal\mysql\Connect();
        $connection->connect();

    }

}