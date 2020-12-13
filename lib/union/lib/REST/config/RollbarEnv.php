<?php
// Import Rollbar
use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;
try{
    require_once "/lib/union/lib/src/external/php/drivers/rollbar/vendor/autoload.php";
    $env = 'production';
    try{
        $e = file_get_contents('/lib/union/lib/bin/php/data/this/environment');
        $env = $e ?? 'production';
    }catch(\Exception $exception){}
    Rollbar::init(
        array(
            'access_token' => file_get_contents("/lib/union/lib/keys/RollBar/accessToken.key"),
            'environment' => $env
        )
    );
}catch(\Exception $e){
    var_dump($e);
}