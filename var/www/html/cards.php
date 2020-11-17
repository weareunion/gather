<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web,API.security, API.storage");
\Union\API\storage\GCStorageClient::register_stream();

//file_put_contents("gs://slately_buckets_public_general/5050.txt", "test");

\Union\API\web\UI\UIManager::import_header();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Slately - One Stop Events</title>
</head>
<? require_once "/lib/union/lib/REST/v1/API/web/UI/resources/elements/navbar/standard.php"?>
<style>
    .prevent_scrollbar::-webkit-scrollbar {
        width: 0px;
        background: transparent; /* make scrollbar transparent */
    }
</style>
<body>
<div class=" container-fluid">
    <br>
    <h1 class="text-center text-gradient-steep display-4 font-weight-bolder mb-0 pb-0 mt-5 mt-sm-4">This is your CoreCard.</h1>
    <p class="text-center text-muted pt-0 mt-0 mb-5">Your one card for all your establishments. <a class="text-primary ">Learn More</a></p>
    <p></p>
    <div class="mt-5 mt-sm-4row d-flex justify-content-center">
        <div>

    <div class="card card-hover bg-dark shadow-lg justify-content-center animate__animated animate__flipInX animate__fadeInUp" style="width: 400px; height: 230px; animation-delay: .2s">
        <div class="card-body d-block">
            <div>
            <img src="src/media/images/slately_logo_white_large_texted.png" class="float-left animate__animated animate__fadeInUp" style="animation-delay: 0.1s" width="100">
            <h4 class="float-right text-white animate__animated animate__fadeInUp" style="animation-delay: 0.2s"><p class="font-size-sm float-left">$</p>153.78 </h4>
            </div>
            <br>
            <br>
            <br class="">

            <div class="row d-flex justify-content-center mt-2" style="clear:left">

                <p class="card-text font-size-xl credit-card-font font-weight-bold text-white text-center float-left justify-content-center "><span class="animate__animated animate__fadeIn" style="animation-delay: .8s">••••</span> <span class="animate__animated animate__fadeIn" style="animation-delay: .9s">••••</span> <span class="animate__animated animate__fadeIn" style="animation-delay: 1s">••••</span> <span class="animate__animated animate__fadeIn" style="animation-delay: 1.1s">FKD9</span></p>

            </div>
            <div class="row d-flex justify-content-center mt-2" style="clear:left">

                <button type="button" class="animate__animated animate__fadeIn btn btn-outline-light btn-dark btn-pill btn-icon mt-3" style="animation-delay: .4s">
                    <i class="fe-maximize mr-1"></i> Display Your Code
                </button>

            </div>


        </div>

    </div>
        </div>
        <br>
        <div>

        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3 mb-4">
        <button type="button" class="btn btn-dark btn-lg mr-1 animate__animated animate__fadeInUp" style="animation-delay: 0.5s"><i class="fe-dollar-sign mr-2"></i>Add Cash</button>
        <button type="button" class="btn btn-secondary btn-lg ml-1 animate__animated animate__fadeInUp" style="animation-delay: 0.6s"><i class="fe-share mr-2"></i>Send Cash</button>
    </div>

