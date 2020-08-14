<?php
namespace Union\processor;



use Union\API\security\Auth;
use Union\Exceptions\InvalidParams;
use Union\PKG\Autoloader;

Autoloader::import__require("API.security");
function run($data){
    if (!isset($data['userID'] )){
        throw new InvalidParams("User ID and tokenID are both required.", "");
    }
    if (Auth::confirm2FA($data['code'])){
        Auth::activate_session();
    }
    return true;
}