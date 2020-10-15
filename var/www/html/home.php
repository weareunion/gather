<?php
require_once "/lib/union/lib/REST/v1/build.php";
//\Union\API\security\Auth::bounce_back();
if (isset($_GET['destroy'])) {session_destroy();}
//echo "Logged in user (".\Union\API\security\Auth::logged_in()."):";
//echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in()) . " " . \Union\API\accounts\Account::get_last_name(\Union\API\security\Auth::logged_in())
?>
<?php
/* This sets the $time variable to the current hour in the 24 hour clock format */
$time = date("H");
/* Set the $timezone variable to become the current timezone */
$timezone = date("e");
/* If the time is less than 1200 hours, show good morning */
$greeting = "";
if ($time < "12") {
    $greeting = "Good morning";
} else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        $greeting = "Good afternoon";
    } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            $greeting = "Good evening";
        } else
            /* Finally, show good night if the time is greater than or equal to 1900 hours */
            if ($time >= "19") {
                $greeting = "Good night";
            }
?>

<?php require_once __DIR__ . "/src/php/elements/container/container_start.php"; ?>
<meta charset="utf-8">
<title>Slately | Login
</title>
<!-- SEO Meta Tags-->
<meta name="description" content="Around - Multipurpose Bootstrap Template">
<meta name="keywords" content="bootstrap, business, consulting, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, multipurpose, product landing, shop, software, ui kit, web studio, landing, html5, css3, javascript, gallery, slider, touch, creative">
<meta name="author" content="Createx Studio">
<!-- Viewport-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon and Touch Icons-->
<link rel="icon"  href="../../src/media/images/favicons/favicon.ico">
<link rel="icon" type="image/png" sizes="16x16" href="../../src/media/images/favicons/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../src/media/images/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../src/media/images/favicons/favicon-32x32.png">


