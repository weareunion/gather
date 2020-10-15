<?php

namespace Union\processor;


use Moycroft\API\internal\mysql\Connect;
use Union\API\accounts\Account;
use Union\API\accounts\Registration;
use Union\API\security\Auth;
use Union\API\venue\management\tools\Counter;
use Union\API\venues\ActiveVenue;
use Union\Exceptions\APIException;
use Union\Exceptions\AuthControllerException;
use Union\Exceptions\Invalid2FA;
use Union\Exceptions\InvalidDelta;
use Union\Exceptions\InvalidParams;
use Union\Exceptions\NoActiveVenue;
use Union\PKG\Autoloader;

function run($data){
    $venue_id = null;
    if (isset($data['venue_id'])){
        $venue_id = str_replace("'", "", $data['venue_id']);
    }
    Autoloader::import__require("API.managers.mysql, API.accounts, API.security, API.venues, API.venues.management.tools.counter");
    return [
        'current_count' => Counter::get_count($venue_id)
    ];
}