<?php
define("UNION_API_DIRECTORY", "/lib/union/lib/REST/v1/API");
define("UNION_DRIVER_DIRECTORY", [
    "internal" => "/lib/union/lib/src/internal/php/drivers",
    "external" => "/lib/union/lib/src/external/php/drivers"
]);


//Web Link Directories

// Base weblinks
define("SLATELY_WEBSTACK_HREF_BASE", ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://$_SERVER[HTTP_HOST]/" );

// Directories
define("SLATELY_WEBSTACK_HREF_DIR_MANAGE",SLATELY_WEBSTACK_HREF_BASE . "manage");


// Authentication Links
define("SLATELY_WEBSTACK_HREF_PAGE_LOGIN", SLATELY_WEBSTACK_HREF_BASE . "login");
define("SLATELY_WEBSTACK_HREF_PAGE_ROUTE",SLATELY_WEBSTACK_HREF_BASE . "redirect");
define("SLATELY_WEBSTACK_HREF_PAGE_VENUE_SELECT", SLATELY_WEBSTACK_HREF_DIR_MANAGE . "/select");

// Card Links

    // Base link for clients to access their cards
    define("SLATELY_WEBSTACK_HREF_DIR_CLIENT_CARDS", SLATELY_WEBSTACK_HREF_BASE . "/cards");
        // HREF page for clients to view their card
        define("SLATELY_WEBSTACK_HREF_PAGE_CLIENT_CARDS_VIEW", SLATELY_WEBSTACK_HREF_DIR_CLIENT_CARDS . "/view");

// Base link for managers to access their cards
    define("SLATELY_WEBSTACK_HREF_DIR_MANAGER_CARDS", SLATELY_WEBSTACK_HREF_BASE . "/" . SLATELY_WEBSTACK_HREF_DIR_MANAGE . "/cards");
        // HREF page for managers to issue cards
        define("SLATELY_WEBSTACK_HREF_PAGE_MANAGER_CARDS_ISSUING", SLATELY_WEBSTACK_HREF_DIR_MANAGER_CARDS . "/issue");

