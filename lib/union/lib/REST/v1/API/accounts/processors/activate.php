<?php
namespace Union\processor;

use Union\API\accounts\Account;
use Union\API\accounts\Registration;
use Union\API\Respondus\RespondusException;
use Union\Exceptions\InvalidParams;
use Union\PKG\Autoloader;

Autoloader::import__require("API.accounts");
function run($data){
    if (!isset($data['identifier'])){
        throw new InvalidParams(
            "Missing Parameters",
            "",
            "Invalid Request",
            "The request that was sent is invalid.",
            false,
            1001);
    }
    Registration::activate($data['identifier']);
    return ["status" => "success"];
}