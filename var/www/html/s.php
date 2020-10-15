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
<div class="modal fade" id="MODAL_SEARCH_GUIDE_ONBOARDING" style="width: 100%;" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered  " style="width: 100%;" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <div style="width: 30%" class="d-none" id="MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_GROUP">
                    <div class="font-size-sm mb-2" id="MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_TEXT">Step 1 of 3</div>
                    <div class="progress mb-3" style="height: 4px;">
                        <div class="progress-bar" role="progressbar"  style="width: 33%" aria-valuenow="33" id="MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_BAR" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <h6 class="pb-0 mb-0 animate__animated animate__fadeInDown" style="animation-delay: 0.0s;">Before we get going...</h6>
                <div id="MODAL_SEARCH_GUIDE_ONBOARDING_STEP_1" class="animate__animated animate__fadeIn">
                <h2 class="animate__animated animate__fadeInDown mb-1" style="animation-delay: 0.1s;">What kind of event are you planning on having?</h2>
                <p class="animate__animated animate__fadeInDown " style="animation-delay: 0.2s;">Different venues have different purposes. In order to find the best possible venue for your search, please select the type of event you want to have in this space.</p>
                <div>
                    <div class="col-12 mt-5" onclick="Page.onboarding.UI.next();">
                        <ul class="nav nav-pills" style="height: 45px;">

                            <li class="nav-item mt-1">
                                <a href="#" class="nav-link btn-pill bg-faded-danger animate__animated animate__fadeInUp"
                                   style="animation-delay: 0.2s;">🍴 <span class="pl-1 text-danger">Table Reservation</span></a>
                            </li>
                            <li class="nav-item mt-1">
                                <a href="#" class="nav-link btn-pill bg-faded-primary animate__animated animate__fadeInUp"
                                   style="animation-delay: 0.3s;">👰 <span class="pl-1 text-primary">Wedding</span></a>
                            </li>
                            <li class="nav-item mt-1">
                                <a href="#" class="nav-link btn-pill bg-faded-success animate__animated animate__fadeInUp"
                                   style="animation-delay: 0.4s;">👨‍👨‍👦‍👦 <span class="pl-1 text-success">Gathering</span></a>
                            </li>
                            <li class="nav-item mt-1">
                                <a href="#" class="nav-link btn-pill bg-faded-warning animate__animated animate__fadeInUp"
                                   style="animation-delay: 0.5s;">🏢 <span class="pl-1 text-warning">Corporate</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
                <div id="MODAL_SEARCH_GUIDE_ONBOARDING_STEP_2" class="d-none animate__animated animate__fadeIn">
                    <h2 class="animate__animated animate__fadeIn mb-1" style="animation-delay: 0.1s;">Nice! How many people?</h2>
                    <p class="animate__animated animate__fadeIn " style="animation-delay: 0.2s;">Some venues have a limited capacity, while others have a guest requirement.</p>
                    <div>
                            <div style="position:relative;z-index: 20; top: 40px;bottom: 30px;left: 25px;right: 25px;height: 100%;width: 100%;">
                                <i class="fe-users text-muted" style="float: left; font-weight: normal;"></i>

                            </div>

                    <input style="z-index: 15;"
                           oninput="$(this).mask('#,##0', {reverse: true});
                           if (this.value < 1){
                               $('#MODAL_SEARCH_GUIDE_ONBOARDING_STEP_2_BUTTON_CONTINUE').addClass('disabled')
                           }else{
                               $('#MODAL_SEARCH_GUIDE_ONBOARDING_STEP_2_BUTTON_CONTINUE').removeClass('disabled')
                           }; if (parseInt(this.value) > 50000) this.value = '50,000';"
                           class="form-control search_hero " type="text" id="MODAL_SEARCH_GUIDE_ONBOARDING_STEP_2_INPUT_GUEST_COUNT"
                           placeholder="Guests">
                        <button type="button" id="MODAL_SEARCH_GUIDE_ONBOARDING_STEP_2_BUTTON_CONTINUE" class="mt-3 disabled btn btn-primary btn-lg btn-block btn-raise">Continue</button>
                        <button type="button" class="mt-1 btn btn-link btn-block " onclick="Page.onboarding.UI.previous();">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="MODAL_SEARCH_GUIDE_ONBOARDING_START" style="width: 100%;" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-dialog-centered " style="width: 100%;" role="document">
        <div class="modal-content ">
            <div class="modal-body p-5 text-center">
                <h6 class="text-muted mb-0 animate__animated animate__fadeInDown" style="animation-delay: 0.0s">Getting Started</h6>
                <h2 class="mt-0 animate__animated animate__fadeInDown" style="animation-delay: 0.1s">Before We Search</h2>
                <img class="mt-2 mb-2 animate__animated animate__fadeIn" style="animation-delay: 0.2s" src="src/media/images/svg/search_onboarding_find_a_place.svg"/>
                <p class="mt-4 pl-2 pr-2 font-size-md animate__animated animate__fadeInDown" style="animation-delay: 0.3s">In order for us to give you the best results possible, we have get a few details from you. </p>
                <div class="row mb-0 pb-0 pt-4 pl-2 pr-2">
                    <div class="col-12 p-0 animate__animated animate__fadeInDown" style="animation-delay: 0.0s">
                        <button type="button" onclick="Page.onboarding.start(true)" class="btn btn-lg btn-block btn-primary font-size-lg btn-raise">I know what I want</button>
                    </div>
                    <div class="col-12 p-0 pt-2 animate__animated animate__fadeInDown" style="animation-delay: 0.1s">
                        <button type="button" onclick="Page.onboarding.start(false)" class="btn btn-lg btn-block btn-secondary ">I'm just looking</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<style>
    .prevent_scrollbar::-webkit-scrollbar {
        width: 0px;
        background: transparent; /* make scrollbar transparent */
    }
