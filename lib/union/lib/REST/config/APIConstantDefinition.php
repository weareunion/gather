<?php
define("UNION_API_DIRECTORY", "/lib/union/lib/REST/v1/API");
define("UNION_DRIVER_DIRECTORY", [
    "internal" => "/lib/union/lib/src/internal/php/drivers",
    "external" => "/lib/union/lib/src/external/php/drivers"
]);


//Web Link Directories

define("SLATELY_WEBSTACK_HREF_BASE", ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://$_SERVER[HTTP_HOST]/" );
define("SLATELY_WEBSTACK_HREF_PAGE_LOGIN", SLATELY_WEBSTACK_HREF_BASE . "login");
define("SLATELY_WEBSTACK_HREF_PAGE_ROUTE",SLATELY_WEBSTACK_HREF_BASE . "redirect");
define("SLATELY_WEBSTACK_HREF_PAGE_VENUE_SELECT",SLATELY_WEBSTACK_HREF_BASE . "manage/select");