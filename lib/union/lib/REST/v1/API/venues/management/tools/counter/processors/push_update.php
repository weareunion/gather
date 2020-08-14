<?php

namespace Union\processor;


use Union\API\accounts\Account;
use Union\API\accounts\Registration;
use Union\API\security\Auth;
use Union\Exceptions\AuthControllerException;
use Union\Exceptions\Invalid2FA;
use Union\Exceptions\InvalidParams;

function run($data){
    return "test" . $data['delta'];
}