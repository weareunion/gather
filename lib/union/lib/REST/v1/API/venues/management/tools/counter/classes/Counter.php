<?php


namespace Union\API\venue\management\tools;

use Moycroft\API\internal\mysql\Connect;
use Union\API\accounts\Account;
use Union\API\security\Auth;
use Union\API\venues\ActiveVenue;
use Union\API\venues\Venue;
use Union\Exceptions\APIException;
use Union\Exceptions\FeatureNotActive;
use Union\Exceptions\NoActiveVenue;
use Union\Exceptions\UnauthorizedRequest;
use Union\PKG\Autoloader;

Autoloader::import__require("API.accounts");
Autoloader::import__require("API.security");
Autoloader::import__require("API.venues");

class Counter
{
    public $vendor_id = null;
    static function modify($number){
        $user = Auth::logged_in();
        if (!$user){
            throw new UnauthorizedRequest("User must be logged in to modify numbers", "User must be logged in.", "Unauthorized Request. User must be logged in", "", false);
        }
        $active_venue = ActiveVenue::get()->id;
        if ($active_venue == null){
            throw new UnauthorizedRequest("No active venue attached to session", "", "No Venue attached.", "", false);
        }
        $connection = new Connect();
        $connection->connect();
        $connection->transaction();
        $current_count = $connection->query("SELECT `count` FROM slately_bigData.`venue_management_tools_counter-active_count` WHERE venue_id = '$active_venue'", true);
        if (!isset($current_count[0]['count'])){
            $current_count = 0;
        }else{
            $current_count = $current_count[0]['count'];
        }
        $post_delta = $number + $current_count;
        $connection->query("DELETE FROM slately_bigData.`venue_management_tools_counter-active_count` WHERE venue_id = '$active_venue';");
        $connection->query("INSERT INTO slately_bigData.`venue_management_tools_counter-active_count`(venue_id, count, updated) VALUES ('$active_venue', '$post_delta', NOW());");
        $connection->query("INSERT INTO slately_bigData.`venue_management_tools_counter-delta` (venue, delta, pre, post, user_account, stamp) VALUES ('$active_venue', '$number', '$current_count', '$post_delta', '$user', NOW())");
        $connection->commit();
        $connection->disconnect();
        return $post_delta;
    }
    static function get_count($venue_id = null){
        $active_venue = ActiveVenue::get()->id;
        if ($active_venue == null && $venue_id == null){
            throw new UnauthorizedRequest("No active venue attached to session", "", "No Venue attached.", "", false);
        }else{
            if ($venue_id == null){
                $venue_id = $active_venue;
            }
        }
        $connection = new Connect();
        $connection->connect();
        $data = $connection->query("SELECT `count` FROM slately_bigData.`venue_management_tools_counter-active_count` WHERE venue_id = '$venue_id'", true);
        $connection->disconnect();
        if (!isset($data[0]['count'])){
            throw new FeatureNotActive("Venue not found in database for this function", "", "This venue does not have counting enabled yet.", "", false);
        }else{
            return $data[0]['count'];
        }
    }
}