<?php
namespace Union\processor;

use Union\API\accounts\Registration;
use Union\API\Respondus\RespondusException;
function run($data){

    if (!isset($data['type'], $data['identifier'])){
        throw new \InvalidParams(
            "Missing Parameters",
            "",
            "Invalid Request",
            "The request that was sent is invalid.",
            false,
            1001);
    }
    $data_pull = Registration::getRegistrarData($data['identifier']);
    if (!isset($data_pull[0]['account_phone_number'])){
        throw new \InvalidParams(
            "Could not find records",
            "",
            "Invalid Request",
            "The request that was sent is invalid.",
            true,
            1001);
    }
    if ($data['type'] == 'phone'){
        Registration::send_confirmation_sms($data_pull[0]['account_phone_number']);
        return true;
    }elseif($data['type'] == 'email'){
        if (!isset($data['name'])){
            $data['name'] = 'You';
        }
        Registration::send_conformation_email($data_pull[0]['account_email'], $data_pull[0]['account_first_name']);
        return true;
    }else{
        throw new \APIException("Inactive Target", "Target is not phone or email", null, null, true);
    }

}