<?php


namespace Union\processor;


use Union\API\accounts\Account;
use Union\API\accounts\Registration;
use Union\API\security\Auth;

function run($data){

    $valid_modes = ['login', 'signup', '2fa'];
    if (!is_array($data)){
        throw new \InvalidParams(
            "Input DATA is not of type array.",
            "",
            "Invalid Request",
            "The request that was sent is invalid.",
            false,
            1001);
    }
    if (!isset($data['mode']) || !in_array(strtolower($data['mode']), $valid_modes)){
        throw new \InvalidParams(
            "Mode not given or is invalid",
            "",
            "Invalid Request",
            "The request that was sent is invalid.",
            false,
            1001);
    }
    switch ($data['mode']){
        case 'login':
            if (!isset($data['credentials']['user'])){
                throw new \InvalidParams(
                    "Missing user ID or password",
                    "",
                    "Invalid Request",
                    "The request that was sent is invalid.",
                    false,
                    1001);
            }

            $exists = true;
            $account_id = null;
            $data['credentials']['user'] = strtolower($data['credentials']['user']);
            $lookup_email = Account::lookup_email($data['credentials']['user']);
            if (!$lookup_email){
                $exists = false;
                $lookup_phone = Account::lookup_phone_number($data['credentials']['user']);
                if ($lookup_phone) {
                    $account_id = $lookup_phone;
                    $exists = true;
                }else{
                    $exists = false;
                };
            }else{
                $account_id = $lookup_email;
                $exists = true;
            }
            if (!$exists){
                $email = $phone = null;

                if (strpos($data['credentials']['user'], '@') !== false){
                    $email = $data['credentials']['user'];
                }else{
                    $phone = preg_replace("/[^0-9]/", "", $data['credentials']['user']);
                }
                $in_records = Registration::is_in_registration($phone, $email);
                if (is_array($in_records)){
                    return [
                        'status' => 'in_registration',
                        'content' => $in_records
                    ];
                }else{
                    throw new \AuthControllerException(
                        "Account record could not be found using provided ID",
                        "",
                        "We don't recognize an account with this email or phone number.",
                        "You can sign up for an account. {{SIGNUP}}",
                        false,
                        2011113);
                }
            }

            if (!isset($data['credentials']['password'])){
                return [
                    'status' => 'account_found',
                    'content' => [
                        'name' => Account::get_first_name($account_id)
                    ]
                ];
            }
            if (Auth::verify_credentials($account_id, $data['credentials']['password'])){
                if (Auth::require2FA($account_id)){
                    Auth::send2FA($account_id);
                    Auth::set_remember_me($account_id);
                    return ['status' => 'success',
                        'next_steps' => '2FA'];
                }else {
                    Auth::set_session($account_id);
                    Auth::activate_session();
                    Auth::set_remember_me($account_id);
                    return ['status' => 'success',
                        'next_steps' => 'none'];
                }
            }else{
                throw new \AuthControllerException(
                    "Invalid Username and Password Combination",
                    "",
                    "Whoops! That password did not match.",
                    "You can try again. {{FORGETPASSWORD}}",
                    false,
                    2011111);
            }

            break;
    }
    return;
}