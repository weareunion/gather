<?php


namespace Union\session;


use Union\PKG\Autoloader;

class Session
{
    public $data = [];

    private static function start_session(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    static function get_current_session(){
        self::start_session();
        if (!isset($_SESSION['SESSION_MANAGER_DATA'])){
            $_SESSION['SESSION_MANAGER_DATA'] = [];
        }else{
            $return = new Session();
            $return->pull();
            return $return;
        }
    }

    function __construct()
    {
        define("SESSION_MANAGER_DNO", "EE-CONSTCAT-". abs(rand(intval(111111111111111111111111111111),intval(999999999999999999999999999999))));
    }

    function set($location, $value, $override = true, $must_be_logged_in = true){
        $location = explode(".", "X." . $location);
        $val_chain = "";
        foreach ($location as &$item){
            $item = str_replace("\"", "", $item);
            $item = str_replace("'", "", $item);
            $item = strtoupper($item);
        }
        $overwritten_value = $this->dive($this->data, $location, $value, $override, $must_be_logged_in, sizeof($location)-1);
        $this->bind();;
        return $overwritten_value;
    }

    function get($location){
        $location = explode(".", "X." . $location);
        $found_value = $this->dive($this->data, $location, SESSION_MANAGER_DNO, true, true, sizeof($location)-1);
        if (!isset($found_value["DATA"])) return null;
        return $found_value["DATA"];
    }

    function bind(){
        $_SESSION['SESSION_MANAGER_DATA'] = $this->data;
    }

    function pull(){
        $this->data = $_SESSION['SESSION_MANAGER_DATA'];
    }

    function dive(&$previous, $distance_list, $value=SESSION_MANAGER_DNO, $override=true, $must_be_authorized = true, $distance_to_travel = 0, $level = 0){
        if (sizeof($distance_list) == $distance_to_travel){
            if ($value == SESSION_MANAGER_DNO){
                $arr_ob = new \ArrayObject($previous);
                return $arr_ob->getArrayCopy();
            }
            if (isset($previous) && !$override){
                $arr_ob = new \ArrayObject($previous);
                return $arr_ob->getArrayCopy();
            }
            $to_return = $previous['DATA'];
            $previous = [
                "DATA" => $value,
                "&&SESSION_DATA_POINT_ATTR" => [
                   "CONDITIONS" => [
                       "AUTHORIZATION_REQUIRED" => $must_be_authorized
                   ]
                ]
            ];
            return $to_return;
        }else{
            $item = array_shift($distance_list);
            if (!isset($previous[$distance_list[0]])){
                $previous[$distance_list[0]] = [
                    "&&SESSION_DATA_TREE_MANAGER" => [
                        "DEPTH" => $level+1
                    ]
                ];
            }
            return $this->dive($previous[$distance_list[0]], $distance_list, $value, $override, $must_be_authorized, $distance_to_travel, (++$level));
        }
    }
}