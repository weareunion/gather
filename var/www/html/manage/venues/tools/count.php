<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.security, API.interface");
\Union\PKG\Autoloader::import__require("API.accounts, API.venues, API.venues.management");
if (isset($_GET['terminate'])){
    \Union\API\security\Auth::close_session();
    header("Location: count");
    exit();
}
if (isset($_GET['go']) && !\Union\API\security\Auth::logged_in()){
    \Union\API\security\Auth::bounce_back();
}elseif(isset($_GET['go']) && \Union\API\security\Auth::logged_in()){
    header("Location: count");
}
if (\Union\API\security\Auth::logged_in()){
    \Union\API\venues\ActiveVenue::bounce_back();
}
\Union\API\Respondus\Respondus::listen();
?>

<?php require_once __DIR__ . "/../../../src/php/elements/container/container_start.php"; ?>
<meta charset="utf-8">
<title>Slately for Venues | Counter
</title>
<!-- SEO Meta Tags-->
<meta name="description" content="Around - Multipurpose Bootstrap Template">
<meta name="keywords" content="bootstrap, business, consulting, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, multipurpose, product landing, shop, software, ui kit, web studio, landing, html5, css3, javascript, gallery, slider, touch, creative">
<meta name="author" content="Createx Studio">
<!-- Viewport-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon and Touch Icons-->
<link rel="icon"  href="../../../src/media/images/favicons/favicon.ico">
<link rel="icon" type="image/png" sizes="16x16" href="../../../src/media/images/favicons/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../../src/media/images/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../../src/media/images/favicons/favicon-32x32.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/odometer@0.4.8/themes/odometer-theme-minimal.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">

<link rel="mask-icon" color="#5bbad5" href="https://demo.createx.studio/around/safari-pinned-tab.svg">
<meta name="msapplication-TileColor" content="#766df4">
<link rel="manifest" href="../../../src/media/images/favicons/site.webmanifest">
<meta name="theme-color" content="#ffffff">
<style>
    button {
        touch-action: manipulation;
    }
</style>
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
<style>
    .odometer.odometer-auto-theme, .odometer.odometer-theme-minimal {
        display: inline-block;
        vertical-align: middle;
        *vertical-align: auto;
        *zoom: 1;
        *display: inline;
        position: relative;
    }
    .odometer.odometer-auto-theme .odometer-digit, .odometer.odometer-theme-minimal .odometer-digit {
        display: inline-block;
        vertical-align: middle;
        *vertical-align: auto;
        *zoom: 1;
        *display: inline;
        position: relative;
    }
    .odometer.odometer-auto-theme .odometer-digit .odometer-digit-spacer, .odometer.odometer-theme-minimal .odometer-digit .odometer-digit-spacer {
        display: inline-block;
        vertical-align: middle;
        *vertical-align: auto;
        *zoom: 1;
        *display: inline;
        visibility: hidden;
    }
    .odometer.odometer-auto-theme .odometer-digit .odometer-digit-inner, .odometer.odometer-theme-minimal .odometer-digit .odometer-digit-inner {
        text-align: left;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
    }
    .odometer.odometer-auto-theme .odometer-digit .odometer-ribbon, .odometer.odometer-theme-minimal .odometer-digit .odometer-ribbon {
        display: block;
    }
    .odometer.odometer-auto-theme .odometer-digit .odometer-ribbon-inner, .odometer.odometer-theme-minimal .odometer-digit .odometer-ribbon-inner {
        display: block;
        -webkit-backface-visibility: hidden;
    }
    .odometer.odometer-auto-theme .odometer-digit .odometer-value, .odometer.odometer-theme-minimal .odometer-digit .odometer-value {
        display: block;
        -webkit-transform: translateZ(0);
    }
    .odometer.odometer-auto-theme .odometer-digit .odometer-value.odometer-last-value, .odometer.odometer-theme-minimal .odometer-digit .odometer-value.odometer-last-value {
        position: absolute;
    }
    .odometer.odometer-auto-theme.odometer-animating-up .odometer-ribbon-inner, .odometer.odometer-theme-minimal.odometer-animating-up .odometer-ribbon-inner {
        -webkit-transition: -webkit-transform 0.25s;
        -moz-transition: -moz-transform 0.25s;
        -ms-transition: -ms-transform 0.25s;
        -o-transition: -o-transform 0.25s;
        transition: transform 0.25s;
    }
    .odometer.odometer-auto-theme.odometer-animating-up.odometer-animating .odometer-ribbon-inner, .odometer.odometer-theme-minimal.odometer-animating-up.odometer-animating .odometer-ribbon-inner {
        -webkit-transform: translateY(-100%);
        -moz-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        -o-transform: translateY(-100%);
        transform: translateY(-100%);
    }
    .odometer.odometer-auto-theme.odometer-animating-down .odometer-ribbon-inner, .odometer.odometer-theme-minimal.odometer-animating-down .odometer-ribbon-inner {
        -webkit-transform: translateY(-100%);
        -moz-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        -o-transform: translateY(-100%);
        transform: translateY(-100%);
    }
    .odometer.odometer-auto-theme.odometer-animating-down.odometer-animating .odometer-ribbon-inner, .odometer.odometer-theme-minimal.odometer-animating-down.odometer-animating .odometer-ribbon-inner {
        -webkit-transition: -webkit-transform 0.25s;
        -moz-transition: -moz-transform 0.25s;
        -ms-transition: -ms-transform 0.25s;
        -o-transition: -o-transform 0.25s;
        transition: transform 0.25s;
        -webkit-transform: translateY(0);
        -moz-transform: translateY(0);
        -ms-transform: translateY(0);
        -o-transform: translateY(0);
        transform: translateY(0);
    }
