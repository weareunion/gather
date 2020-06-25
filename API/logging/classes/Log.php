<?php


namespace Union\Grooped\gameserver\logging;


class Log
{
    static function message($content, $type="primary", $level=1){
        echo "<div class=\"notification is-$type\">
  <button class=\"delete\"></button>
  $content
</div>";
    }

}