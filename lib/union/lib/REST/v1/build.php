<?php
require_once "/lib/union/lib/REST/config/RollbarEnv.php";
require_once "/lib/union/lib/REST/config/config.php";
require_once "/lib/union/lib/REST/v1/API/exceptions/references/exceptions.php";
require_once "/lib/union/lib/REST/v1/autoloader/classes/exceptions/ImproperConfig.php";
require_once "/lib/union/lib/REST/v1/autoloader/classes/exceptions/InvalidLocator.php";
require_once "/lib/union/lib/REST/v1/autoloader/classes/exceptions/MissingFile.php";
require_once "/lib/union/lib/REST/v1/autoloader/classes/exceptions/MissingPackage.php";
require_once "/lib/union/lib/REST/v1/autoloader/classes/Autoloader.php";

// Required Classes

\Union\PKG\Autoloader::import__require("API.interface");