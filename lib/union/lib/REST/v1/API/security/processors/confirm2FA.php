<?php
namespace Union\processor;


use Union\API\accounts\Account;
use Union\API\accounts\Registration;
use Union\API\security\Auth;
use Union\Exceptions\InvalidParams;

function run($data){
    if (!isset($data['code'])){
        throw new InvalidParams("2FA Code required", "");
    }
    if (Auth::confirm2FA($data['code'])){
        Auth::activate_session();
    }
    return true;
}