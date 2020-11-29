<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.security");
\Union\PKG\Autoloader::import__require("API.accounts");
\Union\PKG\Autoloader::import__require("API.interface");
$_SESSION['FLAG_DEVELOPER_VERBOSE'] = true;
\Union\API\Respondus\Respondus::listen();
$fill_in_target = false;
if (isset($_GET['action']) && $_GET['action'] == 'accountAspectValidation'){
    if (isset($_GET['type']) && $_GET['type'] == 'phone'){
        if(isset($_GET['target'], $_GET['validation'])){
            \Union\API\accounts\Registration::confirm_number(base64_decode(urldecode($_GET['target'])), urldecode($_GET['validation']));

            $fill_in_target = true;
        };
    }
    if (isset($_GET['type']) && $_GET['type'] == 'email'){
        if(isset($_GET['target'], $_GET['validation'])){
            try {
                \Union\API\accounts\Registration::confirm_email(base64_decode(urldecode($_GET['target'])), urldecode($_GET['validation']));
                $fill_in_target = true;
            }catch (\Exception $exception){}
        };
    }
}
if (isset($_GET['action']) && ($_GET['action'] === 'terminate' || $_GET['action'] === 'logout')){
    \Union\API\security\Auth::close_session();
}
$fill_in_data = "";
if ($fill_in_target){
    $fill_in_data = base64_decode(urldecode($_GET['target']));
}else {
    $remember_me = \Union\API\security\Auth::get_remember_me();
    if (!$fill_in_target && $remember_me) {
        $fill_in_target = true;
        $fill_in_data = $remember_me['user'];
    }
}
if (\Union\API\security\Auth::logged_in()){
    header("Location: route");
    ob_flush();
}

?>

<?php require_once __DIR__ . "/src/php/elements/container/container_start.php";?>
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
    <link rel="icon"  href="src/media/images/favicons/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="src/media/images/favicons/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="src/media/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="src/media/images/favicons/favicon-32x32.png">


    <link rel="mask-icon" color="#5bbad5" href="https://demo.createx.studio/around/safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#766df4">
    <link rel="manifest" href="src/media/images/favicons/site.webmanifest">
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
    <div class="d-none d-md-block position-absolute w-50 h-100 bg-size-cover animate__animated animate__fadeIn" style="top: 0; right: 0; background-image: url(https://demo.createx.studio/around/img/demo/coworking/illustration02.svg);"></div>
    <!-- Actual content-->
    <div class="mt-5 ml-5  d-none d-md-block ">
        <img src="src/media/images/slately_logo_large_texted.png" class="mr-3 animate__animated animate__fadeInDown" width="150" alt="Media">

    </div>
    <div class=" text-center mt-5 d-md-none">
        <img src="src/media/images/slately_logo_large_texted.png" class="mr-3 animate__animated animate__fadeInDown" width="150" alt="Media">
    </div>
    <section class="container d-flex align-items-center pt-0 pb-0 pb-md-4" style="flex: 1 0 auto;">
        <div class="w-100 ">
            <div class="row animate__animated animate__fadeIn">

                <div class="col-lg-4 col-md-6 offset-lg-1">
                    <div class="cs-view show" id="USER_INPUT_OPTIONS">
                    <!-- Sign in view-->
                    <div class="cs-view animate__animated animate__fadeIn show" id="signin-view">
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Log In to Slately</h1>
                        <h1 class="h1 ">Good to see ya! 👋</h1>
                        <p class="font-size-ms text-muted mb-4">Sign in to your Slately account to continue.</p>
                        <div novalidate="">
                            <div class="input-group-overlay form-group">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-user"></i></span></div>
                                <input class="form-control prepended-form-control form-control-lg" id="LOGIN_EMAIL_INPUT" value="<?php if($fill_in_target){ echo $fill_in_data;} ?>" placeholder="Email or Phone Number" oninput="this.value = InputManager.types.accounts.userID.dynamicFormat.string(this.value); $('#LOGIN_EMAIL_BUTTON_CONTINUE')[0].disabled = !InputManager.types.accounts.userID.dynamicFormat.validate(this.value)" required="">
                            </div>
                            <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_EMAIL_ALERT" role="alert">
                                <i class="fe-alert-triangle font-size-xl mr-1"></i>
                                <span id="LOGIN_EMAIL_ALERT_BODY"></span>
                            </div>
<!--                            <div class="input-group-overlay cs-password-toggle form-group">-->
<!--                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-lock"></i></span></div>-->
<!--                                <input class="form-control prepended-form-control" type="password" placeholder="Password" required="">-->
<!--                                <label class="cs-password-toggle-btn">-->
<!--                                    <input class="custom-control-input" type="checkbox"><i class="fe-eye cs-password-toggle-indicator"></i><span class="sr-only">Show password</span>-->
<!--                                </label>-->
<!--                            </div>-->
<!--                            <div class="d-flex justify-content-between align-items-center form-group">-->
<!--                                <div class="custom-control custom-checkbox">-->
<!--                                    <input class="custom-control-input" type="checkbox" id="keep-signed-2">-->
<!--                                    <label class="custom-control-label" for="keep-signed-2">Keep me signed in</label>-->
<!--                                </div><a class="nav-link-style font-size-ms" href="password-recovery.html">Forgot password?</a>-->
<!--                            </div>-->
                            <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="LOGIN_EMAIL_BUTTON_CONTINUE" disabled>Continue <i class="fe-arrow-right ml-1"></i></button>
                            <button type="button" class="btn btn-block btn-lg mb-3 btn-primary btn-raise d-none" id="LOGIN_EMAIL_BUTTON_CONTINUE_PROGRESS" disabled>
                                <span class="spinner-border spinner-border-sm mr-2 " style="width: 1.3rem; height: 1.3rem;" role="status" aria-hidden="true"></span>
