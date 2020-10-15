<?php

use Union\API\storage\GCStorageClient;
use Union\API\web\UI\UIManager;
use Union\PKG\Autoloader;

require_once "/lib/union/lib/REST/v1/build.php";
Autoloader::import__require("API.web,API.security, API.storage");
Autoloader::import__require("drivers.external.GoogleAPIClient7->composer");
GCStorageClient::register_stream();

//file_put_contents("gs://slately_buckets_public_general/5050.txt", "test");

UIManager::import_header();

$location_request = "https://maps.googleapis.com/maps/api/place/details/json?placeid=" . $_GET['location'] . "&key=AIzaSyBu2GkB2ltXHsgM8xLYv4_TbEmGuoY-SIM";

$json = file_get_contents($location_request);
$data = json_decode($json, true);

//var_dump($data);

$location_search_details = [
    "name" => $data['result']['name'],
    "geometry" => [
        "latitude" => $data['result']['geometry']['location']['lat'],
        "longitude" => $data['result']['geometry']['location']['lng'],
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Slately | Search · <? echo $location_search_details['name'] ?> </title>
</head>
<div class="shadow">
    <? require_once "/lib/union/lib/REST/v1/API/web/UI/resources/elements/navbar/standard_fitted_logo.php";


    ?>
</div>
<!-- Accordion made of cards -->
<div class="accordion" id="accordionExample">

    <!-- Card -->
    <div class="card">
        <div class="card-header" id="headingOne">
            <h3 class="accordion-heading">
                <a href="#collapseOne" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                    Collapsible Group Item #1
                    <span class="accordion-indicator"></span>
                </a>
            </h3>
        </div>
        <div class="collapse show" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h3 class="accordion-heading">
                <a href="#collapseTwo" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                    Collapsible Group Item #2
                    <span class="accordion-indicator"></span>
                </a>
            </h3>
        </div>
        <div class="collapse show" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
            </div>
        </div>
    </div>
</div>

<!-- Card -->
<div class="card">
    <div class="card-header" id="headingThree">
        <h3 class="accordion-heading">
            <a href="#collapseThree" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                Collapsible Group Item #3
                <span class="accordion-indicator"></span>
            </a>
        </h3>
    </div>
    <div class="collapse show" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
        </div>
    </div>
</div>
</div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYue8B6qCoWEbfasU0bByxNY2L44CJhcM&libraries=places"></script>