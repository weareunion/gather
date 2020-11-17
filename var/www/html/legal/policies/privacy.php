<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.security");
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
<div class="pt-1">
<? require_once "/lib/union/lib/REST/v1/API/web/UI/resources/elements/navbar/standard.php"?>
</div>
<main class="">

    <section class="py-6 py-sm-6" >
        <div class="container py-lg-4">
<h1>Privacy Policy for GatherGVL, LLC</h1>

<p>At Gather, accessible from https://one.gathergreenville.com, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Gather and how we use it.</p>

<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Gather. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicygenerator.info">Privacy Policy Generator</a> and the <a href="https://www.privacypolicies.com/privacy-policy-generator/">Free Privacy Policy Generator</a>.</p>

<h2>Consent</h2>

<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms. For our Terms and Conditions, please visit the <a href="https://www.privacypolicyonline.com/terms-conditions-generator/">Terms & Conditions Generator</a>.</p>

<h2>Information we collect</h2>

<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

<h2>How we use your information</h2>

<p>We use the information we collect in various ways, including to:</p>

<ul>
    <li>Provide, operate, and maintain our webste</li>
    <li>Improve, personalize, and expand our webste</li>
    <li>Understand and analyze how you use our webste</li>
    <li>Develop new products, services, features, and functionality</li>
    <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the webste, and for marketing and promotional purposes</li>
    <li>Send you emails</li>
    <li>Find and prevent fraud</li>
</ul>

<h2>Log Files</h2>

<p>Gather follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>

<h2>Cookies and Web Beacons</h2>

<p>Like any other website, Gather uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>

<p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/">"What Are Cookies" from Cookie Consent</a>.</p>



<h2>Advertising Partners Privacy Policies</h2>

<P>You may consult this list to find the Privacy Policy for each of the advertising partners of Gather.</p>

<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Gather, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>

<p>Note that Gather has no access to or control over these cookies that are used by third-party advertisers.</p>

<h2>Third Party Privacy Policies</h2>

<p>Gather's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>

<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

<p>Under the CCPA, among other rights, California consumers have the right to:</p>
<p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
<p>Request that a business delete any personal data about the consumer that a business has collected.</p>
<p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

<h2>GDPR Data Protection Rights</h2>

<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

<h2>Children's Information</h2>

<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

<p>Gather does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

        </div></section></main>