<!--                                One Moment...-->
                            </button>
                            <p class="font-size-sm pt-3 mb-0">Don't have an account? <a href="#" class="font-weight-medium" data-view="#signup-view">Sign up</a></p>
                        </div>
                    </div>
                    <!-- Sign up view-->
                    <div class="cs-view animate__animated animate__fadeIn" id="signup-view">
                        <h1 class="h2">Come join us! 🙋‍♂️</h1>
                        <p class="font-size-ms text-muted mb-4">Registration takes less than a minute but gives you full control over your orders, events, gift cards and rewards.</p>
                        <div>
                            <div class="row">

                                <div class="col-12 col-sm-6 input-group-overlay form-group">
                                        <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-user"></i></span></div>
                                        <input class="form-control prepended-form-control" id="USER_INPUT_SIGNUP_FIRSTNAME" oninput="Page.signUp.verifyFormReady();" placeholder="First Name" required>
                                </div>
                                <div class="col-12 col-sm-6 input-group-overlay form-group">
                                    <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-user"></i></span></div>
                                    <input class="form-control prepended-form-control" id="USER_INPUT_SIGNUP_LASTNAME" oninput="Page.signUp.verifyFormReady();" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group input-group-overlay">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-mail"></i></span></div>
                                <input class="form-control prepended-form-control" type="email" oninput="Page.signUp.verifyFormReady();" id="USER_INPUT_SIGNUP_EMAIL" placeholder="Email" required>
                            </div>
                            <div class="form-group input-group-overlay">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-phone"></i></span></div>
                                <input class="form-control prepended-form-control form-control-type-phone" oninput="Page.signUp.verifyFormReady();" id="USER_INPUT_SIGNUP_PHONE" type="tel" placeholder="Phone Number" required="">
                            </div>
                            <div class="cs-password-toggle input-group-overlay form-group mb-2">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-lock"></i></span></div>
                                <input class="form-control  prepended-form-control" type="password" oninput="Page.signUp.verifyFormReady();" onchange="Page.signUp.verifyFormReady();"  id="USER_INPUT_SIGNUP_PASSWORD" placeholder="Password" required="">
                                <label class="cs-password-toggle-btn">
                                    <input class="custom-control-input" type="checkbox"><i class="fe-eye cs-password-toggle-indicator"></i><span class="sr-only">Show password</span>
                                </label>
                            </div>

                            <div class="progress mb-2 mt-0" style="height: 3px;" href="#" data-toggle="modal" data-target="#MODAL_EXPLAIN_PASSSWORD_BAR" >
                                <div class="progress-bar bg-info" role="progressbar" style="width: 0%" id="SIGNUP_PASSWORD_PROGRESS_BAR" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>

                            </div>
                        <div id="SIGNUP_PASSWORD_PROGRESS_BAR_GROUP" class="mb-2">
                            <div class="text-centered">
                                <div class="font-size-xl mt-0 text-center mb-0 pb-0 d-none animate__animated animate_fadeIn" id="SIGNUP_PASSWORD_PROGRESS_BAR_DESCR"></div>
                            </div></div>

                        <div class="text-center mt-2" id="SIGNUP_PASSWORD_PROGRESS_BAR_INSTRUCTIONS">
                            <h6 class="text-muted font-size-sm">Fill up this bar with your password <a href="#" data-toggle="modal" data-target="#MODAL_EXPLAIN_PASSSWORD_BAR" class="cs-fancy-link ml-2">Learn More</a></h6>
                        </div>


                            <button class="btn btn-primary btn-block btn-lg btn-raise" onclick="Page.signUp.process()" id="SIGNUP_BUTTON_CONTINUE" disabled >Sign up</button>
                        <button type="button" class="btn btn-block btn-lg mb-3 btn-primary btn-raise d-none" id="SIGNUP_BUTTON_CONTINUE_PROGRESS" disabled>
                            <span class="spinner-border spinner-border-sm mr-2 " style="width: 1.3rem; height: 1.3rem;" role="status" aria-hidden="true"></span>
                            <!--                                One Moment...-->
                        </button>
                            <div class="alert alert-warning mt-4 mb-1 d-none" id="SIGNUP_ALERT" role="alert">
                                <i class="fe-alert-triangle font-size-xl mr-1"></i>
                                <span id="SIGNUP_ALERT_BODY"></span>
                            </div>
                            <p class="font-size-sm pt-3 mb-0">Already have an account? <a href="#" class="font-weight-medium"  data-view="#signin-view">Sign in</a></p>
                        </div>
                    </div>
                    <div class="border-top text-center animate__animated animate__fadeIn mt-4 pt-4">
                        <p class="font-size-sm font-weight-medium text-heading">Or sign in with</p>
                        <button id="breakaway-union-button" class="unionSSO dark-mode raise" onclick="BWDRUNUNIONBUTTON(this)">
                            <div class="unionSSO ">
                                <img src="https://i.imgur.com/RzbxCwK.png" id="breakaway-union-logo" class="unionSSO logo float-l interaction ">
                            </div>
                            <span class="unionSSO inner">


