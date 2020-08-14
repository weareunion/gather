<?php


namespace Union\API\venues;


use Union\PKG\Autoloader;
use Union\session\Session;

class ActiveVenue
{
   private static function plate(){
       Autoloader::import__require("API.sessions");
   }
   static function bounce_back($manual = false){
       self::plate();
       if (Session::get_current_session()->get("API.venues.ActiveVenue.currentVenue") != null && $manual == false){
           return true;
       }
       $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       ob_clean();
       header("Location: " . SLATELY_WEBSTACK_HREF_PAGE_VENUE_SELECT . "?destination=".urlencode(base64_encode(urlencode($actual_link))));
       return;
   }

    /**
     * @param $venue_id
     */
    static function set($venue_id){
       self::plate();
       Session::get_current_session()->set("API.venues.ActiveVenue.currentVenue", ($venue_id));
   }

    /**
     * @return Venue|
     */
    static function get(){
        self::plate();
        return (new Venue(Session::get_current_session()->get("API.venues.ActiveVenue.currentVenue")));
    }
}