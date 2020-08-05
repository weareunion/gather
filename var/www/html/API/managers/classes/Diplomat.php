<?php


namespace Union\Grooped\gameserver\managers\Diplomat;


class Diplomat
{
    public static function report($message){
        //TODO: CURL to main server a report
    }
    public static function template_gameserver_reserving($game_id, $port){

    }
    public static function template_gameserver_ready($game_id, $port){

    }
    public static function template_gameserver_stopped($game_id, $port){

    }
    public static function template_gameserver_reservation_failed($game_id, $reason = "", $error_code=0){

    }
}