<span class="unionSSO button-text interaction dark-mode" id="breakaway-union-text">Sign in with Union</span>
</span>
                        </button>


                    </div>
                    </div>
                    <div class="cs-view  animate__animated animate__fadeIn" id="USER_INPUT_PASSWORD">
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Account Authentication</h1>
                        <h1 class="h1 ">Welcome Back<span id="USER_INPUT_PASSWORD_ELEMENT_NAME"></span>!</h1>
                        <p class="font-size-ms text-muted mb-4">Please enter your password to continue to your destination. <a href="#">I forgot my password.</a></p>
                            <div class="input-group-overlay form-group">
                                <div class="cs-password-toggle">
                                    <input type="password"  id="USER_INPUT_PASSWORD_INPUT" oninput="$('#USER_INPUT_PASSWORD_BUTTON_CONTINUE')[0].disabled = (this.value.length <= 7) " class="form-control" placeholder="Password">
                                    <label class="cs-password-toggle-btn">
                                        <input type="checkbox" class="custom-control-input" >
                                        <i class="fe-eye cs-password-toggle-indicator"></i>
                                        <span class="sr-only">Show password</span>
                                    </label>
                                </div>
                            </div>
                            <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_PASSWORD_ALERT" role="alert">
                                <i class="fe-alert-triangle font-size-xl mr-1"></i>
                                <span id="LOGIN_PASSWORD_ALERT_BODY">Alert body</span>
                            </div>
                            <!--                            <div class="input-group-overlay cs-password-toggle form-group">-->
                            <!--                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-lock"></i></span></div>-->
                            <!--                                <input class="form-control prepended-form-control" type="password" placeholder="Password" required="">-->
                            <!--                                <label class="cs-password-toggle-btn">-->
                            <!--                                    <input class="custom-control-input" type="checkbox"><i class="fe-eye cs-password-toggle-indicator"></i><span class="sr-only">Show password</span>-->
                            <!--                                </label>-->
                            <!--                            </div>-->
                            <!--                            <div class="d-flex justify-content-between align-items-center form-group">-->
                            <!--                                <div class="custom-control custom-checkbox">-->
                            <!--                                    <input class="custom-control-input" type="checkbox" id="keep-signed-2">-->
                            <!--                                    <label class="custom-control-label" for="keep-signed-2">Keep me signed in</label>-->
                            <!--                                </div><a class="nav-link-style font-size-ms" href="password-recovery.html">Forgot password?</a>-->
                            <!--                            </div>-->
                            <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="USER_INPUT_PASSWORD_BUTTON_CONTINUE"  disabled> Continue <i class="fe-arrow-right ml-1"></i></button>

                            <button type="button" class="btn btn-block btn-lg mb-3 btn-primary btn-raise d-none" id="USER_INPUT_PASSWORD_BUTTON_CONTINUE_PROGRESS" disabled>
                                <span class="spinner-border spinner-border-sm mr-2 " style="width: 1.3rem; height: 1.3rem;" role="status" aria-hidden="true"></span>
                                <!--                                One Moment...-->
                            </button>
                            <button class="btn btn-secondary btn-block mb-3" onclick="$('#USER_INPUT_OPTIONS').addClass('show')
                        $('#USER_CONFIRM_PHONE').removeClass('show')
                        $('#USER_INPUT_PASSWORD').removeClass('show')
                        $('#signin-view').addClass('show')
                        $('#USER_AWIATING_CONFIRMATIONS').removeClass('show'); $('#LOGIN_EMAIL_INPUT')[0].value = ''"> I'm not <span id="USER_INPUT_PASSWORD_ELEMENT_NAME_2">this user.</span></button>
                    </div>
                    <div class="cs-view animate__animated animate__fadeIn" id="USER_CONFIRM_PHONE">
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Two Factor Verification</h1>
                        <h1 class="h1 ">One more Step!</h1>
                        <p class="font-size-ms text-muted mb-4">We have texted a code to the phone number on record. </p>
                            <div class="input-group-overlay form-group">
                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-hash"></i></span></div>
                                <input class="form-control prepended-form-control form-control-lg form-control-type-confirmation_code" oninput="$('#USER_INPUT_2FA_CONTINUE')[0].disabled = (this.value.length != 7); " type="tel" id="LOGIN_2FA_INPUT" placeholder="Confirmation Code"  required>
                            </div>
                            <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_2FA_ALERT" role="alert">
                                <i class="fe-alert-triangle font-size-xl mr-1"></i>
                                <span id="LOGIN_2FA_ALERT_BODY"></span>
                            </div>
                            <!--                            <div class="input-group-overlay cs-password-toggle form-group">-->
                            <!--                                <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="fe-lock"></i></span></div>-->
                            <!--                                <input class="form-control prepended-form-control" type="password" placeholder="Password" required="">-->
                            <!--                                <label class="cs-password-toggle-btn">-->
                            <!--                                    <input class="custom-control-input" type="checkbox"><i class="fe-eye cs-password-toggle-indicator"></i><span class="sr-only">Show password</span>-->
                            <!--                                </label>-->
                            <!--                            </div>-->
                            <!--                            <div class="d-flex justify-content-between align-items-center form-group">-->
                            <!--                                <div class="custom-control custom-checkbox">-->
                            <!--                                    <input class="custom-control-input" type="checkbox" id="keep-signed-2">-->
                            <!--                                    <label class="custom-control-label" for="keep-signed-2">Keep me signed in</label>-->
                            <!--                                </div><a class="nav-link-style font-size-ms" href="password-recovery.html">Forgot password?</a>-->
                            <!--                            </div>-->
                            <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="USER_INPUT_2FA_CONTINUE" disabled> Verify <i class="fe-arrow-right ml-1"></i></button>
                            <button type="button" class="btn btn-block btn-lg mb-3 btn-primary btn-raise d-none" id="USER_INPUT_2FA_CONTINUE_PROGRESS" disabled>
                                <span class="spinner-border spinner-border-sm mr-2 " style="width: 1.3rem; height: 1.3rem;" role="status" aria-hidden="true"></span>
                                <!--                                One Moment...-->
                            </button>
                            <button class="btn btn-light btn-block btn-raise mb-3" disabled> Cancel </button>
                            <button type="button" class="btn btn-block btn-lg mb-3 btn-primary btn-raise d-none"  disabled>
                                <span class="spinner-border spinner-border-sm mr-2 " style="width: 1.3rem; height: 1.3rem;" role="status" aria-hidden="true"></span>
                                <!--                                One Moment...-->
                            </button>
                    </div>
                    <div class="cs-view animate__animated animate__fadeIn" id="USER_AWIATING_CONFIRMATIONS">
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Account Activation</h1>
                        <h1 class="h1 ">Almost there!</h1>
                        <p class="font-size-ms text-muted mb-4">In order to keep your account safe, we require that you verify your provided contact details. <a href="#">I need help with this.</a></p>
