<?php
namespace Union\processor;



function run($data){
    if (!isset($data['userID'] )){
        throw new \InvalidParams("User ID and tokenID are both required.", "");
    }
    if (Auth::confirm2FA($data['code'])){
        Auth::activate_session();
    }
    return true;
}