</style>


</head>
<body style="margin: 0px;">
<main class="cs-page-wrapper d-flex flex-column">
    <div class="modal fade" id="MODAL_EXPLAIN_PASSSWORD_BAR" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Fill up the bar? What? 🧐</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>In order to keep your account safe, we use a set of sophisticated algorithms that take into account many factors such as phrases, patterns, and many others to determine how safe your password is. We don't have a checklist like normal websites, since <mark>we believe that security is more than a checklist </mark>. </p>
                    <h6>But for reference, we do always require these:</h6>
                    <ul>
                        <li>- An uppercase letter</li>
                        <li>- A lowercase letter</li>
                        <li>- A number</li>
                        <li>- A symbol</li>
                        <li>- More than 8 characters in length</li>
                    </ul>
                    <br>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        All you have to do is make a password that fills up the bar. You'll know when that happens when the bar turns <span class="text-success">green</span>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raise" data-dismiss="modal">👍 Got It</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content-->
    <!-- Background image-->

    <!-- Actual content-->
    <div class="mt-5 ml-5  d-none d-md-block ">
        <img src="../../../src/media/images/slately_logo_large_texted.png" class="mr-3 animate__animated animate__fadeInDown" width="150" alt="Media">

    </div>
    <div class=" text-center mt-5 d-md-none">
        <img src="../../../src/media/images/slately_logo_large_texted.png" class="mr-3 animate__animated animate__fadeInDown" width="150" alt="Media">
    </div>

    <section class="container d-flex align-items-center pt-0 pb-0 pb-md-4" >
        <div class="w-100 ">
            <div class="row d-flex justify-content-center animate__animated animate__fadeIn" style="z-index: 20;">

                <div class="text-center">
                    <div class="cs-view <? echo (\Union\API\security\Auth::logged_in() ? 'hide' : 'show')?>" >
                        <!-- Sign in view-->
                        <div class="cs-view animate__animated animate__fadeIn show" >
                            <h1 class="font-size-sm pb-0 mb-1 font-weight-normal"><a class="text-primary">Venue Tools</a> <i class="fe-chevron-right"></i>Counter</h1>
                            <h1 class="h1 ">Hey there Stranger 🤠</h1>
                            <p class="font-size-ms text-muted mb-4">Sign in to your Slately account to continue.</p>
                            <div class="border-top text-center animate__animated animate__fadeInUp mt-4 pt-4 mt-3 mb-3"></div>
                            <div novalidate="">
                                <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_EMAIL_ALERT" role="alert">
                                    <i class="fe-alert-triangle font-size-xl mr-1"></i>
                                    <span id="LOGIN_EMAIL_ALERT_BODY"></span>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="LOGIN_EMAIL_BUTTON_CONTINUE" onclick="window.location.href += '?go'">Sign In with Slately <i class="fe-arrow-right ml-1"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="cs-view <? echo (\Union\API\security\Auth::logged_in() ? 'show' : 'hide')?>" >