</div>
<div class="bg-secondary mt-5 pb-6">
    <div class="container pt-6">
        <div class="row">
            <div class="col-sm-12 col-md-6 animate__animated animate__fadeIn">
                <div class="mb-7">
                <i class="float-left fe-star pr-2 h1 mt-2 mr-2 "></i>
                <div class="float-left">
                    <h3 class="mb-0 pb-0">Your Rewards</h3>
                    <p class="mt-0 pt-0 font-size-sm">Scan your code at your favorite stores to earn rewards.</p>
                </div>
                </div>
                <div class="pt-0 btn btn-primary btn-raise border-0 shadow-none   mb-2" style="width: 100%; height: 90px;">
                    <div class="card-body d-block w-100 pl-2 p-0">
                        <div class="float-left">
                            <i class="fe-zap mt-3 pt-3 h2 text-white"></i>

                        </div>
                        <div class="float-left ml-4 pt-4">
                            <h6 class="m-0 p-0 text-white-50 font-size-xs text-left">Total Points:</h6>
                            <h4 class="text-white animate__animated animate__fadeIn text-left" style="animation-delay: 0.2s"><p class="font-size-sm float-left"></p>3520<span class="font-size-xs ">points</span> </h4>

                        </div>
                        <i class="fe-chevron-right float-right mt-3 ml-0 pl-0 pt-4 pr-2"></i>
                    </div>

                    </div>
                <div class="w-100 d-block btn btn-dark mt-2" style="z-index: -1;">
                    <h6 class="text-left text-muted font-size-sm pb-0 mb-0 pt-3 pl-3">Current Tier:</h6>
                    <h1 class="text-warning text-left display-4 font-weight-bolder pl-2 mb-0 pb-0">Elevated </h1>
                    <p class="text-left text-warning opacity-75 pt-0 mt-0 ml-2">For the advanced people</p>
                    <button type="button" class="btn btn-translucent-warning btn-block btn-lg mb-2">Your Elevated Benefits</button>
                </div>
                <div class="w-100 d-block btn btn-dark mt-3" style="z-index: -1;">
                    <h6 class="text-left text-muted font-size-sm pb-0 mb-0 pt-3 pl-3">Next Tier:</h6>
                    <h1 class="text-primary text-left display-4 font-weight-bolder pl-2 mb-0 tb-0">Absolute </h1>
                    <p class="text-left text-primary opacity-75 pt-0 mt-0 ml-2">For the experienced users</p>
                    <div class="d-flex align-items-center pt-2 pb-3 ml-3 mr-3">
                        <h6 class="mr-3 text-white-50">3,000</h6>
                        <div class="progress mb-3 bg-faded-secondary " style="height: 4px;">
                            <div class="progress-bar shadow-lg bg-white" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="ml-3 text-white">4,750</h6>
                    </div>
                    <ul class="list-group list-group-flush bg-transparent text-left">
                        <li class="list-group-item bg-transparent"><i class="fe-check mr-2"></i> Reduced prices</li>
                        <li class="list-group-item bg-transparent"><i class="fe-check mr-2"></i> Access to new features</li>
                    </ul>


                    <button type="button" class="btn btn-translucent-primary btn-block btn-lg mb-2 mt-4">Claim Absolute Tier</button>

                </div>
                </div>
            <div class="col-sm-12 col-md-6 animate__animated animate__fadeIn">
                <div class="mb-7">
                    <i class="float-left fe-shopping-bag pr-2 h1 mt-2 mr-2 "></i>
                    <div class="float-left">
                        <h3 class="mb-0 pb-0">Your Locations</h3>
                        <p class="mt-0 pt-0 font-size-sm">Scan your code at your favorite stores to earn rewards.</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="card bg-dark border-0 shadow-none">
                        <div class="card-body justify-content-center text-center mt-7">
                            <div>
                                <img src="src/media/images/svg/cards_no_locations.svg" class="justify-content-center" width="50%">
                            </div>
                            <h2 class="text-white mt-3 opacity-90 mt-4 mb-1">Nothing here... yet!</h2>
                            <p class="text-white opacity-75 pt-0 mt-0 font-size-md pl-3 pr-3">You have yet to book a location or use your card. To use it, visit one of our locations and scan your code at checkout.</p>
                            <button type="button" class="btn btn-translucent-primary mb-5" onclick="window.location = '/s?type=corecard'"><i class="fe-map-pin"></i> Search our locations</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

</body>

<script src="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://demo.createx.studio/around/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/parallax-js/dist/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYue8B6qCoWEbfasU0bByxNY2L44CJhcM&libraries=places"></script>