<!--                        <form novalidate="">-->
                        <div class="card shadow-none mb-3">
                            <div class="card-body">
                                <ul class="list-unstyled mb-0" id="USER_AWIATING_CONFIRMATIONS_CONFIRMATION_LIST">
                                    <li class="media pb-3  mb-0">
                                        <i class="fe-check font-size-lg mt-2 mb-0 text-success"></i>
                                        <div class="media-body pl-3">
                                            <span class="font-size-ms text-muted">Email (Verified)</span>
                                            <a class="d-block nav-link-style font-size-sm">You have verified the email <strong >anom*****@gmail.com</strong>.</a>
                                        </div>
                                    </li>
                                    <li class="media mt-0 pb-0 ">
                                        <i class="fe-phone font-size-lg mt-2 mb-0 text-primary"></i>
                                        <div class="media-body pl-3">
                                            <span class="font-size-ms text-muted">Phone Number</span>
                                            <a class="d-block nav-link-style font-size-sm">We have texted a link to the phone number <strong >(***) *** - 9438</strong>. Click on it to verify your phone number. <a href="#">Resend it.</a></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                            <button class="btn btn-lg btn-secondary btn-block mb-3" onclick="$('#USER_INPUT_OPTIONS').addClass('show')
                        $('#USER_CONFIRM_PHONE').removeClass('show')
                        $('#USER_AWIATING_CONFIRMATIONS').removeClass('show')"> Back </button>
                        <div class="text-center pl-3 pr-3 font-size-xs text-muted">
                            <p>If these details are not verified in 48 hours from creation, this account will be deleted.</p>
                        </div>
                    </div>
                    <div class="cs-view animate__animated animate__fadeIn" id="USER_ACTIVATING_ACCOUNT">
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Activation</h1>
                        <h1 class="h1 ">We're activating your account...</h1>
                        <p class="font-size-ms text-muted mb-4">This could take up to a minute depending on a few factors.</p>
                        <!--                        <form novalidate="">-->
                        <div class="text-center mb-5 mt-5 animate__animated animate__zoomIn" style="display: flex;flex-direction: column;align-items: center;">
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
                    <div class="cs-view animate__animated animate__fadeIn " id="USER_ACTIVATING_ACCOUNT_FAIL">
                        <i class="h1 fe-alert-triangle text-danger"></i>
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Activation</h1>
                        <h1 class="h1 text-danger">There was a Problem Activating your Account.</h1>
                        <p class="font-size-ms mb-4">If this problem persists, please contact support.</p>
                        <code >Error Code: 3949J-G</code>
                        <!--                        <form novalidate="">-->
                        <button class="btn btn-lg btn-raise btn-danger btn-block mb-3 mt-5" onclick="Page.signUp.requestAccountActivation()"> Retry </button>
                        <button class="btn btn-lg btn-secondary btn-block mb-3" onclick="$('#USER_INPUT_OPTIONS').addClass('show')
                        $('#USER_CONFIRM_PHONE').removeClass('show')
                        $('#USER_AWIATING_CONFIRMATIONS').removeClass('show')"> Back </button>
                    </div>
                    <div class="cs-view animate__animated animate__fadeIn " id="USER_ACTIVATING_ACCOUNT_SUCCESS">
                        <i class="h1 fe-check-circle text-success"></i>
                        <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">Activation</h1>
                        <h1 class="h1 text-success">Your Account has been Activated! 🎉</h1>
                        <p class="font-size-ms mb-4">Nice! Everything is ready for you. You can click the button below to get started and log in to your new account.</p>
                        <!--                        <form novalidate="">-->
                        <button class="btn btn-lg btn-raise btn-success btn-block mb-3 mt-5" onclick="window.location.reload()"> Jump In </button>
                        <button class="btn btn-lg btn-secondary btn-block mb-3" onclick="$('#USER_INPUT_OPTIONS').addClass('show')
                        $('#USER_CONFIRM_PHONE').removeClass('show')
                        $('#USER_AWIATING_CONFIRMATIONS').removeClass('show')"> Back </button>
                    </div>
<!--                    <p class="text-center font-size-xs pt-3 mb-0 text-muted"><a  class="font-weight-medium" data-view="#USER_ACTIVATING_ACCOUNT">ACTI</a> <a  class="font-weight-medium" data-view="#USER_CONFIRM_PHONE">CONF</a>  <a class="font-weight-medium" data-view="#USER_AWIATING_CONFIRMATIONS">AA</a></p>-->
                </div>
            </div>
        </div>
    </section>
</main>
<div class="navbar fixed-bottom row d-flex justify-content-center bg-transparent">
    <div class="d-flex animate__animated animate__fadeInUp p-3" style="animation-delay: .5s">
        <p class="font-size-xs text-muted text-center pt-3 mb-0">By continuing, you agree to our <a href="/legal/policies/terms" target="_blank" class="font-weight-medium" >Terms and Conditions</a>
            and our <a href="/legal/policies/privacy" target="_blank" class="font-weight-medium" >Privacy Policy</a>.</p>
    </div>
