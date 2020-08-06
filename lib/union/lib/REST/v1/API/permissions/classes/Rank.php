<?php


namespace Union\API\permissions;

define("PERMISSIONS_RANK_LEVEL_CLIENT", 0);
define("PERMISSIONS_RANK_LEVEL_EMPLOYEE", 1);
define("PERMISSIONS_RANK_LEVEL_MANAGER", 2);
define("PERMISSIONS_RANK_LEVEL_CORPORATE", 3);
define("PERMISSIONS_RANK_LEVEL_DEVELOPER", 4);

class Rank
{
    static function auto(){
        // TODO: add database driven rank system
    }

    static function get_rank($account_id=null){

        return PERMISSIONS_RANK_LEVEL_DEVELOPER;
    }
}