<link rel="mask-icon" color="#5bbad5" href="https://demo.createx.studio/around/safari-pinned-tab.svg">
<meta name="msapplication-TileColor" content="#766df4">
<link rel="manifest" href="../../src/media/images/favicons/site.webmanifest">
<meta name="theme-color" content="#ffffff">
<!-- Page loading styles-->
<style>
    @keyframes spinLeft {
        0% {
            transform: rotate(20deg);
        }
        50% {
            transform: rotate(160deg);
        }
        100% {
            transform: rotate(20deg);
        }
    }
    @keyframes spinRight {
        0% {
            transform: rotate(160deg);
        }
        50% {
            transform: rotate(20deg);
        }
        100% {
            transform: rotate(160deg);
        }
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(2520deg);
        }
    }


    .spinner {
        position: relative;
        width: 200px;
        height: 200px;
        animation: spin 7s linear infinite;
    }
    .spinner::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        border: 6px solid #D4D7DC;
        border-radius: 100px;
    }
    .right, .rightWrapper, .left, .leftWrapper {
        position: absolute;
        top: 0;
        overflow: hidden;
        width: 100px;
        height: 200px;
    }
    .left, .leftWrapper {
        left: 0;
    }
    .right {
        left: -100px;
    }
    .rightWrapper {
        right: 0;
    }

    .circle {
        border: 6px solid #7272EB;
        width: 200px;
        height: 200px;
        border-radius: 100px;
    }
    .left {
        transform-origin: 100% 50%;
        animation: spinLeft 2.5s cubic-bezier(.2,0,.8,1) infinite;
    }
    .right {
        transform-origin: 100% 50%;
        animation: spinRight 2.5s cubic-bezier(.2,0,.8,1) infinite;
    }
    /* line 4, ../sass/_offline-theme-base.sass */
    .offline-ui, .offline-ui *, .offline-ui:before, .offline-ui:after, .offline-ui *:before, .offline-ui *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    /* line 7, ../sass/_offline-theme-base.sass */
    .offline-ui {
        display: none;
        position: fixed;
        background: white;
        z-index: 2000;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
    }
    /* line 17, ../sass/_offline-theme-base.sass */
    .offline-ui .offline-ui-content:before {
        display: inline;
    }
    /* line 20, ../sass/_offline-theme-base.sass */
    .offline-ui .offline-ui-retry {
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        display: none;
    }
    /* line 24, ../sass/_offline-theme-base.sass */
    .offline-ui .offline-ui-retry:before {
        display: inline;
    }
    /* line 29, ../sass/_offline-theme-base.sass */
    .offline-ui.offline-ui-up.offline-ui-up-5s {
        display: block;
    }
    /* line 32, ../sass/_offline-theme-base.sass */
    .offline-ui.offline-ui-down {
        display: block;
    }
    /* line 37, ../sass/_offline-theme-base.sass */
    .offline-ui.offline-ui-down.offline-ui-waiting .offline-ui-retry {
        display: block;
    }
    /* line 42, ../sass/_offline-theme-base.sass */
    .offline-ui.offline-ui-down.offline-ui-reconnect-failed-2s.offline-ui-waiting .offline-ui-retry {
        display: none;
    }

    @-webkit-keyframes offline-dropin {
        /* line 40, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 0;
        }

        /* line 43, ../sass/_keyframes.sass */
        1% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 0;
        }

        /* line 48, ../sass/_keyframes.sass */
        2% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 1;
        }

        /* line 51, ../sass/_keyframes.sass */
        100% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 1;
        }
    }

    @-moz-keyframes offline-dropin {
        /* line 40, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 0;
        }

        /* line 43, ../sass/_keyframes.sass */
        1% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 0;
        }

        /* line 48, ../sass/_keyframes.sass */
        2% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 1;
        }

        /* line 51, ../sass/_keyframes.sass */
        100% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 1;
        }
    }

    @-ms-keyframes offline-dropin {
        /* line 40, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 0;
        }

        /* line 43, ../sass/_keyframes.sass */
        1% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 0;
        }

        /* line 48, ../sass/_keyframes.sass */
        2% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 1;
        }

        /* line 51, ../sass/_keyframes.sass */
        100% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 1;
        }
    }

    @-o-keyframes offline-dropin {
        /* line 40, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 0;
        }

        /* line 43, ../sass/_keyframes.sass */
        1% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 0;
        }

        /* line 48, ../sass/_keyframes.sass */
        2% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 1;
        }

        /* line 51, ../sass/_keyframes.sass */
        100% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes offline-dropin {
        /* line 40, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 0;
        }

        /* line 43, ../sass/_keyframes.sass */
        1% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 0;
        }

        /* line 48, ../sass/_keyframes.sass */
        2% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
            opacity: 1;
        }

        /* line 51, ../sass/_keyframes.sass */
        100% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            opacity: 1;
        }
    }

    @-webkit-keyframes offline-dropout {
        /* line 57, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
        }

        /* line 59, ../sass/_keyframes.sass */
        100% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
        }
    }

    @-moz-keyframes offline-dropout {
        /* line 57, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
        }

        /* line 59, ../sass/_keyframes.sass */
        100% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
        }
    }

    @-ms-keyframes offline-dropout {
        /* line 57, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
        }

        /* line 59, ../sass/_keyframes.sass */
        100% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
        }
    }

    @-o-keyframes offline-dropout {
        /* line 57, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
        }

        /* line 59, ../sass/_keyframes.sass */
        100% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
        }
    }

    @keyframes offline-dropout {
        /* line 57, ../sass/_keyframes.sass */
        0% {
            transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
        }

        /* line 59, ../sass/_keyframes.sass */
        100% {
            transform: translateY(-800px);
            -webkit-transform: translateY(-800px);
            -moz-transform: translateY(-800px);
            -ms-transform: translateY(-800px);
            -o-transform: translateY(-800px);
        }
    }

    @-webkit-keyframes offline-rotation {
        /* line 64, ../sass/_keyframes.sass */
        0% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
        }

        /* line 66, ../sass/_keyframes.sass */
        100% {
            transform: rotate(359deg);
            -webkit-transform: rotate(359deg);
            -moz-transform: rotate(359deg);
            -ms-transform: rotate(359deg);
            -o-transform: rotate(359deg);
        }
    }

    @-moz-keyframes offline-rotation {
        /* line 64, ../sass/_keyframes.sass */
        0% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
        }

        /* line 66, ../sass/_keyframes.sass */
        100% {
            transform: rotate(359deg);
            -webkit-transform: rotate(359deg);
            -moz-transform: rotate(359deg);
            -ms-transform: rotate(359deg);
            -o-transform: rotate(359deg);
        }
    }

    @-ms-keyframes offline-rotation {
        /* line 64, ../sass/_keyframes.sass */
        0% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
        }

        /* line 66, ../sass/_keyframes.sass */
        100% {
            transform: rotate(359deg);
            -webkit-transform: rotate(359deg);
            -moz-transform: rotate(359deg);
            -ms-transform: rotate(359deg);
            -o-transform: rotate(359deg);
        }
    }

    @-o-keyframes offline-rotation {
        /* line 64, ../sass/_keyframes.sass */
        0% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
        }

        /* line 66, ../sass/_keyframes.sass */
        100% {
            transform: rotate(359deg);
            -webkit-transform: rotate(359deg);
            -moz-transform: rotate(359deg);
            -ms-transform: rotate(359deg);
            -o-transform: rotate(359deg);
        }
    }

    @keyframes offline-rotation {
        /* line 64, ../sass/_keyframes.sass */
        0% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
        }

        /* line 66, ../sass/_keyframes.sass */
        100% {
            transform: rotate(359deg);
            -webkit-transform: rotate(359deg);
            -moz-transform: rotate(359deg);
            -ms-transform: rotate(359deg);
            -o-transform: rotate(359deg);
        }
    }

    /* line 21, ../sass/offline-theme-slide.sass */
    .offline-ui {
        -webkit-border-radius: 0 0 4px 4px;
        -moz-border-radius: 0 0 4px 4px;
        -ms-border-radius: 0 0 4px 4px;
        -o-border-radius: 0 0 4px 4px;
        border-radius: 0 0 4px 4px;
        font-family: "Helvetica Neue", sans-serif;
        padding: 1em;
        width: 38em;
        max-width: 100%;
        overflow: hidden;
    }
    @media (max-width: 38em) {
        /* line 21, ../sass/offline-theme-slide.sass */
        .offline-ui {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            -o-border-radius: 0;
            border-radius: 0;
        }
    }
    /* line 32, ../sass/offline-theme-slide.sass */
    .offline-ui .offline-ui-retry {
        position: absolute;
        right: 3em;
        top: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.1);
        text-decoration: none;
        color: inherit;
        line-height: 3.5em;
        height: 3.5em;
        margin: auto;
        padding: 0 1em;
    }
    /* line 45, ../sass/offline-theme-slide.sass */
    .offline-ui.offline-ui-up {
        -webkit-animation: offline-dropout forwards 0.5s 2s;
        -moz-animation: offline-dropout forwards 0.5s 2s;
        -ms-animation: offline-dropout forwards 0.5s 2s;
        -o-animation: offline-dropout forwards 0.5s 2s;
        animation: offline-dropout forwards 0.5s 2s;
        -webkit-backface-visibility: hidden;
        background: #d6e9c6;
        color: #468847;
    }
    /* line 50, ../sass/offline-theme-slide.sass */
    .offline-ui.offline-ui-down {
        -webkit-animation: offline-dropin 0.5s;
        -moz-animation: offline-dropin 0.5s;
        -ms-animation: offline-dropin 0.5s;
        -o-animation: offline-dropin 0.5s;
        animation: offline-dropin 0.5s;
        -webkit-backface-visibility: hidden;
        background: #ec8787;
        color: #551313;
    }
    /* line 55, ../sass/offline-theme-slide.sass */
    .offline-ui.offline-ui-down.offline-ui-connecting, .offline-ui.offline-ui-down.offline-ui-waiting {
        background: #f8ecad;
        color: #7c6d1f;
        padding-right: 3em;
    }
    /* line 60, ../sass/offline-theme-slide.sass */
    .offline-ui.offline-ui-down.offline-ui-connecting:after, .offline-ui.offline-ui-down.offline-ui-waiting:after {
        -webkit-animation: offline-rotation 0.7s linear infinite;
        -moz-animation: offline-rotation 0.7s linear infinite;
        -ms-animation: offline-rotation 0.7s linear infinite;
        -o-animation: offline-rotation 0.7s linear infinite;
        animation: offline-rotation 0.7s linear infinite;
        -webkit-backface-visibility: hidden;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        content: " ";
        display: block;
        position: absolute;
        right: 1em;
        top: 0;
        bottom: 0;
        margin: auto;
        height: 1em;
        width: 1em;
        border: 2px solid rgba(0, 0, 0, 0);
        border-top-color: #7c6d1f;
        border-left-color: #7c6d1f;
        opacity: 0.7;
    }
    /* line 77, ../sass/offline-theme-slide.sass */
    .offline-ui.offline-ui-down.offline-ui-waiting {
        padding-right: 11em;
    }
    /* line 80, ../sass/offline-theme-slide.sass */
    .offline-ui.offline-ui-down.offline-ui-waiting.offline-ui-reconnect-failed-2s {
        padding-right: 0;
    }
    .pace {
        -webkit-pointer-events: none;
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .pace-inactive {
        display: none;
    }

    .pace .pace-progress {
        background: #7272EB;
        position: fixed;
        z-index: 2000;
        top: 0;
        right: 100%;
        width: 100%;
        height: 2px;
    }

    .pace .pace-progress-inner {
        display: block;
        position: absolute;
        right: 0px;
        width: 100px;
        height: 100%;
        box-shadow: 0 0 10px #d35641, 0 0 5px #7272EB;
        opacity: 1.0;
        -webkit-transform: rotate(3deg) translate(0px, -4px);
        -moz-transform: rotate(3deg) translate(0px, -4px);
        -ms-transform: rotate(3deg) translate(0px, -4px);
        -o-transform: rotate(3deg) translate(0px, -4px);
        transform: rotate(3deg) translate(0px, -4px);
    }

    .pace .pace-activity {
        display: block;
        position: fixed;
        z-index: 2000;
        top: 15px;
        right: 15px;
        width: 14px;
        height: 14px;
        border: solid 2px transparent;
        border-top-color: #7272EB;
        border-left-color: #7272EB;
        border-radius: 10px;
        -webkit-animation: pace-spinner 400ms linear infinite;
        -moz-animation: pace-spinner 400ms linear infinite;
        -ms-animation: pace-spinner 400ms linear infinite;
        -o-animation: pace-spinner 400ms linear infinite;
        animation: pace-spinner 400ms linear infinite;
    }

    @-webkit-keyframes pace-spinner {
        0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @-moz-keyframes pace-spinner {
        0% { -moz-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @-o-keyframes pace-spinner {
        0% { -o-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @-ms-keyframes pace-spinner {
        0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
    }
    @keyframes pace-spinner {
        0% { transform: rotate(0deg); transform: rotate(0deg); }
        100% { transform: rotate(360deg); transform: rotate(360deg); }
    }

    .cs-page-loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: all .4s .2s ease-in-out;
        transition: all .4s .2s ease-in-out;
        background-color: #fff;
        opacity: 0;
        visibility: hidden;
        z-index: 9999;
    }
    .cs-page-loading.active {
        opacity: 1;
        visibility: visible;
    }
    .cs-page-loading-inner {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: opacity .2s ease-in-out;
        transition: opacity .2s ease-in-out;
        opacity: 0;
    }
    .cs-page-loading.active > .cs-page-loading-inner {
        opacity: 1;
    }
    .cs-page-loading-inner > span {
        display: block;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: normal;
        color: #737491;
    }
    .cs-page-spinner {
        display: inline-block;
        width: 2.75rem;
        height: 2.75rem;
        margin-bottom: .75rem;
        vertical-align: text-bottom;
        border: .15em solid #766df4;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: spinner .75s linear infinite;
        animation: spinner .75s linear infinite;
    }
    @-webkit-keyframes spinner {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes spinner {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

</style>
<!-- Page loading scripts-->
<script>
    // (function () {
    //     window.onload = function () {
    //         var preloader = document.querySelector('.cs-page-loading');
    //         preloader.classList.remove('active');
    //         setTimeout(function () {
    //             preloader.remove();
    //         }, 2000);
    //     };
    // })();

</script>
<!-- Vendor Styles-->
<link rel="stylesheet" media="screen" href="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.css">
<!-- Main Theme Styles + Bootstrap-->
<link rel="stylesheet" media="screen" href="https://demo.createx.studio/around/css/theme.min.css">

<link rel="stylesheet" media="screen" href="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.css">
</head>

<body style="margin: 0px;">
<style>

    #breakaway-union-button {
        border: none;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
        font-weight: 500;
        border-radius: 5px;
        margin: auto;
        width: 300px;
        transition: .5s;

    }

    #breakaway-union-button.dark-mode {
        background-color: #1F1F1F;
        color: white;
        transition: .5s;

    }

    #breakaway-union-button.light-mode {
        background-color: #f5f5f5;
        color: #525252;
        transition: .5s;
    }

    .unionSSO.dot {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .unionSSO.dot.dark-mode {
        background: #1F1F1F;
    }

    .unionSSO.float-l {
        float: left !important;
    }

    .unionSSO.inner {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .unionSSO.logo {
        width: 35px;
        height: auto;
        transition: 0.5s;
    }

    .unionSSO.button-text {
        /*padding-top: 2px;*/
        float: right;
    }

    .unionSSO.logo.interaction.dark-mode {
        filter: brightness(1) invert(0);
        transition: 0.5s;
    }

    #breakaway-union-button:hover .unionSSO.logo.interaction,
    #breakaway-union-button:focus .unionSSO.logo.interaction {
        filter: brightness(0) invert(1);

    }

    #breakaway-union-button .unionSSO.logo.interaction.active {
        filter: brightness(0) invert(1);

    }

    #breakaway-union-button:hover .unionSSO.button-text.interaction {

    }
    .raise:hover {
        box-shadow: inset 0px 33px 35px 0 #3A91C8,
        inset 0 40px 25px 0px #6ECDA6,
        inset 0 66px 15px 0px #FE9DAC,
        inset 0 99px 5px 0px #8B46DD,
        0 0.5em 0.5em -0.4em #dedede;

        transform: translateY(-0.25em) scale(1.01);
    }
    .raise:active {
        box-shadow: inset 0px 33px 35px 0 #6ECDA6,
        inset 0 20px 25px 0px #6ECDA6,
        inset 0 50px 15px 0px #FE9DAC,
        inset 0 99px 5px 0px #8B46DD,
        0 0.5em 0.5em -0.4em #dedede;

        transform: translateY(0.25em) scale(.99);
    }

    #breakaway-union-button:hover .unionSSO.button-text.interaction.dark-mode {
        color:white;
    }
    @keyframes gradient-animation {
        0% {
            background-position: 0% 50%;
            transform: scale(1);
            box-shadow: 0 0px 0px 0px #ededed;
        }
        50% {
            background-position: 100% 50%;
            transform: scale(1.03);
            box-shadow: 0 10px 15px 10px #ededed;
        }
        100% {
            background-position: 0% 50%;
            transform: scale(1);
            box-shadow: 0 0px 0px 0px #ededed;
        }
    }
    .unionSSO.processing{
        background: linear-gradient(-45deg, #6ECDA6, #FF0EA9, #8B46DD, #FE9DAC, #3A91C8, #90CDBB);
        transform: translateY(0.25em) scale(1);
        background-size: 400% 400%;
        box-shadow: 0 10px 15px 0px #ededed;
        animation: gradient-animation 5s ease infinite;
        color: white;

        transition: 0.5s;

    }
</style>

<main class="cs-page-wrapper d-flex flex-column ">
<header class="navbar navbar-expand-lg navbar-light bg-light navbar-box-shadow">
    <div class="container px-0 px-xl-3">
        <a class="navbar-brand order-lg-1 mr-0 pr-lg-2 mr-lg-4" href="#">
            <img class="d-none d-lg-block"  width="35" src="../../src/media/images/slately_logo_large_untexted.png" alt="Slately"/>
            <img class="d-lg-none" width="30" src="../../src/media/images/slately_logo_large_untexted.png" alt="Slately"/>
        </a>
        <div class="d-flex align-items-center order-lg-3">
            <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarCollapse3">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-secondary  mr-1 d-none d-lg-block" type="button">Host your Venue</button>
<!--            <div class="navbar-tool d-none d-sm-flex"><a class="navbar-tool-icon-box" href="#"><i class="fe-maximize"></i> </a> Your Pass</div>-->
            <div class="border-left mr-3 ml-3" style="height: 30px;"></div>
            <div class="navbar-tool dropdown">
                <a class="navbar-tool-icon-box" href="#">
                    <img class="navbar-tool-icon-box-img" src="../../src/media/images/default_profile.png" alt="Avatar"/>
                </a>
                <a class="navbar-tool-label dropdown-toggle" href="#"><small><?php echo (\Union\API\security\Auth::logged_in() ? "Hello," : "Hey There!") ?></small> <?php if (\Union\API\security\Auth::logged_in()) {
                    echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in());
                }else{
                    echo "<span onclick='window.location = \"login.php\"'>Login or Signup</span>";
                    }?></a>
                <ul class="dropdown-menu dropdown-menu-right <?php if (!\Union\API\security\Auth::logged_in()) echo "d-none";?>" style="width: 15rem;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-shopping-bag font-size-base opacity-60 mr-2"></i>
                            Orders
                            <span class="nav-indicator"></span>
                            <span class="ml-auto font-size-xs text-muted">2</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-dollar-sign font-size-base opacity-60 mr-2"></i>
                            Sales
                            <span class="ml-auto font-size-xs text-muted">$735.00</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-message-square font-size-base opacity-60 mr-2"></i>
                            Messages
                            <span class="nav-indicator"></span>
                            <span class="ml-auto font-size-xs text-muted">1</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-users font-size-base opacity-60 mr-2"></i>
                            Followers
                            <span class="ml-auto font-size-xs text-muted">146</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-star font-size-base opacity-60 mr-2"></i>
                            Reviews
                            <span class="ml-auto font-size-xs text-muted">15</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-heart font-size-base opacity-60 mr-2"></i>
                            Favorites
                            <span class="ml-auto font-size-xs text-muted">6</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-log-out font-size-base opacity-60 mr-2"></i>
                            Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse order-lg-2" id="navbarCollapse1">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Dropdown</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action link</a></li>
                        <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action link</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><a class="dropdown-item" href="#">Yet another link</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
</header>
    <section class="jarallax bg-dark py-4 animate__animated animate__fadeIn <?php echo (\Union\API\security\Auth::logged_in()) ? "d-none" : "";?>" style="background-image: url(&quot;https://visiteurope.com/wp-content/uploads/Events4.jpg&quot;); background-repeat: no-repeat; background-size: cover" data-jarallax="" data-speed="0.25">

        <div class="container py-5 py-sm-7 text-center">
            <div class="py-md-6">
                <p class="pt-5  d-sm-block d-md-none">&nbsp;</p>
                <h1 class="text-light pb-1  animate__animated animate__fadeInUp">The World's first All-in-One Event Management 🥂</h1>
                <p class="font-size-lg text-light animate__animated animate__fadeInUp" style="animation-delay: .3s">All you have to do is hit "book", we handle everything else.</p>
                <button type="button" class="btn btn-warning btn-raise mt-3">Learn More <i class="ml-2 fe-arrow-down animate__animated animate__zoomIn"></i></button>
                <p class="pb-5  d-sm-block d-md-none">&nbsp;</p>
            </div>
        </div>
       </section>
    <section class="jarallax bg-faded-dark py-0 animate__animated animate__fadeIn <?php echo (\Union\API\security\Auth::logged_in()) ? "" : "d-none";?>" >

        <div class="container py-2 py-sm-7 text-center">
            <div class="py-md-6">
                <p class="pt-5  d-sm-block d-md-none">&nbsp;</p>
                <h1 class=" pb-1  animate__animated animate__fadeInUp text-primary"><?php echo $greeting . ", " . \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in()) . "!"?></h1>
                <p class="font-size-lg text-muted animate__animated animate__fadeInUp" style="animation-delay: .3s">Looks like you don't have any events coming up.</p>
                <button type="button" class="btn btn-primary mt-3 animate__animated animate__fadeInUp" style="animation-delay: .5s">Browse Venues<i class="ml-2 fe-compass "></i></button>
                <p class="pb-5  d-sm-block d-md-none">&nbsp;</p>
            </div>
        </div>
    </section>
    <span>
    <div class="row align-center center center-text ">

    <form class="mx-auto bg-overlay-content btn-raise d-flex align-items-center" style="margin-top: -50px;">
<!--        <button class="btn btn-primary btn-raise p-4 d-flex align-items-center pl-5 pr-5 mr-2" type="button"><i class="float-left fe-compass mr-2 h1 mb-0 text-white vertical-center"></i><span class="float-right text-left ml-3"><span class="font-size-md text-white opacity-75 ">Looking for a venue?</span><br><span class="h3 text-white">Browse Venues</span></span></button>-->
    <?php
    // Main action button decision
    if (\Union\API\security\Auth::logged_in()){
        echo "
            <button class=\"btn float-left btn-success btn-raise p-4 d-flex align-items-center pl-5 pr-5 animate__animated animate__zoomIn\" style=\"animation-delay: 0s\" type=\"button\">
            <i class=\"float-left fe-maximize mr-2 h1 mb-0 text-white vertical-center animate__animated animate__zoomIn\"></i>
            <span class=\"float-right text-left ml-3\">
                <span class=\"font-size-md text-white opacity-75 animate__animated animate__fadeIn\" style=\"animation-delay: .2s\">
                    Are you at a venue?
                </span>
                <br>
                <span class=\"h3 text-white animate__animated animate__fadeInLeft\" style=\"animation-delay: .4s\">
                    Show your Code
                </span>
            </span>
        </button>
        
        ";
    }else{
        echo "
            <button class=\"btn btn-info btn-raise p-4 d-flex align-items-center pl-5 pr-5 animate__animated animate__zoomIn\" style=\"animation-delay: 0s\" type=\"button\">
            <i class=\"float-left fe-compass mr-2 h1 mb-0 text-white vertical-center animate__animated animate__zoomIn\"></i>
            <span class=\"float-right text-left ml-3\">
                <span class=\"font-size-md text-white opacity-75 animate__animated animate__fadeIn\" style=\"animation-delay: .2s\">
                    Are you looking for a venue?
                </span>
                <br>
                <span class=\"h3 text-white animate__animated animate__fadeInLeft\" style=\"animation-delay: .4s\">
                    Browse our Venues
                </span>
            </span>
        </button>
        ";
    }
    ?>
    </form>
    </div>
<!--    Not Logged In User-->
    <span class=" <?php echo (\Union\API\security\Auth::logged_in()) ?"d-none" : "";?>">
        <section class="container py-5 py-md-6 py-lg-7 my-3">
        <div class="row align-items-center">
          <div class="col-lg-4 col-md-5 text-center text-md-left mb-5 mb-md-0">
            <h2 class="mb-3">Our services</h2>
            <p class="text-muted mb-4 pb-2">We offer a wide range of services to manage your event fully, and if there is anything we don't offer, well match you with one of our professional planners that will take you the rest of the way!</p><a class="btn btn-primary" href="#">Plan your First Event</a>
          </div>
          <div class="col-lg-8 col-md-7 bg-position-center bg-no-repeat" style="background-image: url(https://demo.createx.studio/around/img/demo/business-consulting/services/bg-shape.svg);">
            <div class="mx-auto" style="max-width: 610px;">
              <div class="row align-items-center">
                <div class="col-sm-6">
                  <div class="bg-light box-shadow-lg rounded-lg p-4 mb-grid-gutter text-center text-sm-left"><img class="d-inline-block mb-4 mt-2" width="100" src="https://demo.createx.studio/around/img/demo/business-consulting/services/01.svg" alt="Icon">
                    <h3 class="h5 mb-2">Full-Aspect Management</h3>
                    <p class="font-size-sm">We manage every aspect of your event, and if there's anything we don't support out of the box, well find someone that can.</p>
                  </div>
                  <div class="bg-light box-shadow-lg rounded-lg p-4 mb-grid-gutter text-center text-sm-left"><img class="d-inline-block mb-4 mt-2" width="100" src="https://demo.createx.studio/around/img/demo/business-consulting/services/02.svg" alt="Icon">
                    <h3 class="h5 mb-2">Talent &amp; Event Planners</h3>
                    <p class="font-size-sm">We can find talent to perform as well as hiring a human event planner.</p>
                  </div>
                  <div class="bg-light box-shadow-lg rounded-lg p-4 mb-grid-gutter text-center text-sm-left"><img class="d-inline-block mb-4 mt-2" width="100" src="https://demo.createx.studio/around/img/demo/business-consulting/services/03.svg" alt="Icon">
                    <h3 class="h5 mb-2">Insurance &amp; Contracts</h3>
                    <p class="font-size-sm">We handle all contracts with your event. That includes music licensing fees, event worker contracts, catering and so much more.</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="bg-light box-shadow-lg rounded-lg p-4 mb-grid-gutter text-center text-sm-left"><img class="d-inline-block mb-4 mt-2" width="100" src="https://demo.createx.studio/around/img/demo/business-consulting/services/04.svg" alt="Icon">
                    <h3 class="h5 mb-2">Automatic Guest Registry</h3>
                    <p class="font-size-sm">We will manage your guest list, send out invites, and manage ticketing.</p>
                  </div>
                  <div class="bg-light box-shadow-lg rounded-lg p-4 mb-grid-gutter text-center text-sm-left"><img class="d-inline-block mb-4 mt-2" width="100" src="https://demo.createx.studio/around/img/demo/business-consulting/services/05.svg" alt="Icon">
                    <h3 class="h5 mb-2">Simple &amp; Easy Payment</h3>
                    <p class="font-size-sm">We can manage every single cost that comes with the event. We'll break it all down for you.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
        <section class="bg-secondary bg-size-cover py-5 py-md-6" style="background-image: url(img/demo/business-consulting/cta-bg.png);">
        <div class="container py-3 py-md-0">
          <div class="row align-items-center">
            <div class="col-lg-5 col-md-6 text-center text-md-left">
              <h2 class="mb-4 pb-3 pb-md-0 mb-md-0">Get a free consultation</h2>
            </div>
            <div class="col-lg-7 col-md-6">
              <form class="row needs-validation" novalidate="">
                <div class="col-sm-7 col-md-12 col-lg-7 mb-3 mb-lg-0">
                  <input class="form-control" type="email" placeholder="Your email" required="">
                  <div class="invalid-feedback">Please provide a valid email address!</div>
                </div>
                <div class="col-sm-5 col-md-12 col-lg-5">
                  <button class="btn btn-primary btn-block" type="submit">Book a Consultation</button>
                </div>
              </form>
              <div class="d-flex align-items-center justify-content-center justify-content-sm-start pt-4 pt-sm-2 pt-md-4"><i class="fe-phone font-size-xl mr-2"></i><span class="mr-2">Or call us</span><a class="nav-link-style" href="tel:+15262200459">+ 1 526 220 0459</a></div>
            </div>
          </div>
        </div>
      </section>
    </span>
</main>
<!-- Back to top button--><a class="btn-scroll-top show" href="#top" data-scroll=""><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon fe-arrow-up">   </i></a>
<!-- Vendor scrits: js libraries and plugins-->
<script src="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://demo.createx.studio/around/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/parallax-js/dist/parallax.min.js"></script>

<!-- Main theme script-->
<script src="https://demo.createx.studio/around/js/theme.min.js"></script>


<!--Jquery Plugins-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/3.0.9/pwstrength-bootstrap.min.js" integrity="sha512-HvxKicgd5m5yRIotHDzL9iFZ2PK/KzyrPqLDYPboT7WQrq3q3NuG+1eWeCZgPru4Pc7fhyPF+71qRQr7mUNWCg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js" integrity="sha512-ePSfiGQMIzYzXVQLqWoVC3yxVEHIM5Y3EGh9jPNxpf+hPuLtzPdxJX+lTC3ziPMlDgc5OsM4JThxGwN2DkWEeA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/offline-js/0.7.19/offline.min.js" integrity="sha512-KTivTC9CKUCyHiWM0wIqmkGMlMPREqaQlPIXcEMzza3fceLHnyuzJ00VSRw75TUXQE80MmugpySjAVu75S+bNg==" crossorigin="anonymous"></script>