<!--                        Counter Mode-->
                        <div id="counter_mode" class="cs-view animate__animated animate__fadeIn " >
                            <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">You're logged in as <? echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in()) . " " .  \Union\API\accounts\Account::get_last_name(\Union\API\security\Auth::logged_in())?>. <a class="text-primary" onclick="window.location += '?terminate'">Log Out.</a></h1>
                            <div class="display-1 pt-3 mb-0 pb-0 odometer count_target" id=""></div>
                            <p class="pb-3" onclick="Page.toggle_mode()"><a class="text-primary">Switch to View Mode</a></p>
                            <button type="button" class="btn btn-primary btn-lg btn-block btn-raise" onclick="Page.increase(5)"><h5 class="m-1 text-white"><i class="fe-chevron-up mr-1"></i>5 </h5></button>
                            <button type="button" class="btn btn-primary btn-lg btn-block btn-raise" onclick="Page.increase(1)"><h3 class="m-3 text-white"><i class="fe-chevron-up mr-1"></i>1 </h3></button>

                            <button type="button" class="btn btn-danger btn-lg btn-block btn-raise" id="dec_1" onclick="Page.decrease(1)"><h3 class="m-3 text-white"><i class="fe-chevron-down mr-1"></i>1 </h3></button>
                            <button type="button" class="btn btn-danger btn-lg btn-block btn-raise" id="dec_5" onclick="Page.decrease(5)"><h5 class="m-1 text-white"><i class="fe-chevron-down mr-1"></i>5 </h5></button>
                            <button type="button" class="btn btn-secondary btn-lg btn-block" id="reset" onclick="Page.reset()"><h3 class="m-1 "><i class="fe-rotate-cw mr-1"></i></h3></button>
                        </div>
<!--                        View Mode-->
                        <div id="view_mode" class="cs-view animate__animated animate__fadeIn show" onclick="" >
                            <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">You're logged in as <? echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in()) . " " .  \Union\API\accounts\Account::get_last_name(\Union\API\security\Auth::logged_in())?>. <a class="text-primary" onclick="window.location += '?terminate'">Log Out.</a></h1>

                            <div class="display-1 pt-3 mb-0 pb-0 odometer count_target" ></div>
                            <p class="pb-3" onclick="Page.toggle_mode()"><a class="text-primary">Switch to Count Mode</a></p>
                            <button type="button" class="btn btn-primary" onclick="alert('test');">
                                <i class="fe-file-text mr-2"></i>
                                Download a Report
                            </button>
<!--                            <h5>Trendline</h5>-->
<!--                            <p>View the average attendance of your venue.</p>-->



                            <!--                            <div class="btn-group btn-group-lg" role="group" aria-label="Solid button group">-->
                            <!--                                <button type="button" class="btn bt btn-primary"><h3 class="m-3 text-white">+1 </h3></button>-->
                            <!--                                <button type="button" class="btn btn-secondary">Reset</button>-->
                            <!--                                <button type="button" class="btn bt btn-primary"><h3 class="m-3 text-white pr-1">-1 </h3></button>-->
                            <!--                            </div>-->
                            <!--                            <h1 class="h1 ">Hey there Stranger 🤠</h1>-->
                            <!--                            <p class="font-size-ms text-muted mb-4">Sign in to your Slately account to continue.</p>-->
                            <!--                            <div class="border-top text-center animate__animated animate__fadeInUp mt-4 pt-4 mt-3 mb-3"></div>-->
                            <!--                            <div novalidate="">-->
                            <!--                                <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_EMAIL_ALERT" role="alert">-->
                            <!--                                    <i class="fe-alert-triangle font-size-xl mr-1"></i>-->
                            <!--                                    <span id="LOGIN_EMAIL_ALERT_BODY"></span>-->
                            <!--                                </div>-->
                            <!--                                <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="LOGIN_EMAIL_BUTTON_CONTINUE" onclick="window.location.href += '?go'">Sign In with Slately <i class="fe-arrow-right ml-1"></i></button>-->
                            <!--                            </div>-->
                        </div>
                    </div>

                    <!--                    <p class="text-center font-size-xs pt-3 mb-0 text-muted"><a  class="font-weight-medium" data-view="#USER_ACTIVATING_ACCOUNT">ACTI</a> <a  class="font-weight-medium" data-view="#USER_CONFIRM_PHONE">CONF</a>  <a class="font-weight-medium" data-view="#USER_AWIATING_CONFIRMATIONS">AA</a></p>-->
                </div>
            </div>

        </div>
    </section>

    <div style="position: relative;  z-index: 0;" class="cs-view animate__animated animate__fadeInUp <? echo (\Union\API\security\Auth::logged_in() ? 'show' : '')?>" id="graph_view">

    <div class="chart-container" style="pointer-events:none !important; position: absolute; bottom: 0; width: 100vw; height: 40vh;">
        <canvas id="myChart" style="position: absolute; bottom: 0; max-height: 30vh; z-index: -1;"></canvas>
    </div>
    </div>
