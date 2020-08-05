<?php
namespace Union\processor;

use Union\API\accounts\Registration;
use Union\API\Respondus\RespondusException;
function run($data){
    if (!isset($data['name']['first'], $data['name']['last'], $data['phone'], $data['email'], $data['password'])){
        throw new \InvalidParams(
            "Missing Parameters",
            "",
            "Invalid Request",
            "The request that was sent is invalid.",
            false,
            1001);
    }
    return Registration::add_to_registration($data['name']['first'], $data['name']['last'], $data['phone'], $data['email'], $data['password']);
}

//function validate($data){
//    if ($data[])
//}