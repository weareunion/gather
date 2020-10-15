<?php


namespace Union\API\web\UI;


use Union\Exceptions\APIException;

class UIManager
{
    static function import_header($name="standard"){
        $file_name = __DIR__ . "/../resources/headers/$name.php";
        self::import_file($file_name);
    }

    static function import_file($file){
        if (!is_file($file)){
            throw new APIException("File does not exist.", "", "", "");
        }else{
            require_once $file;
        }
    }
}