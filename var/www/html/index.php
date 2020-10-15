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
<main class="">

    <section class="py-6 py-sm-6" >
        <div class="container py-lg-4">
            <div class="">
                <div class="">
                    <h3 class="text-dark opacity-25 animate__animated animate__fadeInDown" style="animation-delay: 0.2s; ">— <?
                        if (\Union\API\security\Auth::logged_in()){
                            echo "Welcome Back, " . \Union\API\accounts\Account::get_first_name() . ".";
                        }else{
                            echo "We're so glad you're here";
                        }?>
                    <h3 class="display-2 text-gradient pb-4  animate__animated animate__fadeInDown" style="font-weight: 500;">Stress shouldn't be part of your <br class="d-none d-lg-block"> event budget.</h3>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start animate__animated animate__fadeIn"><a class="cs-video-btn mr-3 animate__animated animate__fadeInDown" style=" animation-delay: .3s;" href="https://www.youtube.com/watch?v=SE3apoZy4qA" data-sub-html="<h6 class=&quot;font-size-sm text-light&quot;>Goby Electric Toothbrush Review</h6>" lg-uid="lg0"></a><span class="text-muted   animate__animated animate__fadeInDown" style=" animation-delay: .4s;max-width: 15rem;"><h4 class="m-0 p-0 text-dark">Who are we?</h4> Let's show you what we can do for you</span></div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="animate__animated animate__fadeInDown" style="animation-delay: .4s;">
            <div class="">
                <div style="position:relative;z-index: 25; top: 40px;bottom: 30px;left: -25px;right: 25px;height: 100%;width: 100%;">
                    <i class="fe-search text-primary" style="float: right; font-weight: bold;"></i>
                </div>
                <div style="position:relative;z-index: 20; top: 40px;bottom: 30px;left: 25px;right: 25px;height: 100%;width: 100%;">
                    <i class="fe-compass text-muted" style="float: left; font-weight: normal;"></i>

                </div>
                <input style="z-index: 15;" class="form-control search_hero " type="text" id="INPUT_LOCATION_SEARCH" value="" onfocus="document.getElementById('LOCATION_SEARCH_RESULTS').classList.remove('d-none'); this.scrollIntoView({behavior:'smooth', block: 'start', inline: 'nearest'})" placeholder="Where can we make this happen?">
                <div style="padding: 1px; animation-delay: 1s; border-radius: 30px;position: absolute; top: 77px; z-index: 60; left: 50%; margin-right: -50%;
    transform: translate(-50%, -50%);  width: 99%;" id="INPUT_LOCATION_SEARCH_PROGRESS" class="d-none loading_gradient animate__animated animate__fadeIn " >
            </div>
<!--            <iframe src="/src/loading/loading.html">-->