</style>
<div class="container-fluid pl-sm-0 pl-md-5 pr-0 d-flex flex-fill">

    <div class="row d-flex flex-fill pr-0" style="height: 100%">
        <div class="col-sm-12 col-md-6 col-lg-8   flex-column" style="overflow-y: scroll; overflow-x: hidden; height: 92vh;">
            <div class="mb-3 row" style="overflow-x: hidden; overflow-y: scroll;">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                    <div class="animate__animated animate__fadeInDown" style="animation-delay: .4s;">
                        <div class="">
                            <div style="position:relative;z-index: 25; top: 40px;bottom: 30px;left: -25px;right: 25px;height: 100%;width: 100%;">
                                <i class="fe-search text-primary" style="float: right; font-weight: bold;"></i>
                            </div>
                            <div style="position:relative;z-index: 20; top: 40px;bottom: 30px;left: 25px;right: 25px;height: 100%;width: 100%;">
                                <i class="fe-compass text-muted" style="float: left; font-weight: normal;"></i>

                            </div>
                            <input style="z-index: 15;" class="form-control search_hero " type="text"
                                   id="INPUT_LOCATION_SEARCH" value="<? echo $location_search_details['name'] ?>"
                                   onfocus="document.getElementById('LOCATION_SEARCH_RESULTS').classList.remove('d-none'); this.scrollIntoView({behavior:'smooth', block: 'start', inline: 'nearest'}); "
                                   placeholder="Where can we make this happen?">
                            <div style="padding: 1px; animation-delay: 1s; border-radius: 30px;position: absolute; top: 77px; z-index: 60; left: 50%; margin-right: -50%;
    transform: translate(-50%, -50%);  width: 99%;" id="INPUT_LOCATION_SEARCH_PROGRESS"
                                 class="d-none loading_gradient animate__animated animate__fadeIn ">
                            </div>
                            <!--            <iframe src="/src/loading/loading.html">-->

                            <!--            </iframe>-->
                            <div class="card bg-white search_hero p-4 pr-5 pl-5 d-none" id="LOCATION_SEARCH_RESULTS"
                                 style="z-index: 0;">
                                <div class="row" id="LOCATION_SEARCH_RESULTS_INNER">
                                    <div class="text-center col-12 pt-5 pb-5">
                                        <img width="30%" class="animate__animated animate__fadeIn"
                                             style="animation-delay: .2s"
                                             src="/src/media/images/svg/location_search.svg"/>
                                        <h2 class="text-center  pt-5 pb-0 mb-0 animate__animated animate__fadeInUp"
                                            style="animation-delay: .3s">Search a Location to get Started</h2>
                                        <p class="font-size-sm text-muted animate__animated animate__fadeInUp"
                                           style="animation-delay: .5s">You can search literally any location you can
                                            think of. A city, a monument, a street, etc. Give it a shot!</p>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 row  pr-0">
                    <div class="col-6  pr-1">
                        <div class="animate__animated animate__fadeInDown" style="animation-delay: .4s;">
                            <div class="">
                                <div style="position:relative;z-index: 20; top: 40px;bottom: 30px;left: 25px;right: 25px;height: 100%;width: 100%;">
                                    <i class="fe-users text-muted" style="float: left; font-weight: normal;"></i>

                                </div>
                                <input style="z-index: 15;"
                                       oninput="$(this).mask('000'); this.value = this.value + ' Guests'"
                                       class="form-control search_hero " type="text" id="INPUT_LOCATION_RADIUS"
                                       value="60 Guests"
                                       placeholder="Guests">
                                <div style="padding: 1px; animation-delay: 1s; border-radius: 30px;position: absolute; top: 77px; z-index: 60; left: 50%; margin-right: -50%;
    transform: translate(-50%, -50%);  width: 99%;" id="LOCATION_SEARCH_RADIUS_PROGRESS"
                                     class="d-none loading_gradient animate__animated animate__fadeIn ">
                                </div>
                                <!--            <iframe src="/src/loading/loading.html">-->

                                <!--            </iframe>-->
                                <div class="d-none animate__animated animate__fadeInDown"
                                     id="LOCATION_SEARCH_RADIUS_OPTIONS" style="z-index: 100001;">
                                    <div class="dropdown-menu d-inline-block ">
                                        <a class="dropdown-item" href="#">10 miles</a>
                                        <a class="dropdown-item" href="#">20 miles</a>
                                        <a class="dropdown-item" href="#">50 miles</a>
                                        <a class="dropdown-item" href="#">75 miles</a>
                                        <a class="dropdown-item" href="#">100 miles</a>
                                        <a class="dropdown-item" href="#">200 miles</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-6 pl-1 pr-0">
                        <div class="animate__animated animate__fadeInDown" style="animation-delay: .4s;">
                            <div class="">
                                <div style="position:relative;z-index: 25; top: 40px;bottom: 30px;left: -25px;right: 25px;height: 100%;width: 100%;">
                                    <i class="fe-chevron-down text-primary"
                                       style="float: right; font-weight: bold;"></i>
                                </div>
                                <div style="position:relative;z-index: 20; top: 40px;bottom: 30px;left: 25px;right: 25px;height: 100%;width: 100%;">
                                    <i class="fe-filter text-muted" style="float: left; font-weight: normal;"></i>

                                </div>
                                <input style="z-index: 15;" class="form-control search_hero bg-white" readonly
                                       type="text" id="INPUT_LOCATION_TAGS" value="Filters"
                                       onfocus="document.getElementById('LOCATION_SEARCH_RADIUS_OPTIONS').classList.remove('d-none');"
                                       onblur="document.getElementById('LOCATION_SEARCH_RADIUS_OPTIONS').classList.add('d-none');">
                                <div style="padding: 1px; animation-delay: 1s; border-radius: 30px;position: absolute; top: 77px; z-index: 60; left: 50%; margin-right: -50%;
    transform: translate(-50%, -50%);  width: 99%;" id="LOCATION_SEARCH_RADIUS_PROGRESS"
                                     class="d-none loading_gradient animate__animated animate__fadeIn ">
                                </div>
                                <!--            <iframe src="/src/loading/loading.html">-->

                                <!--            </iframe>-->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <ul class="nav nav-pills" style=" overflow-x: scroll;
    overflow-y: hidden;height: 45px;">
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-pill bg-primary animate__animated animate__fadeInUp"
                               style="animation-delay: 0.1s;">👰 <span class="pl-1 text-white">Wedding</span></a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeInDown">
                            <p class="pt-2">|</p>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-pill animate__animated animate__fadeInUp"
                               style="animation-delay: 0.2s;">🏈 <span class="pl-1">Sports</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-pill animate__animated animate__fadeInUp"
                               style="animation-delay: 0.3s;">⭐️ <span class="pl-1">Top Rated</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-pill animate__animated animate__fadeInUp"
                               style="animation-delay: 0.4s;">🍸 <span class="pl-1">21 & Older</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-pill animate__animated animate__fadeInUp"
                               style="animation-delay: 0.5s;">🌳 <span class="pl-1">Outdoors</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn-pill animate__animated animate__fadeInUp"
                               style="animation-delay: 0.6s;"> <span class="pl-1">+32 more</span></a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="justify-content-center align-self-center animate__animated animate__fadeIn"
                 style="pointer-events: none;">
                <div><h2 class="mb-0 pb-0 pb-2" style="pointer-events: none;"><i class="fe-search"></i></h2></div>
            </div>
            <div class="" style="position:relative;pointer-events: none;">
                <h6 class="text-muted pb-0 mb-0 animate__animated animate__fadeInUp"
                    style="animation-delay: 0.2s;position:relative;pointer-events: none;">Search for a Venue</h6>
                <h2 class="pb-0 mb-0 animate__animated animate__fadeInUp"
                    style="animation-delay: 0.3s;position:relative;pointer-events: none;"> Results for
                    '<? echo $location_search_details['name'] ?>'</h2>
                <p class="font-size-sm animate__animated animate__fadeInUp"
                   style="animation-delay: 0.5s;position:relative;pointer-events: none;">0 locations found.</p>
            </div>
            <!--            <div id="progress" class="justify-content-center">-->
            <!--                <div class="text-center mb-5 mt-5 animate__animated animate__fadeIn" style="display: flex;flex-direction: column;align-items: center; animation-duration: .5s;">-->
            <!--                    <div class="spinner">-->
            <!--                        <div class="leftWrapper">-->
            <!--                            <div class="left">-->
            <!--                                <div class="circle"></div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="rightWrapper">-->
            <!--                            <div class="right">-->
            <!--                                <div class="circle"></div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="text-center pt-5 animate__fadeIn animate__animated">
                <img width="30%" src="/src/media/images/svg/no_results_alt.svg">
                <h3 class="pt-2 pb-0 mb-0">We couldn't find any results</h3>
                <p class="font-size-sm">Since we are a newer company, we might have not have coverage in your area.</p>
                <button type="button" class="btn btn-translucent-primary ">
                    <i class="fe-map-pin mr-2"></i>
                    Check our Coverage
                </button>
            </div>
            <!--            <div class="align-content-center">-->
            <!--            <div class="text-center">-->
            <!--                <h2></h2>-->
            <!--                <div class="filter_bubble frame mr-1 " search_fitler search_type="venue_type" value="dinner_reservation" onclick="Page.filters.emoji.bubbles.select(this)" style="animation-delay: .5s">-->
            <!--                    <div class="align-content-center filter_bubble emoji_circle bg-faded-danger animate__animated animate__zoomIn" style="animation-delay: .3s">-->
            <!--                        <p class="mb-1 pb-1  text-center filter_bubble emoji">🍽</p>-->
            <!--                    </div>-->
            <!--                    <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .5s; font-weight: 600;">Just Dinner</p>-->
            <!--                </div>-->
            <!--                <div class="filter_bubble frame  mr-1" search_fitler search_type="venue_type" value="wedding" onclick="Page.filters.emoji.bubbles.select(this)">-->
            <!--                    <div class="align-content-center filter_bubble emoji_circle bg-faded-primary animate__animated animate__zoomIn" style="animation-delay: .4s">-->
            <!--                        <p class="mb-1 pb-1  text-center filter_bubble emoji">👰</p>-->
            <!--                    </div>-->
            <!--                    <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .6s; font-weight: 600;">Wedding</p>-->
            <!--                </div>-->
            <!--                <div class="filter_bubble frame  mr-1" search_fitler search_type="venue_type" value="gathering" onclick="Page.filters.emoji.bubbles.select(this)" >-->
            <!--                    <div class="align-content-center filter_bubble emoji_circle bg-faded-success animate__animated animate__zoomIn" style="animation-delay: .5s">-->
            <!--                        <p class="mb-1 pb-1  text-center filter_bubble emoji">👨‍👨‍👦‍👦</p>-->
            <!--                    </div>-->
            <!--                    <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .7s; font-weight: 600;">Gathering</p>-->
            <!--                </div>-->
            <!--                <div class="filter_bubble frame " search_fitler search_type="venue_type" value="corporate" onclick="Page.filters.emoji.bubbles.select(this)">-->
            <!--                    <div class="align-content-center filter_bubble emoji_circle bg-faded-warning animate__animated animate__zoomIn"  style="animation-delay: .6s">-->
            <!--                        <p class="mb-1 pb-1  text-center filter_bubble emoji">🏢</p>-->
            <!--                    </div>-->
            <!--                    <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .8s; font-weight: 600;">Corporate</p>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            </div>-->
        </div>

        <style>
            .iframe-container {
                overflow: hidden;
                /* 16:9 aspect ratio */
                padding-top: 56.25%;
                position: relative;
            }

            .iframe-container iframe {
                border: 0;
                height: 100%;
                left: 0;
                position: absolute;
                top: 0;
                width: 100%;
            }
        </style>
        <div class="d-sm-none d-md-block d-block col-md-6 col-lg-4 pr-0 ">
            <div class="iframe-full-height" style="height: 100%;">
                <div id="map" class="rounded position-absolute w-100 h-100 border-0"></div>
                <iframe
                        class="rounded position-absolute w-100 h-100 border-0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBu2GkB2ltXHsgM8xLYv4_TbEmGuoY-SIM
    &q=place_id:ChIJs--MqP1YwokRBwAhjXWIHn8" allowfullscreen>
                </iframe>
            </div>

        </div>
        <button class="btn btn-outline-secondary mb-3" type="button" data-toggle="modal" data-target="#modalCentered">Vertically centered modal</button>
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
<script>
    $(document).onload(function () {
        $("#INPUT_LOCATION_TAGS")[0].addEventListener('select', function () {
            this.selectionStart = this.selectionEnd;
        }, false);
    })
