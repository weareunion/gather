<?php
/**
 * Copyright (c) 2019. This software is the property of Cor3 Design, LLC in cooperation with Union Development, LLC. Copying, distributing or using this software without proper permission is prohibited.
 */

/**
 * Created by PhpStorm.
 * User: karl
 * Date: 2019-07-17
 * Time: 09:23
 */

namespace Union\API\communications\external\email\outgoing;
require_once __DIR__ . "/../../libs/sendgrid/sendgrid-php/sendgrid-php.php";
require_once __DIR__ . "/../../libs/sendgrid/authentication/keys.php";

use SendGrid;
use Exception;
use Moycroft\API\accounts\Account\Account;
use Moycroft\API\comms\exceptions\Email\EmailPermissionDeliveryException;
use Moycroft\API\comms\exceptions\SMS\SMSPermissionDeliveryException;
use Moycroft\API\comms\notifications\Notification\Notification;
use function Moycroft\API\helper\IMPORT;
use function Moycroft\API\internal\GUID\GUID;
use function Moycroft\API\internal\reporting\report\__crash;
use function Moycroft\API\internal\reporting\report\__infoSH;


class Email
{
    public $templateID;
    public $from;
    public $to;
    public $options;
    public $subject;

    /**
     * @param mixed $subject
     */
    public function set_subject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param string $domain
     */
    public function set_domain($domain)
    {
        $this->domain = $domain;
    }
    public $html_body;
    public $text_body;
    public $domain = "tiig.ga";

    /**
     * @param mixed $html_body
     */
    public function set_html_body($html_body)
    {
        $this->html_body = $html_body;
    }

    /**
     * @param mixed $text_body
     */
    public function set_text_body($text_body)
    {
        $this->text_body = $text_body;
    }
    function set_options($options){
        $this->options = $options;
    }
    function set_from($username, $display_name){
        $this->from = new SendGrid\Mail\From($username."@".$this->domain, $display_name);
    }
    function set_to($email, $display_name){
        $this->to = new SendGrid\Mail\To($email, $display_name);
    }
    function set_template_id($id){
        $this->templateID = $id;
    }

    function send(){
        if (isset($this->options)){
            $email = new SendGrid\Mail\Mail($this->from, [$this->to], $this->subject, null, null, $this->options);
            $email->setTemplateId($this->templateID);
        }else{
            $email = new SendGrid\Mail\Mail($this->from, [$this->to], $this->subject, $this->text_body, $this->html_body);
        }
        $sendgrid = new SendGrid(COMMS_SENDGRID_KEYS_API_PRIVATE);
        try {
            $response = $sendgrid->send($email);
            return [$response->statusCode(), $response->body()];
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }
}