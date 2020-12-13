<?php
define("UNION_SERVER_THIS", "/lib/union/lib/bin/php/data/this/");

define("UNION_API_DIRECTORY", "/lib/union/lib/REST/v1/API");
define("UNION_DRIVER_DIRECTORY", [
    "internal" => "/lib/union/lib/src/internal/php/drivers",
    "external" => "/lib/union/lib/src/external/php/drivers"
]);
define("UNION_DRIVER_DIRECTORY_ROOT", "/lib/union/lib/src/");



//Web Link Directories
// Check if php is running under Apache
try{
    if (!isset($_SERVER['HTTP_HOST'])) throw new \Exception("Offline mode activated.");

// Base weblinks
define("SLATELY_WEBSTACK_HREF_BASE", ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://$_SERVER[HTTP_HOST]/" );

// Directories
define("SLATELY_WEBSTACK_HREF_DIR_MANAGE",SLATELY_WEBSTACK_HREF_BASE . "manage");
define("SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES",SLATELY_WEBSTACK_HREF_BASE . "manage/venues");


// Authentication Links
define("SLATELY_WEBSTACK_HREF_PAGE_LOGIN", SLATELY_WEBSTACK_HREF_BASE . "login");
define("SLATELY_WEBSTACK_HREF_PAGE_ROUTE",SLATELY_WEBSTACK_HREF_BASE . "redirect");
define("SLATELY_WEBSTACK_HREF_PAGE_VENUE_SELECT", SLATELY_WEBSTACK_HREF_DIR_MANAGE . "/select");

// Card Links

    // Base link for clients to access their cards
    define("SLATELY_WEBSTACK_HREF_DIR_CLIENT_CARDS", SLATELY_WEBSTACK_HREF_BASE . "cards");
        define("SLATELY_WEBSTACK_HREF_DIR_CLIENT_CARDS_GIFTCARD", SLATELY_WEBSTACK_HREF_DIR_CLIENT_CARDS . "/giftcards");
            // HREF page for clients to view their card
            define("SLATELY_WEBSTACK_HREF_PAGE_CLIENT_CARDS_GIFTCARDS_VIEW", SLATELY_WEBSTACK_HREF_DIR_CLIENT_CARDS_GIFTCARD . "/view");

// Base link for managers to access their cards
    define("SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS",  SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES . "/cards");
        // Gift Cards
        define("SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS",  SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS . "/giftcards");
            // HREF page for managers to issue gift cards
            define("SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS_CREATE", SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS . "/create");

    // Toolkit directory
    define("SLATELY_WEBSTACK_HREF_DIR_MANAGE_TOOLS",SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES . "/tools");
        // Venue Counter
        define("SLATELY_WEBSTACK_HREF_DIR_MANAGE_TOOLS_COUNTER",SLATELY_WEBSTACK_HREF_DIR_MANAGE_TOOLS . "/count");
}catch(Exception $e){
    echo "CONFIG NOTE: Running in offline mode.\n";
}
