<?php


namespace Union\API\venues;


use Union\API\accounts\Account;
use Union\API\datatypes\StaffRank;
use Union\API\security\Auth;
use Union\PKG\Autoloader;

class VenueSearch
{
    static function get_user_associated_venues($account_id=null){

        Autoloader::import__require("API.managers.mysql, API.security, API.accounts");
        require_once "Venue.php";

        // Default to current authed session
        $account_id = ($account_id) ? $account_id : Auth::logged_in();

        // Fail if no account given or given account doesnt exist
        if (!$account_id || !Account::account_exists($account_id)) return false;

        $connection = new \Moycroft\API\internal\mysql\Connect();
        $connection->connect();
        $results = $connection->query("
        SELECT venue_id, `venues-user_associations`.`rank` FROM slately_users.`venues-user_associations` WHERE user_id = '$account_id'
        ", true);

        $UAV = [];
        foreach ($results as $result){
            $venue = new Venue($result['venue_id']);
            if ($venue) array_push($UAV, [
                "rank" => new StaffRank($result['rank']),
                "venue" => $venue
            ]);
        }

        return $UAV;
    }
}