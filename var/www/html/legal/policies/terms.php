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
            <h2><strong>Terms and Conditions</strong></h2>

            <p>Welcome to Gather!</p>

            <p>These terms and conditions outline the rules and regulations for the use of GatherGVL, LLC's Website, located at https://one.gathergreenville.com.</p>

            <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use Gather if you do not agree to take all of the terms and conditions stated on this page.</p>

            <p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>

            <h3><strong>Cookies</strong></h3>

            <p>We employ the use of cookies. By accessing Gather, you agreed to use cookies in agreement with the GatherGVL, LLC's Privacy Policy. </p>

            <p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>

            <h3><strong>License</strong></h3>

            <p>Unless otherwise stated, GatherGVL, LLC and/or its licensors own the intellectual property rights for all material on Gather. All intellectual property rights are reserved. You may access this from Gather for your own personal use subjected to restrictions set in these terms and conditions.</p>

            <p>You must not:</p>
            <ul>
                <li>Republish material from Gather</li>
                <li>Sell, rent or sub-license material from Gather</li>
                <li>Reproduce, duplicate or copy material from Gather</li>
                <li>Redistribute content from Gather</li>
            </ul>

            <p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href="https://www.termsandconditionsgenerator.com">Terms And Conditions Generator</a> and the <a href="https://www.generateprivacypolicy.com">Privacy Policy Generator</a>.</p>

            <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. GatherGVL, LLC does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of GatherGVL, LLC,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, GatherGVL, LLC shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>

            <p>GatherGVL, LLC reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>

            <p>You warrant and represent that:</p>

            <ul>
                <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
                <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
                <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
                <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
            </ul>

            <p>You hereby grant GatherGVL, LLC a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>

            <h3><strong>Hyperlinking to our Content</strong></h3>

            <p>The following organizations may link to our Website without prior written approval:</p>

            <ul>
                <li>Government agencies;</li>
                <li>Search engines;</li>
                <li>News organizations;</li>
                <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
                <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
            </ul>

            <p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>

            <p>We may consider and approve other link requests from the following types of organizations:</p>

            <ul>
                <li>commonly-known consumer and/or business information sources;</li>
                <li>dot.com community sites;</li>
                <li>associations or other groups representing charities;</li>
                <li>online directory distributors;</li>
                <li>internet portals;</li>
                <li>accounting, law and consulting firms; and</li>
                <li>educational institutions and trade associations.</li>
            </ul>

            <p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of GatherGVL, LLC; and (d) the link is in the context of general resource information.</p>

            <p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>

            <p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to GatherGVL, LLC. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>

            <p>Approved organizations may hyperlink to our Website as follows:</p>

            <ul>
                <li>By use of our corporate name; or</li>
                <li>By use of the uniform resource locator being linked to; or</li>
                <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
            </ul>

            <p>No use of GatherGVL, LLC's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>

            <h3><strong>iFrames</strong></h3>

            <p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>

            <h3><strong>Content Liability</strong></h3>

            <p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>

            <h3><strong>Your Privacy</strong></h3>

            <p>Please read Privacy Policy</p>

            <h3><strong>Reservation of Rights</strong></h3>

            <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>

            <h3><strong>Removal of links from our website</strong></h3>

            <p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>

            <p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>

            <h3><strong>Disclaimer</strong></h3>

            <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>

            <ul>
                <li>limit or exclude our or your liability for death or personal injury;</li>
                <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
                <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
            </ul>

            <p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>

            <p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
        </div></section></main>