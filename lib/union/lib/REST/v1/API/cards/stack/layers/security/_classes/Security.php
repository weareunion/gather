<?php


namespace Union\API\Cards;


// Helper layers for Card Parent Class

require_once __DIR__ . '/../layers/lockdown/_classes/Lockdown.php';
require_once __DIR__ . '/../layers/authentication/_classes/Authentication.php';
require_once __DIR__ . '/../layers/authorization/_classes/Authorization.php';
require_once __DIR__ . '/../layers/validity/_classes/Validity.php';


/**
 * Class Security
 * @package Union\API\Cards
 */
class Security  {
    /**
     * Object to manage structure
     * @var
     */
    public $parent;
    /**
     * Object to manage structure
     * @var Lockdown
     */
    public $lockdown;
    /**
     * Object to manage structure
     * @var Authentication
     */
    public $authentication;
    /**
     * Object to manage structure
     * @var Authorization
     */
    public $authorization;
    /**
     * Object to manage structure
     * @var Validity
     */
    public $validity;

    /**
     * Security constructor.
     * @param $properties
     * @param Card $parent
     */
    public function __construct( &$properties, Card $parent)
    {
        // create helper classes
        $this->lockdown = new Lockdown($properties, $parent);
        $this->authentication = new Authentication($properties, $parent);
        $this->authorization = new Authorization($properties, $parent);
        $this->validity = new Validity($properties, $parent);
    }
}