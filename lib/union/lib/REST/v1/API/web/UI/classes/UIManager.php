<?php


namespace Union\API\web\UI;


use Union\Exceptions\APIException;

class UIManager
{
    static function import_header($name="standard"){
        $file_name = __DIR__ . "/../resources/headers/$name.php";
        self::import_file($file_name, false);
    }
    static function import_footer($name="invisible"){
        $file_name = __DIR__ . "/../resources/footers/$name.php";
        self::import_file($file_name, false);
    }

    static function import_file($file, $from_resources=true){
        if ($from_resources) $file = __DIR__ . "/../resources" . $file;
        if (!is_file($file)){
            throw new APIException("File ($file) does not exist.", "", "", "");
        }else{
            require_once $file;
        }
    }
}