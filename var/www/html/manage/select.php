<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.security");
\Union\PKG\Autoloader::import__require("API.accounts, API.venues");

\Union\API\security\Auth::bounce_back();
if (isset($_GET['destination'], $_GET['target'])){
    if (preg_match('/^[A-Za-z0-9-]+$/D', $_GET['target'])) {
        \Union\API\venues\ActiveVenue::set($_GET['target']);
        header("Location: " . SLATELY_WEBSTACK_HREF_PAGE_ROUTE . "?" . $_SERVER['QUERY_STRING']);
    }
}
?>

<?php require_once "/lib/union/lib/REST/v1/API/web/UI/resources/elements/container/container_start.php"; ?>
<meta charset="utf-8">
<title>Slately for Venues | Your Venues
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/odometer@0.4.8/themes/odometer-theme-minimal.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">

<link rel="mask-icon" color="#5bbad5" href="https://demo.createx.studio/around/safari-pinned-tab.svg">
<meta name="msapplication-TileColor" content="#766df4">
<link rel="manifest" href="../../src/media/images/favicons/site.webmanifest">
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


    <!-- Actual content-->
    <div class="mt-5 ml-5  d-none d-md-block ">
        <img src="../../src/media/images/slately_logo_large_texted.png" class="mr-3 animate__animated animate__fadeInDown" width="150" alt="Media">

    </div>
    <div class=" text-center mt-5 d-md-none">
        <img src="../../src/media/images/slately_logo_large_texted.png" class="mr-3 animate__animated animate__fadeInDown" width="150" alt="Media">
    </div>
    <section class="container d-flex align-items-center pt-0 pb-0 pb-md-4" >
        <div class="w-100 ">
            <div id="selector" class="row  justify-content-center animate__animated animate__fadeIn " style="z-index: 20;  animation-duration: .25s;">

                <div class="text-center">
                    <h1 class="pb-0 mb-0">Your Venues</h1>
                    <p class="mb-5">Select a venue to continue to your destination</p>
                    <?php

                    $account_venues = \Union\API\venues\VenueSearch::get_user_associated_venues();
                    if (sizeof($account_venues) == 0){
                        echo <<<EOT
                                <div class="card text-danger  shadow-none bg-info text-left btn-hover">
                                                        <div class="card-body text-center ">
                                                            <h4 class="card-title text-white mb-0">Looks a Little Empty 😔</h4>
                                                            <p class="card-text text-white font-size-sm mt-2">You aren't managing any venues yet. <br> Click the button below to add one,<br> or talk to your manager to get an invitation.</p>
                                                        </div>
                                                    </div>
EOT;
                    }else{
                        foreach ($account_venues as $account_venue){
                            $color_selector = ["warning", "success", "danger", "primary", "info"];
                            $color = isset($color_selector[$account_venue['rank']->getRank()]) ? $color_selector[$account_venue['rank']->getRank()] : "primary";
                            echo "
                                <div class=\"btn btn-translucent-$color btn-raise text-left mt-2 btn-block\" onclick='selectVenue(\"".$account_venue['venue']->id."\")'>
                                    <div class=\"card-body\">
                                        <span class=\"badge badge-$color\">".$account_venue['rank']."</span>
                                        <p class=\"lead font-weight-bold mb-0\">".$account_venue['venue']->name->display_name."<i class='fe-arrow-right mr-1 float-right '></i></p>
                                        <p class=\"card-text font-size-sm  mt-0\"><i class='fe-compass mr-1 align-middle '></i>".$account_venue['venue']->location->address."</p>
                                    </div>
                                </div>
                            ";
                        }
                    }

                    ?>


                    <button type="button" class="btn btn-secondary btn-lg  btn-block mt-3"><i class="fe-plus mr-2"></i>Add a Venue</button>
                    <button type="button" class="btn btn-link text-warning btn-lg btn-block mt-1 font-size-md" onclick="slately.movement.back()"><i class="fe-close mr-2"></i>Cancel</button>
                    <!--                    <p class="text-center font-size-xs pt-3 mb-0 text-muted"><a  class="font-weight-medium" data-view="#USER_ACTIVATING_ACCOUNT">ACTI</a> <a  class="font-weight-medium" data-view="#USER_CONFIRM_PHONE">CONF</a>  <a class="font-weight-medium" data-view="#USER_AWIATING_CONFIRMATIONS">AA</a></p>-->
                </div>
            </div>
            <div id="progress" class="d-none">
                <div class="text-center mb-5 mt-5 animate__animated animate__fadeIn" style="display: flex;flex-direction: column;align-items: center; animation-duration: .5s;">
                    <div class="spinner">
                        <div class="leftWrapper">
                            <div class="left">
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="rightWrapper">
                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

</body>
<script>
    function selectVenue(venueID) {
        $("#selector").removeClass("animate__fadeIn");
        $("#selector").addClass("animate__fadeOut");
        setTimeout(function () {
            $("#selector").addClass("d-none")
            $("#progress").removeClass("d-none")
            setTimeout(function () {
                insertParam("target", venueID)
            }, 200)
        }, 200)

    }
    function insertParam(key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);

        // kvp looks like ['key1=value1', 'key2=value2', ...]
        var kvp = document.location.search.substr(1).split('&');
        let i=0;

        for(; i<kvp.length; i++){
            if (kvp[i].startsWith(key + '=')) {
                let pair = kvp[i].split('=');
                pair[1] = value;
                kvp[i] = pair.join('=');
                break;
            }
        }

        if(i >= kvp.length){
            kvp[kvp.length] = [key,value].join('=');
        }

        // can return this or...
        let params = kvp.join('&');

        // reload page with new params
        document.location.search = params;
    }
</script>