<!--            </iframe>-->
            <div class="card bg-white search_hero p-4 pr-5 pl-5 d-none" id="LOCATION_SEARCH_RESULTS" style="z-index: 0;">
                <div class="row" id="LOCATION_SEARCH_RESULTS_INNER">
                    <div class="text-center col-12 pt-5 pb-5">
                        <img width="30%" class="animate__animated animate__fadeIn" style="animation-delay: .2s" src="/src/media/images/svg/location_search.svg"/>
                        <h2 class="text-center  pt-5 pb-0 mb-0 animate__animated animate__fadeInUp" style="animation-delay: .3s" >Search a Location to get Started</h2>
                        <p class="font-size-sm text-muted animate__animated animate__fadeInUp" style="animation-delay: .5s" >You can search literally any location you can think of. A city, a monument, a street, etc. Give it a shot!</p>

                    </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <div class="container mt-4  ">
        <h3 class="text-center mt-4 pt-3 animate__animated animate__fadeInDown" style="animation-delay: .3s;">What are you here for?</h3>
        <div style="padding-top: 10px; overflow-x: auto;
    white-space: nowrap; overflow-y: scroll;" class="d-flex mt-4 mb-sm-2 mb-md-3 mb-lg-4 prevent_scrollbar">

            <div class="filter_bubble frame mr-1 " search_fitler search_type="venue_type" value="dinner_reservation" onclick="Page.filters.emoji.bubbles.select(this)" style="animation-delay: .5s">
                <div class="align-content-center filter_bubble emoji_circle bg-faded-danger animate__animated animate__zoomIn" style="animation-delay: .3s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🍽</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .5s; font-weight: 600;">Just Dinner</p>
            </div>
            <div class="filter_bubble frame  mr-1" search_fitler search_type="venue_type" value="wedding" onclick="Page.filters.emoji.bubbles.select(this)">
                <div class="align-content-center filter_bubble emoji_circle bg-faded-primary animate__animated animate__zoomIn" style="animation-delay: .4s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">👰</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .6s; font-weight: 600;">Wedding</p>
            </div>
            <div class="filter_bubble frame  mr-1" search_fitler search_type="venue_type" value="gathering" onclick="Page.filters.emoji.bubbles.select(this)" >
                <div class="align-content-center filter_bubble emoji_circle bg-faded-success animate__animated animate__zoomIn" style="animation-delay: .5s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">👨‍👨‍👦‍👦</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .7s; font-weight: 600;">Gathering</p>
            </div>
            <div class="filter_bubble frame " search_fitler search_type="venue_type" value="corporate" onclick="Page.filters.emoji.bubbles.select(this)">
                <div class="align-content-center filter_bubble emoji_circle bg-faded-warning animate__animated animate__zoomIn"  style="animation-delay: .6s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🏢</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .8s; font-weight: 600;">Corporate</p>
            </div>
            <div class="m-3   border-right  animate__animated animate__fadeIn" style="animation-delay: .6s; float: left;"> <p>&nbsp</p></div>
            <div class="filter_bubble frame  ml-2" search_fitler search_type="tag" value="outdoor" onclick="Page.filters.emoji.bubbles.select(this)">
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: .7s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🌳</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: .9s;" >Outdoor</p>
            </div>
            <div class="filter_bubble frame  ml-2" >
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: .8s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🏚</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: 1.0s;"  >Rustic</p>
            </div>
            <div class="filter_bubble frame  ml-2" >
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: .9s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">👨‍👩‍👧</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: 1.1s;" >For Kids</p>
            </div>
            <div class="filter_bubble frame  ml-2" >
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: 1.0s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🐶</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: 1.2s;" >Pet Friendly</p>
            </div>
            <div class="filter_bubble frame  ml-2" >
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: 1.1s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🍸</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: 1.3s;" >21 & older</p>
            </div>
            <div class="filter_bubble frame  ml-2" >
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: 1.2s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">⭐️</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: 1.4s;" >Top Rated</p>
            </div>
            <div class="filter_bubble frame  ml-2" >
                <div class="align-content-center filter_bubble emoji_circle bg-secondary animate__animated animate__zoomIn" style="animation-delay: 1.3s">
                    <p class="mb-1 pb-1  text-center filter_bubble emoji">🏈</p>
                </div>
                <p class="text-center mt-2 animate__animated animate__fadeInUp" style="animation-delay: 1.5s;" >Sports</p>
            </div>

        </div>
    </div>
    <div class="overlay animate__animated animate__fadeIn d-none"></div>
    <div id="map"></div>
</main>
<div style="padding: 3px; animation-delay: 1s;" class="multi_gradient animate__animated animate__fadeIn" >
</div>
<style>
    #map-canvas {
        height: 130px;
        margin-bottom: 10px;
    }

    table {
        border-collapse: collapse;
        margin-left: 20px;
    }

    table td {
        padding: 3px 5px;
    }

    label {
        display: inline-block;
        width: 160px;
        font-size: 11px;
        color: #777;
    }

    input {
        border: 1px solid #ccc;
        width: 170px;
        padding: 3px 5px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
    }

    .pac-container {
        background-color: #fff;
        z-index: 1000;
        border-radius: 2px;
        font-size: 11px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .3);
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        overflow: hidden;
        width: 350px;
    }

    .pac-icon {
        width: 15px;
        height: 20px;
        margin-right: 7px;
        margin-top: 6px;
        display: inline-block;
        vertical-align: top;
        background-image: url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);
        background-size: 34px;
    }

    .pac-icon-marker {
        background-position: -1px -161px;
    }

</style>

<script>
    $(document).ready(function (){
        setTimeout(function (){
            $("div.emoji_circle").each(function(){this.classList.remove("animate__animated")})
        }, 2200)
    });
    Page = {};
    Page.filters = {}
    Page.filters.emoji = {};
    Page.filters.emoji.bubbles = {};
    Page.filters.emoji.bubbles.select = function(obj){
        $(obj).children()[0].classList.add()
    }
