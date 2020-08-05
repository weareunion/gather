<?php


namespace Union\Grooped\gameserver\logging;


class Log
{
    static function message($content, $type="primary", $level=1){
        session_start();
        if (isset($_SESSION['FLAG_DEVELOPER_VERBOSE']) && $_SESSION['FLAG_DEVELOPER_VERBOSE'] && false) {
            echo "<div class=\"notification is-$type\">
  <button class=\"delete\"></button>
  $content
</div>";
        }
    }

}