</script>
<script>
    "use strict";

    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8
        });
    }

    let Page = {};
    Page.state = {};
    Page.state.ready = function (callback) {

    }

    Page.state.ready(function (){
        if (!slately.search.URL.expand()){
            $('#MODAL_SEARCH_GUIDE_ONBOARDING_START').modal({backdrop: 'static', keyboard: false})
        }
    })
    Page.onboarding = {};
    Page.onboarding.pro_mode = false;
    Page.onboarding.start = function (pro_mode){
        Page.onboarding.pro_mode = pro_mode;
        if (pro_mode){
            $("#MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_GROUP").removeClass('d-none')
        }
        $('#MODAL_SEARCH_GUIDE_ONBOARDING_START').modal('toggle');

        setTimeout(function (){
            $('#MODAL_SEARCH_GUIDE_ONBOARDING').modal({backdrop: 'static', keyboard: false});

        },130)
    }
    Page.onboarding.UI = {};
    Page.onboarding.UI.stack_order = [
        "#MODAL_SEARCH_GUIDE_ONBOARDING_STEP_1",
        "#MODAL_SEARCH_GUIDE_ONBOARDING_STEP_2",
        "#MODAL_SEARCH_GUIDE_ONBOARDING_STEP_3"
    ];
    Page.onboarding.UI.current = 0;
    Page.onboarding.UI.previous = function(){
        $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).addClass("animate__animated");
        $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).removeClass("animate__fadeIn");
        $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).addClass("animate__fadeOut");
        setTimeout(function (){
            $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).addClass("d-none")
            Page.onboarding.UI.current--;
            if (Page.onboarding.UI.current < 0) return;
            $("#MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_TEXT").html("Step " + (Page.onboarding.UI.current+1) + " of " + Page.onboarding.UI.stack_order.length)
            $("#MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_BAR").width( (Math.round(((Page.onboarding.UI.current+1)/Page.onboarding.UI.stack_order.length)*100))+"%");
            $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).removeClass("d-none")
        }, 250);
    }
    Page.onboarding.UI.next = function(){
        if (!Page.onboarding.pro_mode){
            $('#MODAL_SEARCH_GUIDE_ONBOARDING').modal('toggle');
            return ;
        }
        $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).addClass("animate__animated");
        $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).removeClass("animate__fadeIn");
        $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).addClass("animate__fadeOut");
        setTimeout(function (){
            $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).addClass("d-none")
            Page.onboarding.UI.current++;

            $("#MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_TEXT").html("Step " + (Page.onboarding.UI.current+1) + " of " + Page.onboarding.UI.stack_order.length)
            $("#MODAL_SEARCH_GUIDE_ONBOARDING_PROGRESS_BAR").width( (Math.round(((Page.onboarding.UI.current+1)/Page.onboarding.UI.stack_order.length)*100))+"%");
            $(Page.onboarding.UI.stack_order[Page.onboarding.UI.current]).removeClass("d-none")
        }, 250);

    }


</script>