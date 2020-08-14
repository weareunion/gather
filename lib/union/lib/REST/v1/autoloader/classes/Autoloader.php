<?php


namespace Union\PKG;
use Union\PKG\exceptions\ImproperConfig;
use Union\PKG\exceptions\InvalidLocator;
use Union\PKG\exceptions\MissingFile;
use Union\PKG\exceptions\MissingPackage;

class Autoloader
{
    static $load_order;
    static $standard_load_order  = [
        "config" => [],
        "exceptions" => [],
        "classes" => []
    ];
    static $load_order_persistent = false;
    static function set_load_order($load_order, $persistent=false, $default=false){
        if (!is_array($load_order)){
            return false;
        }
        if ($default){
            self::$load_order = self::$standard_load_order;
            return true;
        }
        foreach ($load_order as $key => $value){
            array_push($load_order, $key);
            $load_order[$key] = [];
        }
        self::$load_order_persistent = $persistent;
        return true;
    }
    static function import__require($package_name){
        $names = explode(",", $package_name);
        foreach ($names as $name){
            $name = trim($name);
            self::load(self::parse($name, true), true);
        }
        return;
    }
    static function import($package_name){
        $names = explode(",", $package_name);
        foreach ($names as $name){
            $name = trim($name);
            self::load(self::parse($name, false), false);
        }
        return;
    }

     static function parse($package_name, $throw=true){
        if(!defined("UNION_API_DIRECTORY")){
            throw new ImproperConfig("The constant UNION_API_DIRECTORY has not been defined.");
        }
        $return_construct = [
          "dir" => "",
           "method" => "standard"
        ];
        $exploded_locator = explode( ".", $package_name);
        $method = explode("->", $exploded_locator[sizeof($exploded_locator)-1]);
        $exploded_locator[sizeof($exploded_locator)-1] = $method[0];
        if (sizeof($method) > 1){
            $return_construct['method'] = 'composer';
        }
        if ($exploded_locator[sizeof($exploded_locator)-1] == 'php'){
            $return_construct['method'] = 'file';
        }

        switch (strtolower($exploded_locator[0])){
            case "api":
                array_shift($exploded_locator);
                $return_construct['dir'] = UNION_API_DIRECTORY . "/" . implode("/", $exploded_locator);
                break;
            case "drivers":
            case "driver":
                array_shift($exploded_locator);
                switch (strtolower($exploded_locator[0])){
                    case "internal":
                        array_shift($exploded_locator);
                        $return_construct['dir'] = UNION_DRIVER_DIRECTORY['internal'] . "/" . implode("/", $exploded_locator);
                        break;
                    case "external":
                    default:
                     array_shift($exploded_locator);
                        $return_construct['dir'] = UNION_DRIVER_DIRECTORY['external'] . "/" . implode("/", $exploded_locator);
                        break;
                }
                break;
            default:
                throw new InvalidLocator("Invalid destination. Valid destinations are such as API, drivers, etc.");
        }
        return $return_construct;
    }

    public static function load($target, $throw=true){
        if (!$target && !$throw){
            return false;
        }
        if (!isset($target['dir'], $target['method'])){
            var_dump($target);
            return false;
        }
        // Process loading methods
        switch (strtolower($target['method'])){
            case "file":
                if (!file_exists($target['dir'])){
                    if ($throw){
                        throw new MissingFile("The file that was requested does not exist in this environment.");
                    }else{
                        return false;
                    }
                }else{
                    require_once $target['dir'];
                }
                break;
            case "standard":
                if (!is_dir($target['dir'])){
                    if ($throw){
                        throw new MissingPackage("The package that was requested does not exist in this environment.");
                    }else{
                        return false;
                    }
                }else{
                   self::load_recursively($target['dir'], $throw);
                }
                break;
            case "composer":
                try{
                    self::load([
                        "dir" => $target['dir'] . "/vendor/autoload.php",
                        "method" => "file"],
                        true
                    );
                }catch (MissingFile $exception){
                    if ($throw){
                        throw new MissingPackage("The package, (more specifically the composer required vendor/autoload.php) ['".$target['dir'] . "/vendor/autoload.php"."'] that was requested does not exist in this environment.");
                    }else{
                        return false;
                    }
                }
                break;
        }
    }
    public static function load_recursively($dir, $throw=true){
        if (!isset(self::$load_order) || self::$load_order == null || sizeof(self::$load_order) == 0){
            self::set_load_order([], false, true);
        }
        $imports = self::$load_order;
        foreach (self::getDirContents($dir) as $file){
            foreach ($imports as $key => $value){
                if (strpos($file, $key."/") !== false){
                    array_push($imports[$key], $file);
                }
            }
        }
        foreach (self::$load_order as $key => $value){
            foreach ($imports[$key] as $file){
                require_once $file;
            }
        }
        if (!self::$load_order_persistent) self::$load_order = null;
        return;
    }
    static function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                self::getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }
}