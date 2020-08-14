<?php


namespace Union\API\venue\management\tools;

use Union\API\accounts\Account;
use Union\API\security\Auth;
use Union\API\venues\ActiveVenue;
use Union\API\venues\Venue;
use Union\Exceptions\UnauthorizedRequest;
use Union\PKG\Autoloader;

Autoloader::import__require("API.accounts");
Autoloader::import__require("API.security");
Autoloader::import__require("API.venues");

class Counter
{
    public $vendor_id = null;
    function modify($sign, $number){
        $user = Auth::logged_in();
        if (!$user){
            throw new UnauthorizedRequest("User must be logged in to modify numbers", "User must be logged in.", "Unauthorized Request. User must be logged in", "", false);
        }
        $active_venue = ActiveVenue::get()->id;
        if ($active_venue == null){
            throw new UnauthorizedRequest("No active venue attached to session", "", "No Venue attached.", "", false);
        }

    }
}