</main>
<script>
    window.odometerOptions = {
        auto: true,
        duration: 3000, // Change how long the javascript expects the CSS animation to take
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.bundle.min.js"></script>
<script src="http://github.hubspot.com/odometer/odometer.js"></script>

<script>
    Chart.defaults.global.responsive = true;
    let data = {
        max: null,
        min: null,
        avg: null,
        previous: null
    }
     data.max = [190, 155, 200, 200, 200, 200];
     data.min = [92, 135, 173, 200, 200, 165];
     data.avg = [145, 142, 180, 200, 200, 180];
     data.previous = [122, 192, 180, 190, 194, 190];
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['5:00 pm', '5:15 pm', '5:30 pm', '5:45 pm', '6:00 pm', 'Now'],
            datasets: [{
                label: 'Average',
                data: data.avg,
                backgroundColor: [
                    'rgba(244, 244, 255, 1.00)'
                ],
                borderColor: [
                    'rgba(118, 109, 244, 1.00)'
                ],
                borderWidth: 3
            },{
                label: 'Last Week Average',
                data: data.previous,
                backgroundColor: [
                    'rgba(242, 247, 255, 0)'
                ],
                borderColor: [
                    'rgba(93, 154, 252, 1.00)'
                ],
                borderDash: [10,5],
                borderWidth: 3
            }]
        },
        options: {
            fill: 'rgba(118, 109, 244, 1.00)',
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: Math.min.apply(this, data.min),
                        max: Math.max.apply(this, data.max)+10,
                        callback: function(value, index, values) {
                            if (index === values.length - 1) return Math.min.apply(this, data.min);
                            else if (index === 0) return Math.max.apply(this, data.max)+10;
                            else return '';
                        },
                        display: false,
                        minRotation: 90
                    },
                    gridLines: {
                        drawOnChartArea: false,
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: false,
                        display: false,
                        minRotation: 90
                    },
                    gridLines: {
                        drawOnChartArea: false,
                        drawBorder: false
                    }
                }]
            }
        }
    });
</script>
<script>

    let Page = {};
    Page.user = {};
    Page.user.mode = 'view';
    Page.count = 0;
    Page.delta = 0;
    Page.count_ready = false;
    Page.init = function(){

    }
    Page.increase = function(amount) {
        Page.beacon.getCurrentCount();
        Page.delta += amount;
        Page.count += amount;
        Page.update_count();
    }
     Page.decrease = function(amount) {
        Page.beacon.getCurrentCount();
        if ((Page.count - amount) < 0){
            Page.count = 0;
        }else {
            Page.count -= amount;
            Page.delta -= amount;
        }
        Page.update_count();
    }
    Page.reset = function(amount) {
        Page.beacon.hesitation = 20000;
        Page.count = 0;
        Page.delta -= Page.count;
        Page.update_count();
    }
    Page.update_count = function(stopPost=false) {
        if (!stopPost)Page.beacon.hesitate();
        if (Page.count <= 5){
            $("#dec_5").addClass("disabled");
            if (Page.count <=1){
                $("#dec_1").addClass("disabled");
            }
            if (Page.count === 0){
                $("#reset").addClass("disabled");
            }
        }
        if (Page.count >= 1){
            $("#dec_1").removeClass("disabled");
            if (Page.count >=5){
                $("#dec_5").removeClass("disabled");
            }
            if (Page.count > 0){
                $("#reset").removeClass("disabled");
            }
        }
        Page.modify_count(Page.count);
    }
    Page.modify_count = function(number) {
        $(".count_target").each(function(){
            $(this).html(number)
        });
    }
    Page.toggle_mode = function(){
        if (Page.user.mode === 'view'){
            Page.user.mode = 'count'
        }else {
            Page.user.mode = 'view'
        }
        if (Page.user.mode === 'count'){
            $("#counter_mode").addClass('show')
            $("#view_mode").removeClass('show')
            $("#graph_view").removeClass('show')
        }else {
            $("#counter_mode").removeClass('show')
            $("#view_mode").addClass('show')
            $("#graph_view").addClass('show')
        }
    }
    Page.beacon = {};
    Page.beacon.timeout = null;
    Page.beacon.hesitate = function(){
        clearTimeout(Page.beacon.timeout);
        Page.beacon.wake();
    }
    Page.beacon.hesitation = 1000;
    Page.beacon.wake = function(){
        Page.beacon.timeout = setTimeout(Page.beacon.send, Page.beacon.hesitation);
    }
    Page.beacon.send = function(){
        if (Page.count_ready === false) return;
        Page.beacon.hesitation = 1000;
        let server = new HTTPClient();
        server.set_service("API.venues.management.tools.counter");
        server.set_action("push_update");
        server.set_data({
            delta: Page.delta
        });
        server.send().then(function (){
            Page.delta = 0;
        }).catch(

        );
    }
    Page.beacon.getCurrentCount = function(){
        return new Promise(function (resolve, reject) {
            Page.count_ready = true;
            let server_count = Page.count;
            Page.count = server_count;
            Page.update_count(true);
            resolve(server_count);
        })

    }
    $(document).ready(function () {
        Page.beacon.getCurrentCount();
    });
</script>
</body>
