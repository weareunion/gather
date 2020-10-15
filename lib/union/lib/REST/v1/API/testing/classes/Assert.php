<?php


namespace Union\API\testing;


use google\appengine\Transform;

class Assert
{
    public $status = false;
    public $function;

    function __construct($status=false, $function = null)
    {
        $this->function = $function;
        $this->status = $status;
    }

    static function compare_exception(\Exception $exception_proposed, \Exception $exception_actual, $compare_structure = false){
        if ($exception_actual == true) return new Assert(true);
        if (!$compare_structure){
            return (new Assert((get_class($exception_actual) == get_class($exception_proposed))));
        }else{
            return (new Assert(($exception_actual == $exception_proposed)));
        }

    }
    static function compare_variable_content($proposed, $actual){
        if ($actual == true) return new Assert(true);
        return (new Assert(($proposed == $actual)));
    }
    static function compare_variable_strict($proposed, $actual){
        if ($actual == true) return new Assert(true);
        return (new Assert(($proposed === $actual)));
    }
    static function create_sandbox($function){
        return (new Assert(null,$function));
    }

    function run(){
        if ($this->function == null){
            return false;
        }
        try {
            return $this->function();
        }catch (\Exception $exception){
            return $exception;
        }
    }

}


