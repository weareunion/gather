<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web, API.storage");
\Union\API\storage\GCStorageClient::register_stream();

//file_put_contents("gs://slately_buckets_public_general/5050.txt", "test");

\Union\API\web\UI\UIManager::import_header();
?>
<h1>Test</h1>

<script src="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://demo.createx.studio/around/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/parallax-js/dist/parallax.min.js"></script>

<!-- Main theme script-->
<script src="https://demo.createx.studio/around/js/theme.min.js"></script>
<div class="modal fade" id="MODAL_UPLOAD_PROGRESS" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-body">
        <h3 class="text-white mb-0 animate__animated animate__fadeInDown" style="animation-delay: 0s;">Uploading...</h3>
            <p class="text-white mb-3 opacity-75 animate__animated animate__fadeInDown" style="animation-delay: 0.1s;">3 minutes remaining...</p>
        <div class="progress mb-3 mt-0 animate__animated animate__fadeInDown" style="animation-delay: 0.3s; animation-duration: 1.5s; height: 4px;">
            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
            <div class="align-content-center ">
            <button type="button" class="btn btn-light  btn-sm btn-raised animate__animated animate__zoomIn animate__delay-1s">Cancel</button>
            </div>
        </div>
    </div>
</div>
<main class="cs-page-wrapper d-flex flex-column">

    <div class="modal fade" id="MODAL_UPLOAD" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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

    <div class="jumbotron">
        <h1>Hello, world!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p class="pb-3">It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a href="#" class="btn btn-primary btn-shadow" role="button">Learn more</a>
    </div>
    <button type="button" data-toggle="modal" data-target="#MODAL_UPLOAD" class="btn btn-primary btn-raise btn-lg btn-block">
        <i class="fe-upload-cloud mr-2"></i>
        Upload

    </button>
    <button type="button" data-toggle="modal" data-target="#MODAL_UPLOAD_PROGRESS" class="btn btn-primary btn-raise btn-lg btn-block">
        <i class="fe-upload-cloud mr-2"></i>
        Progress
    </button>
    <div class="progress mb-3" style="height: 4px;">
        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</main>

<?php

var_dump(file_get_contents("https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Vict&types=geocode&language=en&key=AIzaSyAYue8B6qCoWEbfasU0bByxNY2L44CJhcM"));

?>