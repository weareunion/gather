<?php
namespace Union\API\Cards;
\Union\PKG\Autoloader::import__require("API.managers.mongo");
\Union\PKG\Autoloader::import__require("API.managers.mysql");

class Lockdown {

    public function __construct(&$properties)
    {

    }
}
class Authentication {
    public $parent;
    public function __construct(&$properties)
    {

    }
}
class Authorization {
    public $parent;
    public function __construct(&$properties)
    {

    }
}

class Security  {
    public $parent;
    public $lockdown;
    public $authentication;
    public $authorization;
    public function __construct(&$properties)
    {
       $this->lockdown = new Lockdown($properties->lockdown);
       $this->authentication = new Authentication($properties->authentication);
       $this->authorization = new Authorization($properties->authorization);
    }
}
class Card
{
    public $defaults = [
        'type' => '',
        'amount_start' => 0,
        'amount_current' => 0,
        'id' => '',
        'security' => [
            // Lock down card from being used
            'lockdown' => [
                'active' => false,
                'reason' => '',
                'origin' => null
            ],
            // Authentication types
            'authentication' => [
                // Authentication methods
                'methods' => [
                    'account' => [
                        'account_linked' => false,
                        'account_id' => '',
                        'linked_on' => ''
                    ],
                    // If account has not been linked, use a pin method
                    'pin' => [
                        'pin_SHA' => '',
                        'pin_SHA_salt' => '',
                        'recovery' => [
                            'phone_number' => '',
                            'email' => '',
                            'pin' => ''
                        ]
                    ]
                ]
            ],
            'authorization' => [
                'SHA_credential' => '',
                'SHA_salt' => ''
            ]
        ]

    ];
    public $properties;
    public $security;
    public function __construct($id=null){
        // Set up defaults
        $this->properties = json_decode(json_encode($this->defaults), FALSE);

        // Overload if exists
        $this->load($id);

        // Create Objects
        $this->security = new Security($this->properties->security);
    }
    function load($id){

    }
    function create(){
        var_dump($this->properties->security);
//        $connection = \Union\API\managers\mongo\connect::get_obj();
//        $connection->slately->cards->insertOne([
//
//        ]);
    }

}
