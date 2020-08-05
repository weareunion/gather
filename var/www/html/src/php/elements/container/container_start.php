<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.11.1/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/micromodal@0.4.6/dist/micromodal.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <style>
        .btn.btn-raise:enabled {
            box-shadow: 0 0.5em 0.5em -0.4em;
            transform: translateY(0em);
            transition: 0.5s cubic-bezier(0,.09,0,.99);
        }
        .btn.btn-raise:active:enabled {
            -webkit-box-shadow: -1px 10px 39px -19px rgba(0,0,0,0.45);
            -moz-box-shadow: -1px 10px 39px -19px rgba(0,0,0,0.45);
            box-shadow: -1px 10px 39px -19px rgba(0,0,0,0.45);
            transform: translateY(0em);
            transition: 0.5s cubic-bezier(0,.09,0,.99);
        }
        .btn.btn-raise:hover:enabled {
            -webkit-box-shadow: -1px 10px 39px -19px rgba(0,0,0,0.45);
            -moz-box-shadow: -1px 10px 39px -19px rgba(0,0,0,0.45);
            box-shadow: -1px 10px 39px -19px rgba(0,0,0,0.45);
            transform: translateY(-0.25em);
            transition: 0.5s cubic-bezier(0,.09,0,.99);
        }
        .btn.btn-raise:disabled {
            cursor: default;
        }

    </style>
    <link rel="stylesheet" href="/src/css/micromodal.css">
    <script src="/src/js/HTTPInterface/HTTPClient.js"></script>