</div>
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
<script>
    $(document).ready(function () {
        Page.setListeners();
        String.prototype.isValidPhone = function(digitsCount) {
            let str = this.trim().match(/\d/g);
            return str && str.length >= (digitsCount || 10); // default is at least 10 digits
        }
        String.prototype.isValidEmail = function () {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(this.trim()).toLowerCase());
        }
        setTimeout(function () {
            $("#LOGIN_EMAIL_INPUT")[0].value = InputManager.types.accounts.userID.dynamicFormat.string($("#LOGIN_EMAIL_INPUT")[0].value); $('#LOGIN_EMAIL_BUTTON_CONTINUE')[0].disabled = !InputManager.types.accounts.userID.dynamicFormat.validate($("#LOGIN_EMAIL_INPUT")[0].value)
        }, 200)
        if (Page.fillInTarget){
            Page.login.process()
        }
    })
    var debug_var = null;
    function BWDRUNUNIONBUTTON(x){
        console.log(x);
        debug_var = x;
        x.classList.add('processing');
        document.getElementById('breakaway-union-logo').classList.add('active');
        x.classList.remove('raise')
        document.getElementById('breakaway-union-text').innerHTML = "Waiting for Sign In..."
    }
    class Page {};
    Page.signUp = {};
    Page.signUp.verifyFormReady = function(){
        $("#SIGNUP_BUTTON_CONTINUE")[0].disabled = !($("#USER_INPUT_SIGNUP_PHONE")[0].value.isValidPhone(10)
            && $("#USER_INPUT_SIGNUP_EMAIL")[0].value.isValidEmail()
            && $("#USER_INPUT_SIGNUP_FIRSTNAME")[0].value.trim() !== ""
            && $("#USER_INPUT_SIGNUP_LASTNAME")[0].value.trim() !== ""
            && InputManager.types.accounts.passwords.results.strength.reached
            && $("#USER_INPUT_SIGNUP_PASSWORD")[0].value.trim() !== "")
    }
    Page.signUp.passwordInstructionsSeen = false;
    Page.persistence = {};
    Page.persistence.set = function(){

    }
    Page.signUp.passwordInstructionsRemove = function(){
        $("#SIGNUP_PASSWORD_PROGRESS_BAR_INSTRUCTIONS").addClass("animate__animated animate__bounceOut");
        setTimeout(function () {
            $("#SIGNUP_PASSWORD_PROGRESS_BAR_INSTRUCTIONS").hide()
            $("#SIGNUP_PASSWORD_PROGRESS_BAR_DESCR").removeClass("d-none")
        },500)
        Page.signUp.passwordInstructionsSeen = true;
    };
    Page.signUp.process = function(){
        $("#SIGNUP_BUTTON_CONTINUE").addClass("d-none");
        $("#SIGNUP_BUTTON_CONTINUE_PROGRESS").removeClass("d-none");

        (new HTTPClient())
            .set_service("API.accounts")
            .set_action("create")
            .set_data(
                {
                    name: {
                        first: $("#USER_INPUT_SIGNUP_FIRSTNAME")[0].value,
                        last: $("#USER_INPUT_SIGNUP_LASTNAME")[0].value
                    },
                    email: $("#USER_INPUT_SIGNUP_EMAIL")[0].value,
                    phone: $("#USER_INPUT_SIGNUP_PHONE")[0].value,
                    password: $("#USER_INPUT_SIGNUP_PASSWORD")[0].value
                }
            )
            .send().then(function (data) {

            setTimeout(function (){
                $("#SIGNUP_ALERT").addClass("d-none");
                $("#SIGNUP_BUTTON_CONTINUE").removeClass("d-none");
                $("#SIGNUP_BUTTON_CONTINUE_PROGRESS").addClass("d-none");
                $("#LOGIN_EMAIL_INPUT")[0].value = $("#USER_INPUT_SIGNUP_PHONE")[0].value;
                $("#LOGIN_EMAIL_INPUT")[0].value = InputManager.types.accounts.userID.dynamicFormat.string($("#LOGIN_EMAIL_INPUT")[0].value); $('#LOGIN_EMAIL_BUTTON_CONTINUE')[0].disabled = !InputManager.types.accounts.userID.dynamicFormat.validate($("#LOGIN_EMAIL_INPUT")[0].value)
                Page.login.process();
                setTimeout(function () {
                    $("#signup-view").removeClass("show");
                    $("#signin-view").addClass("show");
                },500)
            }, 200)
        }).catch(function (data) {
            console.log(data)
            $("#SIGNUP_ALERT").removeClass("d-none");
            if (data.response.title == undefined){
                data.response.title = "Whoops! An unknown error occured during signup."
            }
            $("#SIGNUP_ALERT_BODY")[0].innerHTML = data.response.title;
            $("#SIGNUP_BUTTON_CONTINUE").removeClass("d-none");
            $("#SIGNUP_BUTTON_CONTINUE_PROGRESS").addClass("d-none");
        })
    }
    Page.login = {};
    Page.DOMManager = {};
    Page.DOMManager.hideAllElements = function(){
        $(".cs-view").removeClass("show")
    }
    Page.login.verificationDraw = function(parsed_response){
        $("#USER_INPUT_OPTIONS").removeClass('show')
        $("#USER_CONFIRM_PHONE").removeClass('show')
        $("#USER_AWIATING_CONFIRMATIONS").addClass('show')
        $("#USER_AWIATING_CONFIRMATIONS_CONFIRMATION_LIST")[0].innerHTML = "";
        if (parsed_response.content.verified.email.status){
            $("#USER_AWIATING_CONFIRMATIONS_CONFIRMATION_LIST")[0].innerHTML +=  "<li class=\"media pb-3  mb-0\">\n" +
                "                                        <i class=\"fe-check font-size-lg mt-2 mb-0 text-success\"></i>\n" +
                "                                        <div class=\"media-body pl-3\">\n" +
                "                                            <span class=\"font-size-ms text-muted\">Email (Verified)</span>\n" +
                "                                            <a class=\"d-block nav-link-style font-size-sm\">You have verified the email <strong >"+parsed_response.content.verified.email.target+"</strong>.</a>\n" +
                "                                        </div>\n" +
                "                                    </li>"
        }else {
            $("#USER_AWIATING_CONFIRMATIONS_CONFIRMATION_LIST")[0].innerHTML += `                                    <li class="media mt-0 pb-0 ">
                                        <i class="fe-mail font-size-lg mt-2 mb-0 text-primary"></i>
                                        <div class="media-body pl-3">
                                            <span class="font-size-ms text-muted">Email</span>
                                            <a class="d-block nav-link-style font-size-sm">We sent a link to the email <strong >${parsed_response.content.verified.email.target}</strong>. Click on it to verify it. <button class="btn btn-link p-0" type="button"  onclick="Page.signUp.resendActivation('email');Page.activateResendCountdown(this.id)" id="GENERATED_CONFIRMATION_RESEND_EMAIL">Resend it.</button></a>
                                        </div>
                                    </li>`
        }
        if (parsed_response.content.verified.phone.status){
            $("#USER_AWIATING_CONFIRMATIONS_CONFIRMATION_LIST")[0].innerHTML +=  "<li class=\"media pb-3  mb-0\">\n" +
                "                                        <i class=\"fe-check font-size-lg mt-2 mb-0 text-success\"></i>\n" +
                "                                        <div class=\"media-body pl-3\">\n" +
                "                                            <span class=\"font-size-ms text-muted\">Phone (Verified)</span>\n" +
                "                                            <a class=\"d-block nav-link-style font-size-sm\">You have verified the phone number <strong >"+parsed_response.content.verified.phone.target+"</strong>.</a>\n" +
                "                                        </div>\n" +
                "                                    </li>"
        }else {
            $("#USER_AWIATING_CONFIRMATIONS_CONFIRMATION_LIST")[0].innerHTML += `                                    <li class="media mt-0 pb-0 ">
                                        <i class="fe-phone font-size-lg mt-2 mb-0 text-primary"></i>
                                        <div class="media-body pl-3">
                                            <span class="font-size-ms text-muted">Phone</span>
                                            <a class="d-block nav-link-style font-size-sm">We texted a link to the phone number <strong >${parsed_response.content.verified.phone.target}</strong>. Click on it to verify your it. <button class="btn btn-link p-0" type="button" id="GENERATED_CONFIRMATION_RESEND_PHONE" onclick="Page.signUp.resendActivation('phone');Page.activateResendCountdown(this.id)">Resend it.</button></a>
                                        </div>
                                    </li>`
        }
        if (parsed_response.content.verified.phone.status && parsed_response.content.verified.email.status){
            setTimeout(function () {
                Page.signUp.requestAccountActivation();
            }, 1500)
        }
    }
    Page.signUp.requestAccountActivation = function(){
        $("#USER_AWIATING_CONFIRMATIONS").removeClass('show')
        $("#USER_ACTIVATING_ACCOUNT").addClass('show')
        setTimeout(function () {
        (new HTTPClient())
            .set_service("API.accounts")
            .set_action("activate")
            .set_data({identifier: Page.signUp.request_identfier})
            .send().then((e) => {
            $("#USER_ACTIVATING_ACCOUNT_SUCCESS").addClass('show')
            $("#USER_ACTIVATING_ACCOUNT_FAIL").removeClass('show')
            $("#USER_ACTIVATING_ACCOUNT").removeClass('show')
        }).catch((e) => {
            $("#USER_ACTIVATING_ACCOUNT_FAIL").addClass('show')
            $("#USER_ACTIVATING_ACCOUNT_SUCCESS").removeClass('show')
            $("#USER_ACTIVATING_ACCOUNT").removeClass('show')
        })
        }, 7000)
    }
    Page.signUp.resendActivation = function(type){
        (new HTTPClient()).set_service("API.accounts").set_action("resend").set_data({type: type, identifier: Page.signUp.request_identfier}).send()
    }
    Page.activateResendCountdown = function(id){
        let count_to = 60;
        let count = 0;
        let funct = function () {
            count++;
            $("#" + id).addClass('disabled');
            $("#" + id)[0].disabled = true;
            $("#" + id)[0].innerHTML = 'Resend in ' + (count_to - count) + "s";
            if (count === count_to){
                $("#" + id).removeClass('disabled');
                $("#" + id)[0].disabled = false;
                $("#" + id)[0].innerHTML = 'Resend it.';
                clearInterval(interval);
            }
        };
        funct();
        let interval = setInterval(funct, 1000)
    }
    Page.fillInTarget = <?php echo ($fill_in_target ? "true" : "false");?>;
    Page.signUp.request_identfier = null;
    Page.login.process = function(){
        $("#LOGIN_EMAIL_ALERT").addClass('d-none')
        $("#LOGIN_EMAIL_BUTTON_CONTINUE").addClass('d-none')
        $("#LOGIN_EMAIL_BUTTON_CONTINUE_PROGRESS").removeClass('d-none')
        $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE").addClass('d-none')
        $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE_PROGRESS").removeClass('d-none')
        $("#LOGIN_EMAIL_ALERT").addClass('d-none')
        Page.login.check_email().then((response) => {
            try {
                let parsed_response = JSON.parse(response);
                console.log(parsed_response);
                if (parsed_response.status == 'in_registration') {
                    Page.login.verificationDraw(parsed_response)
                    Page.signUp.request_identfier = parsed_response.content.identifier
                } else if (parsed_response.status == 'account_found') {
                    Page.DOMManager.hideAllElements();
                    $("#USER_INPUT_PASSWORD").addClass('show');
                    if (parsed_response.content.name != null) {
                        $("#USER_INPUT_PASSWORD_ELEMENT_NAME")[0].innerHTML = `, ${parsed_response.content.name}`
                        $("#USER_INPUT_PASSWORD_ELEMENT_NAME_2")[0].innerHTML = `${parsed_response.content.name}`
                    }
                }
                $("#LOGIN_EMAIL_BUTTON_CONTINUE").removeClass('d-none')
                $("#LOGIN_EMAIL_BUTTON_CONTINUE_PROGRESS").addClass('d-none');
                $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE").removeClass('d-none')
                $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE_PROGRESS").addClass('d-none')
                return;
            }catch (e) {
                console.log(e)
            }
        }).catch((response) => {
            $("#LOGIN_EMAIL_ALERT").removeClass('d-none')
            console.log(response)
            $("#LOGIN_EMAIL_ALERT_BODY")[0].innerHTML = response.response.title
            $("#LOGIN_EMAIL_BUTTON_CONTINUE").removeClass('d-none')
            $("#LOGIN_EMAIL_BUTTON_CONTINUE_PROGRESS").addClass('d-none')
            $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE").removeClass('d-none')
            $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE_PROGRESS").addClass('d-none')
        })
    }
    Page.login.check_email = function(){
        return (new HTTPClient())
            .set_service("API.security")
            .set_action("standard")
            .set_data({
                mode: 'login',
                credentials: {
                    user: $("#LOGIN_EMAIL_INPUT")[0].value}
            })
            .send()
    }
    Page.login.submit2FA = function(){
        $("#USER_INPUT_2FA_CONTINUE").addClass('d-none')
        $("#USER_INPUT_2FA_CONTINUE_PROGRESS").removeClass('d-none');
        (new HTTPClient())
            .set_service("API.security")
            .set_action("confirm2FA")
            .set_data({code: $("#LOGIN_2FA_INPUT")[0].value})
            .send()
            .then((data) => {
                window.location = "route.php" + window.location.search
            }).catch((data) => {
            $("#LOGIN_2FA_ALERT").removeClass('d-none');
            $("#LOGIN_2FA_ALERT_BODY")[0].innerHTML = data.response.title;
            $("#USER_INPUT_2FA_CONTINUE").removeClass('d-none')
            $("#USER_INPUT_2FA_CONTINUE_PROGRESS").addClass('d-none');
        })
    }
    Page.login.authenticate = function(){
        $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE").addClass('d-none')
        $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE_PROGRESS").removeClass('d-none');
        (new HTTPClient())
            .set_service("API.security")
            .set_action("standard")
            .set_data({
                mode: 'login',
                credentials: {
                    user: $("#LOGIN_EMAIL_INPUT")[0].value,
                    password: $("#USER_INPUT_PASSWORD_INPUT")[0].value
                }
            })
            .send().catch((data) => {
            $("#LOGIN_PASSWORD_ALERT").removeClass('d-none');
            $("#LOGIN_PASSWORD_ALERT_BODY")[0].innerHTML = data.response.title;
        }).then((data) => {
            console.log(data);
            data = JSON.parse(data);
            if (data.next_steps === '2FA'){
                $("#USER_CONFIRM_PHONE").addClass("show");
                $("#USER_INPUT_PASSWORD").removeClass("show");
            }
            if (data.next_steps === 'none'){
                window.location = "route.php" + window.location.search
            }
        }).finally((data) => {
            $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE").removeClass('d-none')
            $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE_PROGRESS").addClass('d-none')
        })
    }
    Page.setListeners = function () {
        $("#LOGIN_EMAIL_BUTTON_CONTINUE").on('click', function () {
            Page.login.process();
        });
        $("#USER_INPUT_2FA_CONTINUE").on('click', function () {
            Page.login.submit2FA();
        });
        $("#USER_INPUT_PASSWORD_BUTTON_CONTINUE").on('click', function () {
            Page.login.authenticate();
        })
        $(".form-control-type-phone").mask("(000) 000-0000");
        $(".form-control-type-confirmation_code").mask("000-000");
        InputManager.types.accounts.passwords.strengthEngine()
    }
    Page.fillInLinks = function(string){

    }

    class InputManager {}
    InputManager.types = {};
    InputManager.types.phoneNumber = function(phoneNumberString) {
        return phoneNumberString.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    }
    InputManager.types.accounts = {};
    InputManager.types.accounts.passwords = {};
    InputManager.types.accounts.passwords.results = {};
    InputManager.types.accounts.passwords.results.strength = {};
    InputManager.types.accounts.passwords.results.strength.functions = {};
    InputManager.types.accounts.passwords.results.strength.transitionFlag = false;
    InputManager.types.accounts.passwords.results.strength.transitionFadeOutTimer = false;
    InputManager.types.accounts.passwords.results.strength.functions.onIncrement = function(increment){
        Page.signUp.passwordInstructionsRemove();
        let perc = Math.floor((increment/InputManager.types.accounts.passwords.results.strength.threshold)*100);
        perc = (perc < 0) ? 0 : perc;
        let class_add = "";
        let description = "<p class='animate__animated animate__bounceIn mb-1' href=\"#\" data-toggle=\"modal\" data-target=\"#MODAL_EXPLAIN_PASSSWORD_BAR\" >😔</p>";
        if (perc < 30){
            class_add = "bg-danger";
            description = "<p class='animate__animated animate__bounceIn mb-1' href=\"#\" data-toggle=\"modal\" data-target=\"#MODAL_EXPLAIN_PASSSWORD_BAR\" >😔</p>";
        } else if (perc < 50){
            class_add = "bg-warning";
            description = "<p class='animate__animated animate__bounceIn mb-1' href=\"#\" data-toggle=\"modal\" data-target=\"#MODAL_EXPLAIN_PASSSWORD_BAR\" >😕</p>"
        }else if (perc < 100){
            description = "<p class='animate__animated animate__bounceIn mb-1' href=\"#\" data-toggle=\"modal\" data-target=\"#MODAL_EXPLAIN_PASSSWORD_BAR\" >🤓</p>"
        }else{
            class_add = "bg-success";
            $("#SIGNUP_PASSWORD_PROGRESS_BAR").addClass("bg-success progress-bar-striped progress-bar-animated");
            description = " <h6 class='animate__animated animate__tada text-success' href=\"#\" data-toggle=\"modal\" data-target=\"#MODAL_EXPLAIN_PASSSWORD_BAR\" ><span class='animate__animated animate__bounceIn mb-0'>🥳</span> Good to Go!</h6>"
        }
        if (perc < 100){
            $("#SIGNUP_PASSWORD_PROGRESS_BAR").removeClass("progress-bar-striped progress-bar-animated");
        }
        clearTimeout(InputManager.types.accounts.passwords.results.strength.transitionFadeOutTimer)
        if (InputManager.types.accounts.passwords.results.strength.reached){
            InputManager.types.accounts.passwords.results.strength.transitionFadeOutTimer = setTimeout(function () {
                $("#SIGNUP_PASSWORD_PROGRESS_BAR_GROUP").removeClass("animate__animated animate__fadeIn").addClass("animate__animated animate__bounceOut");
                setTimeout(function () {
                        $("#SIGNUP_PASSWORD_PROGRESS_BAR_GROUP").addClass("d-none")
                    InputManager.types.accounts.passwords.results.strength.transitionFlag = true;
                }, 500)
                InputManager.types.accounts.passwords.results.strength.transitionFlag = true
            }, 2000)
        }else {
            clearTimeout(InputManager.types.accounts.passwords.results.strength.transitionFadeOutTimer)
        }
        if (InputManager.types.accounts.passwords.results.strength.transitionFlag){
            $("#SIGNUP_PASSWORD_PROGRESS_BAR_GROUP").addClass("animate__animated animate__fadeIn");
            $("#SIGNUP_PASSWORD_PROGRESS_BAR_GROUP").removeClass("d-none animate__animated animate__bounceOut")
            InputManager.types.accounts.passwords.results.strength.transitionFlag = false
        }
        $("#SIGNUP_PASSWORD_PROGRESS_BAR_DESCR")[0].innerHTML = description;
        $("#SIGNUP_PASSWORD_PROGRESS_BAR").removeClass("bg-success").removeClass("bg-info").removeClass("bg-danger").removeClass("bg-warning").addClass(class_add)


        $("#SIGNUP_PASSWORD_PROGRESS_BAR")[0].style.width = ""+perc+"%"
        Page.signUp.verifyFormReady();
    };
    InputManager.types.accounts.passwords.results.strength.functions.onThresholdPassed = function(){
        InputManager.types.accounts.passwords.results.strength.reached = true;
    };
    InputManager.types.accounts.passwords.results.strength.threshold = 50;
    InputManager.types.accounts.passwords.results.strength.reached = false;
    InputManager.types.accounts.passwords.strengthEngine = function(selector=":password"){
        let config = {
            ui:{
                showProgressBar:false
            },common:{
                onScore: function(x,a,b) {
                    InputManager.types.accounts.passwords.results.strength.functions.onIncrement(b)
                    if (b > InputManager.types.accounts.passwords.results.strength.threshold){
                        InputManager.types.accounts.passwords.results.strength.reached = true;
                        InputManager.types.accounts.passwords.results.strength.functions.onThresholdPassed()
                    }
                        }
            }
        };
        $(selector).pwstrength(config);

    }
    InputManager.types.accounts.userID = {};
    InputManager.types.accounts.userID.dynamicFormat = {};
    InputManager.types.accounts.userID.dynamicFormat.formatted = false;
    InputManager.types.accounts.userID.dynamicFormat.validate = function (string){
        if (!isNaN(string.replace(/\W/g, '')) && (parseInt(string.replace(/\W/g, '')) > 999999999) && (parseInt(string.replace(/\W/g, '')) < 9999999999) && !string.includes('@')){
            return true;
        }
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(string).toLowerCase());
    }
    InputManager.types.accounts.userID.dynamicFormat.string = function (string) {
        if (!isNaN(string.replace(/\W/g, '')) && (parseInt(string.replace(/\W/g, '')) > 999999999) && (parseInt(string.replace(/\W/g, '')) < 9999999999 && !string.includes('@'))){
            InputManager.types.accounts.userID.dynamicFormat.formatted = true
            return InputManager.types.phoneNumber(string)
        }
        if (InputManager.types.accounts.userID.dynamicFormat.formatted){
            InputManager.types.accounts.userID.dynamicFormat.formatted = false;
            return string.replace('(', '').replace(')', '').replace(' ', '').replace('-', '');
        }
        return string;
    }
</script>

</body>