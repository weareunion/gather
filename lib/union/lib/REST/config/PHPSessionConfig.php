<?php

// Change the session timeout value to 30 minutes  // 8*60*60 = 8 hours
ini_set("session.gc_maxlifetime", 60*24*5*60);
//————————————————————————————–

// php.ini setting required for session timeout.

ini_set("session.gc_probability",1);
ini_set("session.gc_divisor",1);

//if you want to change the  session.cookie_lifetime.
//This required in some common file because to get the session values in whole application we need to        write session_start();  to each file then only will get $_SESSION global variable values.

$sessionCookieExpireTime=60*24*5*60;
session_set_cookie_params($sessionCookieExpireTime);
session_start();