</script>
<script src="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://demo.createx.studio/around/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/parallax-js/dist/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYue8B6qCoWEbfasU0bByxNY2L44CJhcM&libraries=places"></script>
<script>
    Page.search = {};
    Page.search.AutoComplete = {}

    function initialize() {

        results = document.getElementById('LOCATION_SEARCH_RESULTS');

        var mapOptions = {
            zoom: 5,
            center: new google.maps.LatLng(50, 50)
        };


        // Bind listener for address search
        google.maps.event.addDomListener(document.getElementById('INPUT_LOCATION_SEARCH'), 'input', function() {
            if (document.getElementById('INPUT_LOCATION_SEARCH').value === ""){
                document.getElementById('LOCATION_SEARCH_RESULTS').classList.add('d-none');
            }else{
                document.getElementById('INPUT_LOCATION_SEARCH').scrollIntoView({behavior:'smooth', block: 'start', inline: 'nearest'})
                document.getElementById('LOCATION_SEARCH_RESULTS').classList.remove('d-none');
            }
            getPlacePredictions(document.getElementById('INPUT_LOCATION_SEARCH').value);
        });


        autocompleteService = new google.maps.places.AutocompleteService();
        // placesService = new google.maps.places.PlacesService(map);
    }

    // Get place predictions
    function getPlacePredictions(search) {
        autocompleteService.getPlacePredictions({
            input: search,
            types: ['establishment', 'geocode'],
            location: new google.maps.LatLng({
                lat: 34.852,
                lng: 82.394
            }),
            radius: 150000
        }, callback);
    }

    // Get place details
    function getPlaceDetails(placeId) {

        var request = {
            placeId: placeId
        };

        placesService.getDetails(request, function(place, status) {

            if (status === google.maps.places.PlacesServiceStatus.OK) {

                var center = place.geometry.location;
                var marker = new google.maps.Marker({
                    position: center,
                    map: map
                });

                map.setCenter(center);

                // Hide autocomplete results
                results.style.display = 'none';
            }
        });
    }

    // Place search callback
    function callback(predictions, status) {
        const capitalLetters = (s) => {
            return s.trim().split(" ").map(i => i[0].toUpperCase() + i.substr(1)).reduce((ac, i) => `${ac} ${i}`);
        }
        console.log(predictions)
        let HTML = "";
        predictions.forEach(function (prediction){
            let name = prediction.structured_formatting.main_text;
            let place_id = prediction.place_id;
            let type = prediction.types[0];
            let county = prediction.terms[prediction.terms.length-1].value
            let state = "";
            let abridged = false;
            let abridged_stronger = false;
            let city = "";
            try {
                 city = prediction.terms[prediction.terms.length-3].value
            }catch (e) {
                 city = "";
                abridged = true;
            }
            try {
                state = prediction.terms[prediction.terms.length-2].value;
            }catch (e) {
                abridged_stronger = true;
                state = "";
            }
            let f_type = "";
            type.split("_").forEach(function (item){
                f_type += capitalLetters(item) + " ";
            })
            type = f_type.trim();
            if (type === 'Colloquial Area'){
                type = "Region"
            }
            let description = `A ${(type)} in ${city}, ${state} ${county}`
            if (type === 'Locality' || abridged){
                type = "City";
                name += `, ${state}`
                description = `A ${(type)} in ${state}, ${county}`
            }
            if (name.length >= 25){
                name = name.substring(0,23) + "...";
            }
            if (description.length >= 30){
                description = description.substring(0,28) + "...";
            }
            console.log(type)
            if (type === 'Country'){
                description = `A ${(type)}`
            }
            description = description.replace(/,\s*$/, "");
            name = name.replace(/,\s*$/, "")
            HTML += `<div class="col-lg-4 col-md-6 col-sm-12 p-0 animate__animated animate__fadeIn" onclick="Page.search.AutoComplete.final_callback('${place_id}')" style="overflow: hidden;">
                        <div class=" shadow-none border-0 btn d-flex btn-secondary text-left pt-2 pb-2 pl-3 pr-3 m-2 ">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fe-compass text-center text-primary lead align-content-center pl-4 animate__animated animate__zoomIn"></i>
                                    </div>
                                </div>
                                <div class="col-10 pl-4">
                                    <p class="m-0 p-0 pt-4 font-size-xl animate__animated animate__fadeInUp text-truncate" style="font-weight: 410; line-height: 1.3;" >${name}</p>
                                    <p class="m-0 p-0 pt-0 pb-4 font-size-ms text-muted animate__animated animate__fadeIn text-truncate" style="animation-delay: .5s; overflow-y: hidden">${description}</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
            console.log(`${capitalLetters(name)} \n  ${description}`);
            console.log("\n")
        })
        HTML += `<div class="col-lg-4 col-md-6 col-sm-12 p-0 animate__animated animate__fadeIn">
                        <div class=" shadow-none btn d-flex btn-outline-secondary text-left pt-2 pb-2 pl-3 pr-3 m-2 ">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fe-help-circle text-center text-warning lead align-content-center pl-4 animate__animated animate__zoomIn"></i>
                                    </div>
                                </div>
                                <div class="col-10 pl-4">
                                    <p class="m-0 p-0 pt-4 font-size-xl animate__animated animate__fadeIn" style="animation-delay:.2s; font-weight: 410; line-height: 1.3;" >Can't Find Your City?</p>
                                    <p class="m-0 p-0 pt-0 pb-4 font-size-ms text-muted animate__animated animate__fadeIn" style="animation-delay: .3s">Vote for your city here.</p>
                                </div>
                            </div>
                        </div>

                    </div>`
        $("#LOCATION_SEARCH_RESULTS_INNER").html(HTML);
    }
    Page.search.AutoComplete.final_callback = function (location_id){
        window.location = window.location.origin + "/s?location=" + location_id;
    }

    // var autocompleteService, placesService, results, map;
    //
    // function initialize() {
    //
    //     results = document.getElementById('results');
    //
    //     var mapOptions = {
    //         zoom: 5,
    //         center: new google.maps.LatLng(50, 50)
    //     };
    //
    //     map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    //
    //     // Bind listener for address search
    //     google.maps.event.addDomListener(document.getElementById('address'), 'input', function() {
    //
    //         results.style.display = 'block';
    //         getPlacePredictions(document.getElementById('address').value);
    //     });
    //
    //     // Show results when address field is focused (if not empty)
    //     google.maps.event.addDomListener(document.getElementById('address'), 'focus', function() {
    //
    //         if (document.getElementById('address').value !== '') {
    //
    //             results.style.display = 'block';
    //             getPlacePredictions(document.getElementById('address').value);
    //         }
    //     });
    //
    //     // Hide results when click occurs out of the results and inputs
    //     google.maps.event.addDomListener(document, 'click', function(e) {
    //
    //         if ((e.target.parentElement.className !== 'pac-container') && (e.target.parentElement.className !== 'pac-item') && (e.target.tagName !== 'INPUT')) {
    //
    //             results.style.display = 'none';
    //         }
    //     });
    //
    //     autocompleteService = new google.maps.places.AutocompleteService();
    //     placesService = new google.maps.places.PlacesService(map);
    // }
    //
    // // Get place predictions
    // function getPlacePredictions(search) {
    //
    //     autocompleteService.getPlacePredictions({
    //         input: search,
    //         types: ['establishment', 'geocode']
    //     }, callback);
    // }
    //
    // // Get place details
    // function getPlaceDetails(placeId) {
    //
    //     var request = {
    //         placeId: placeId
    //     };
    //
    //     placesService.getDetails(request, function(place, status) {
    //
    //         if (status === google.maps.places.PlacesServiceStatus.OK) {
    //
    //             var center = place.geometry.location;
    //             var marker = new google.maps.Marker({
    //                 position: center,
    //                 map: map
    //             });
    //
    //             map.setCenter(center);
    //
    //             // Hide autocomplete results
    //             results.style.display = 'none';
    //         }
    //     });
    // }
    //
    // // Place search callback
    // function callback(predictions, status) {
    //
    //     // Empty results container
    //     results.innerHTML = '';
    //
    //     // Place service status error
    //     if (status != google.maps.places.PlacesServiceStatus.OK) {
    //         results.innerHTML = '<div class="pac-item pac-item-error">Your search returned no result. Status: ' + status + '</div>';
    //         return;
    //     }
    //
    //     // Build output with custom addresses
    //     results.innerHTML += '<div class="pac-item custom"><span class="pac-icon pac-icon-marker"></span>My home address</div>';
    //     results.innerHTML += '<div class="pac-item custom"><span class="pac-icon pac-icon-marker"></span>My work address</div>';
    //
    //     // Build output for each prediction
    //     for (var i = 0, prediction; prediction = predictions[i]; i++) {
    //
    //         // Insert output in results container
    //         results.innerHTML += '<div class="pac-item" data-placeid="' + prediction.place_id + '" data-name="' + prediction.terms[0].value + '"><span class="pac-icon pac-icon-marker"></span>' + prediction.description + '</div>';
    //     }
    //
    //     var items = document.getElementsByClassName("pac-item");
    //
    //     // Results items click
    //     for (var i = 0, item; item = items[i]; i++) {
    //
    //         item.onclick = function() {
    //
    //             if (this.dataset.placeid) {
    //                 getPlaceDetails(this.dataset.placeid);
    //             }
    //         };
    //     }
    // }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
</html>