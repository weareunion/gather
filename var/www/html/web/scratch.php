<head>
    <meta charset="utf-8">
    <title>Around | Multipurpose Bootstrap Template
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Around - Multipurpose Bootstrap Template">
    <meta name="keywords" content="bootstrap, business, consulting, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, multipurpose, product landing, shop, software, ui kit, web studio, landing, html5, css3, javascript, gallery, slider, touch, creative">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="https://demo.createx.studio/around/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://demo.createx.studio/around/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://demo.createx.studio/around/favicon-16x16.png">
    <link rel="mask-icon" color="#5bbad5" href="https://demo.createx.studio/around/safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#766df4">
    <meta name="theme-color" content="#ffffff">
    <!-- Page loading styles-->
    <style>
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
<!-- Google Tag Manager (noscript)-->
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
</noscript>
<!-- Page loading spinner-->

<main class="cs-page-wrapper">

    <div class="modal fade" id="COMPONENT_ESTIMATORcontactUsModal" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Let's have a Chat!</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="media pb-3 border-bottom">
                                    <i class="fe-map-pin font-size-lg mt-2 mb-0 text-primary"></i>
                                    <div class="media-body pl-3">
                                        <span class="font-size-ms text-muted">Find us</span>
                                        <a href="#" class="d-block nav-link-style font-size-sm">769, Industrial Dr, West Chicago, IL 60185, USA</a>
                                    </div>
                                </li>
                                <li class="media pt-2 pb-3 border-bottom">
                                    <i class="fe-phone font-size-lg mt-2 mb-0 text-primary"></i>
                                    <div class="media-body pl-3">
                                        <span class="font-size-ms text-muted">Call us</span>
                                        <a href="tel:+184725276533" class="d-block nav-link-style font-size-sm">+1 (847) 252 765 33</a>
                                    </div>
                                </li>
                                <li class="media pt-2">
                                    <i class="fe-mail font-size-lg mt-2 mb-0 text-primary"></i>
                                    <div class="media-body pl-3">
                                        <span class="font-size-ms text-muted">Write us</span>
                                        <a href="mailto:email@example.com" class="d-block nav-link-style font-size-sm">email@example.com</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron" id="COMPONENT_ESTIMATOR_BREAK_INTRO">
        <h1>👋 Hi! We're so glad you're here!</h1>
        <p class="lead">You can use this calculator to estimate the price of your event or GATHERing.</p>
        <hr class="my-4">
        <p class="pb-3">Please keep in mind that this is only an estimate, and that prices are subject to change.</p>
        <a href="#" class="btn btn-primary btn-shadow mt-2" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_INTRO', 'COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT')" role="button"> Let's Estimate it! <i class="fe-arrow-right ml-2"></i></a>

        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT">

        <h1>💌 How many people are we going send invites to?</h1>


        <p class="lead">Gather takes care of your invites and event reminders.
        <div class="pb-5"></div>
        <div class="row ">
            <div class="col-md-5 col-sm-1"></div>
            <div class="form-group col-md-2 col-sm-10 needs-validation">
                <h4>I want to invite...</h4>
                <input class="form-control form-control-lg controller-guest-numbers" type="text" id="COMPONENT_ESTIMATOR_INPUT_GUESTS_INVITED" placeholder="Guests" required>
                <div class="invalid-feedback">Please choose a username.</div>
                <div class="valid-feedback">Looks good!</div>
                <small class="form-text text-warning text-muted " id="COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_MESSAGE">You can have up to <span id="COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_MESSAGE_CAPACITY_FIGURE"> --</span> guests.</a></small>
                <small class="form-text text-warning text-muted d-none" id="COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_CAPACITY">We currently have a <span class="text-warning"> limited maximum capacity of <span id="COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_CAPACITY_FIGURE"> --</span>  </span> due to COVID-19. <a href="#" class="cs-fancy-link">More Info</a></small>
            </div>
            <div class="col-md-3"></div>
        </div>
        </p>
        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-primary btn-shadow mt-2 disabled" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT', 'COMPONENT_ESTIMATOR_BREAK_TIME')" id="COMPONENT_ESTIMATOR_BREAK_INTRO_BUTTON_CONTINUE" role="button" > Continue <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_TIME">

        <h1>⏳ About how long will the event last?</h1>


        <p class="lead">This will help determine your options furter.
        <div class="pb-5"></div>
        <div class="row ">
            <div class="col-md-5 col-sm-1"></div>
            <div class="form-group col-md-2 col-sm-10 needs-validation">
                <h4>This event will last...</h4>
                <input class="form-control form-control-lg controller-guest-numbers" type="text" id="COMPONENT_ESTIMATOR_INPUT_TIME_HOURS" placeholder="Hours" required>
                <small class="form-text text-warning text-muted ">An event can last up to <span id="COMPONENT_ESTIMATOR_BREAK_TIME_MESSAGE_HOURS_FIGURE"></span> depending on the venue. Smaller event spaces have a time limit of 4 hours.</a></small>
            </div>
            <div class="col-md-3"></div>
        </div>
        </p>
        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-secondary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_TIME', 'COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT')"> <i class="fe-arrow-left mr-2"></i>Back </a>
        <a href="#" class="btn btn-primary btn-shadow mt-2 disabled" id="COMPONENT_ESTIMATOR_BREAK_TIME_BUTTON_CONTINUE" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_TIME', 'COMPONENT_ESTIMATOR_VENDOR_CARD')" > Continue <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_VENDOR_CARD">

        <h1>🥂 How much would you like to give each guest for food and drink?</h1>


        <p class="lead">Some event spaces require food and beverage cards to be paid in advance
        <div class="pb-5"></div>
        <div class="row ">
            <div class="col-md-5 col-sm-1"></div>
            <div class="form-group col-md-2 col-sm-10 needs-validation">
                <h4>Each guest will have... </h4>
                <input class="form-control form-control-lg controller-guest-numbers" type="text" id="COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_AMOUNT" placeholder="$" required>
                <div class="custom-control custom-switch pt-4 pb-2">
                    <input type="checkbox" class="custom-control-input" id="COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_TOGGLE" onchange="$('#COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_AMOUNT')[0].disabled = this.checked; EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_payable = this.checked; if (this.checked){
                        $('#COMPONENT_ESTIMATOR_VENDOR_CARD_BUTTON_CONTINUE').removeClass('disabled')
                    }else{HELPER_COMPONENT_ESTIMATOR_VENDOR_CARD_TOGGLE($('#COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_AMOUNT')[0])}">
                    <label class="custom-control-label" for="COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_TOGGLE">I want the guests to pay for this</label>
                </div>
                <small class="form-text text-warning text-muted ">Some venues require upfront payment (such as booking the entire building) and some have a minimum payment.</a></small>
            </div>
            <div class="col-md-3"></div>
        </div>
        </p>
        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-secondary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_VENDOR_CARD', 'COMPONENT_ESTIMATOR_BREAK_TIME')"> <i class="fe-arrow-left mr-2"></i>Back </a>
        <a href="#" class="btn btn-primary btn-shadow mt-2 disabled" id="COMPONENT_ESTIMATOR_VENDOR_CARD_BUTTON_CONTINUE" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_VENDOR_CARD', 'COMPONENT_ESTIMATOR_BREAK_AV')"> Continue <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_AV">
        <h1>📺 Do you need a projector?</h1>
        <p class="lead">Some of our venues have Audio Video services.</p>
        <div class="pb-5"></div>
        <div class="row d-flex justify-content-center">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.projector = true">
                <a href="#" class="nav-link active" id="pills-home1" data-toggle="pill" role="tab" aria-controls="home1" aria-selected="true">
                    <i class="fe-check mr-2"></i>
                    Yes, I would!
                </a>
            </li>
            <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.projector = false">
                <a href="#" class="nav-link btn-secondary" id="pills-profile1" data-toggle="pill" role="tab" aria-controls="profile1" aria-selected="false">
                    <i class="fe-x mr-2"></i>
                    No Thanks!
                </a>
            </li>
        </ul>
        </div>
        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-secondary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_AV', 'COMPONENT_ESTIMATOR_VENDOR_CARD')"> <i class="fe-arrow-left mr-2"></i>Back </a>
        <a href="#" class="btn btn-primary btn-shadow mt-2 " role="button"  onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_AV', 'COMPONENT_ESTIMATOR_BREAK_ENTRY')"> Continue <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_ENTRY">
        <h1>🎫 Who will pay the entry fee?</h1>
        <p class="lead">Some of our venues have an entry fee. They usually range from $1-3 per person.</p>
        <div class="pb-5"></div>
        <div class="row d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.guest_payable_entry_fee = true">
                    <a href="#" class="nav-link active" id="pills-home1" data-toggle="pill" role="tab" aria-controls="home1" aria-selected="true">
                        <i class="fe-check mr-2"></i>
                        Yep, I'll pay it!
                    </a>
                </li>
                <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.guest_payable_entry_fee = false">
                    <a href="#" class="nav-link btn-secondary" id="pills-profile1" data-toggle="pill" role="tab" aria-controls="profile1" aria-selected="false">
                        <i class="fe-x mr-2"></i>
                        No, they will!
                    </a>
                </li>
            </ul>
        </div>
        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-secondary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_ENTRY', 'COMPONENT_ESTIMATOR_BREAK_AV')"> <i class="fe-arrow-left mr-2"></i>Back </a>
        <a href="#" class="btn btn-primary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_ENTRY', 'COMPONENT_ESTIMATOR_BREAK_TOD'); "> Continue <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_TOD">
        <h1>🌤 When do you plan this event to happen?</h1>
        <p class="lead">Some of our rates change depending on time of day and week.</p>
        <div class="pb-5"></div>
        <div class="row d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.times.is_weekend = true">
                    <a href="#" class="nav-link active" id="pills-home1" data-toggle="pill" role="tab" aria-controls="home1" aria-selected="true">
                        🥂 &nbsp Weekend
                    </a>
                </li>
                <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.times.is_weekend = false">
                    <a href="#" class="nav-link" id="pills-profile1" data-toggle="pill" role="tab" aria-controls="profile1" aria-selected="false">
                        💼 &nbsp Weekday
                    </a>
                </li>
            </ul>
        </div>
        <div class="row d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.times.is_evening = true">
                    <a href="#" class="nav-link active" id="pills-home1" data-toggle="pill" role="tab" aria-controls="home1" aria-selected="true">
                        🌙 &nbsp After 5:30 PM
                    </a>
                </li>
                <li class="nav-item" onclick="EventEstimationWizard.user_configurations.inputs.times.is_evening = false">
                    <a href="#" class="nav-link" id="pills-profile1" data-toggle="pill" role="tab" aria-controls="profile1" aria-selected="false">
                        ☀️ &nbsp Before 5:30 PM
                    </a>
                </li>
            </ul>
        </div>
        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-secondary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_TOD', 'COMPONENT_ESTIMATOR_BREAK_ENTRY')"> <i class="fe-arrow-left mr-2"></i>Back </a>
        <a href="#" class="btn btn-primary btn-shadow mt-2 " role="button"  onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_TOD', 'COMPONENT_ESTIMATOR_BREAK_VENUE'); EventEstimationWizard.find_venues()"> Find Venues <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_VENUE">
        <h1>✨ And now for the Venue!</h1>
        <p class="lead">Here are your venue options based on what you have told us so far</p>
        <div class="pb-5"></div>
        <div class="accordion" id="accordionExample">

            <!-- Card -->
            <div class="card border-0 box-shadow card-active" venue_category="vip">
                <div class="card-header" id="headingOne">
                    <h3 class="accordion-heading">
                        <a href="#collapseOne" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                            VIP Seating and Tables <h6 style="font-weight: normal">Perfect for small get togethers</h6>
                            <span class="accordion-indicator"></span>
                        </a>
                    </h3>
                </div>
                <div class="collapse " id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div venue="table" class="card border-0 box-shadow mr-3 w-40 mt-2 mb-2">
                                <div class="card-img-top bg-secondary text-center py-5 px-grid-gutter">
                                    <h3 class="text-body mb-0">Table</h3>
                                </div>
                                <div class="card-body px-grid-gutter py-grid-gutter">
                                    <div class="d-flex align-items-end py-2 px-4 mb-4">
                                        <span class="h2 font-weight-normal text-muted mb-1 mr-2">$</span>
                                        <span class="cs-price display-2 font-weight-normal text-primary px-1 mr-2">15</span>
                                        <span class="h3 font-size-lg font-weight-medium text-muted mb-2">per<br>Table/Hr</span>
                                    </div>
                                    <ul class="list-unstyled py-2 mb-4">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Up to 2 Tables</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>8 People per Table</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Invite Manager</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Skip the Line</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Guaranteed Spot</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Reduced Entry Fee</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Projector and Sound</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Private Area</span>
                                        </li>
                                    </ul>
                                    <div class="text-center mb-2">
                                        <a class="btn btn-primary COMPONENT_ESTIMATOR_VENUE_SELECT" href="#">Select this Option</a>
                                        <br>
                                        <a class="btn btn-outline-primary COMPONENT_ESTIMATOR_VENUE_INQUIRE mt-3" href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div venue="lookout" class="card border-0 box-shadow mr-3  w-40 mt-2 mb-2">
                                <div class="card-img-top bg-secondary text-center py-5 px-grid-gutter">
                                    <h3 class="text-body mb-0">The Lookout</h3>
                                </div>
                                <div class="card-body px-grid-gutter py-grid-gutter">
                                    <div class="d-flex align-items-end py-2 px-4 mb-4">
                                        <span class="h2 font-weight-normal text-muted mb-1 mr-2">$</span>
                                        <span class="cs-price display-2 font-weight-normal text-primary px-1 mr-2">30</span>
                                        <span class="h3 font-size-lg font-weight-medium text-muted mb-2">per<br>Hour</span>
                                    </div>
                                    <ul class="list-unstyled py-2 mb-4">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Up to 3 additional <br> Tables @ $12/hr</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Seats 8 People</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Invite Manager</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Skip the Line</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Guaranteed Spot</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Reduced Entry Fee</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Projector and Sound</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Private Area</span>
                                        </li>
                                    </ul>
                                    <div class="text-center mb-2">
                                        <a class="btn btn-primary COMPONENT_ESTIMATOR_VENUE_SELECT" href="#">Select this Option</a>
                                        <br>
                                        <a class="btn btn-outline-primary COMPONENT_ESTIMATOR_VENUE_INQUIRE mt-3" href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div venue="stage" class="card border-0 box-shadow w-40 mt-2 mb-2">
                                <div class="card-img-top bg-secondary text-center py-5 px-grid-gutter">
                                    <h3 class="text-body mb-0">The Stage</h3>
                                </div>
                                <div class="card-body px-grid-gutter py-grid-gutter">
                                    <div class="d-flex align-items-end py-2 px-4 mb-4">
                                        <span class="h2 font-weight-normal text-muted mb-1 mr-2">$</span>
                                        <span class="cs-price display-2 font-weight-normal text-primary px-1 mr-2">40</span>
                                        <span class="h3 font-size-lg font-weight-medium text-muted mb-2">per<br>Hour</span>
                                    </div>
                                    <ul class="list-unstyled py-2 mb-4">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Up to 3 additional <br> Tables @ $12/hr</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Seats 8 People</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Invite Manager</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Skip the Line</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Guaranteed Spot</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Reduced Entry Fee</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Projector and Sound</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-x font-size-xl text-muted mr-2"></i>
                                            <span class="text-muted">Private Area</span>
                                        </li>
                                    </ul>
                                    <div class="text-center mb-2">
                                        <a class="btn btn-primary COMPONENT_ESTIMATOR_VENUE_SELECT" href="#">Select this Option</a>
                                        <br>
                                        <a class="btn btn-outline-primary COMPONENT_ESTIMATOR_VENUE_INQUIRE mt-3" href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="card border-0 box-shadow" venue_category="bookout">
                <div class="card-header" id="headingTwo">
                    <h3 class="accordion-heading">
                        <a href="#collapseTwo" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseTwo">
                            Private Sections  <h6 style="font-weight: normal">Great for larger parties</h6>
                            <span class="accordion-indicator"></span>
                        </a>
                    </h3>
                </div>
                <div class="collapse " id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div venue="lawn" class="card border-0 box-shadow mr-3   mt-2 mb-2">
                                <div class="card-img-top bg-secondary text-center py-5 px-grid-gutter">
                                    <h3 class="text-body mb-0">The Lawn</h3>
                                    <small>Great for parties with kids</small>
                                </div>
                                <div class="card-body px-grid-gutter py-grid-gutter">
                                    <div class="d-flex align-items-end py-2 px-4 mb-4">
                                        <span class="h2 font-weight-normal text-muted mb-1 mr-2">$</span>
                                        <span class="cs-price display-2 font-weight-normal text-primary px-1 mr-2">200</span>
                                        <span class="h3 font-size-lg font-weight-medium text-muted mb-2">per<br>Hour</span>
                                    </div>
                                    <ul class="list-unstyled py-2 mb-4">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Up to 3 additional <br> Tables @ $12/hr</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Invite Manager</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Skip the Line</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Guaranteed Spot</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Reduced Entry Fee</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Projector and Sound</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Private Area</span>
                                        </li>
                                    </ul>
                                    <div class="text-center mb-2">
                                        <a class="btn btn-primary COMPONENT_ESTIMATOR_VENUE_SELECT" href="#">Select this Option</a>
                                        <br>
                                        <a class="btn btn-outline-primary COMPONENT_ESTIMATOR_VENUE_INQUIRE mt-3" href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div venue="upstairs" class="card border-0 box-shadow mr-3  mt-2 mb-2">
                                <div class="card-img-top bg-secondary text-center py-5 px-grid-gutter">
                                    <h3 class="text-body mb-0">Entire Upstairs</h3>
                                    <small>With an amazing view downtown</small>
                                </div>
                                <div class="card-body px-grid-gutter py-grid-gutter">
                                    <div class="d-flex align-items-end py-2 px-4 mb-4">
                                        <span class="h2 font-weight-normal text-muted mb-1 mr-2">$</span>
                                        <span class="cs-price display-2 font-weight-normal text-primary px-1 mr-2">350</span>
                                        <span class="h3 font-size-lg font-weight-medium text-muted mb-2">per<br>Hour</span>
                                    </div>
                                    <ul class="list-unstyled py-2 mb-4">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Up to 3 additional <br> Tables @ $12/hr</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Invite Manager</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Skip the Line</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Guaranteed Spot</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Reduced Entry Fee</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Projector and Sound</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Private Area</span>
                                        </li>
                                    </ul>
                                    <div class="text-center mb-2">
                                        <a class="btn btn-primary COMPONENT_ESTIMATOR_VENUE_SELECT" href="#">Select this Option</a>
                                        <br>
                                        <a class="btn btn-outline-primary COMPONENT_ESTIMATOR_VENUE_INQUIRE mt-3" href="#">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <div venue="everything" class="card border-0 box-shadow  mt-2 mb-2">
                                <div class="card-img-top bg-secondary text-center py-5 px-grid-gutter">
                                    <h3 class="text-body mb-0">The Whole Place</h3>
                                    <small>Only Available on Mondays and Sunday Nights</small>
                                </div>
                                <div class="card-body px-grid-gutter py-grid-gutter">
                                    <div class="d-flex align-items-end py-2 px-4 mb-4">
                                        <span class="h2 font-weight-normal text-muted mb-1 mr-2">$</span>
                                        <span class="cs-price display-2 font-weight-normal text-primary px-1 mr-2">1000</span>
                                        <span class="h3 font-size-lg font-weight-medium text-muted mb-2">per<br>Hour</span>
                                    </div>
                                    <ul class="list-unstyled py-2 mb-4">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>The entire venue to yourself</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Invite Manager</span>
                                        </li>

                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Skip the Line</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span>Guaranteed Spot</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Reduced Entry Fee</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Both Projectors with Sound<br> and Entire Sound System (included)</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="fe-check font-size-xl text-primary mr-2"></i>
                                            <span class="">Private Area</span>
                                        </li>
                                    </ul>
                                    <div class="text-center mb-2">
                                        <a class="btn btn-primary COMPONENT_ESTIMATOR_VENUE_SELECT" href="#">Select this Option</a>
                                        <br>
                                        <a class="btn btn-outline-primary COMPONENT_ESTIMATOR_VENUE_INQUIRE mt-3" href="#">Learn More</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="pb-3"></div>
        <hr class="my-4">
        <a href="#" class="btn btn-secondary btn-shadow mt-2" role="button" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_VENUE', 'COMPONENT_ESTIMATOR_BREAK_TOD')"> <i class="fe-arrow-left mr-2"></i>Back </a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_ERROR_NO_VENUE">
        <h1>😔 We couldn't find any Venues that fit your specifications</h1>
        <p class="lead" >This can sometimes happen, but if you want to try again you can! Or you can call us</p>
        <hr class="my-4">
        <p class="pb-3" id="COMPONENT_ESTIMATOR_NOVENUEFOUND_FEEDBACK">Something unexpected happened. Please press the 'I would rather talk to someone' button to talk to a representative.</p>
        <a href="#" class="btn btn-primary btn-shadow mt-2" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_ERROR_NO_VENUE', 'COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT')" role="button"> Lets Try Again <i class="fe-arrow-right ml-2"></i></a>

        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I would rather talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_COST_BREAKDOWN">
        <h1>🥰 Good Choice! Here's your price breakdown</h1>
        <p class="lead" >Please keep in mind that this is just an estimate. If you have any questions, please do not hesitate to call</p>
        <hr class="my-4">
        <div class="cs-widget">
            <h3 class="cs-widget-title pb-1">Your Estimate</h3>

            <!-- Item -->
            <div id="COMPONENT_ESTIMATOR_REPORT_BREAKDOWN">

            </div>



            <!-- Totals -->
            <hr class="mb-4"/>
            <div class="d-flex justify-content-between mb-4">
                <span>Subtotal:</span>
                <span class="h4 mb-0" id="COMPONENT_ESTIMATOR_REPORT_SUBTOTAL">$--.--</span>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span>Estimated Taxes:</span>
                <span class="h4 mb-0" id="COMPONENT_ESTIMATOR_REPORT_TAXES">$--.--</span>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span class="h5 mb-0">Total:</span>
                <span class="h2 mb-0" id="COMPONENT_ESTIMATOR_REPORT_TOTAL">$--.--</span>
            </div>
        </div>
        <a href="#" class="btn btn-primary btn-shadow mt-2" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_COST_BREAKDOWN', 'COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT')" role="button"> Book This <i class="fe-arrow-right ml-2"></i></a>
        <a href="#" class="btn btn-secondary btn-shadow mt-2" onclick="EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_COST_BREAKDOWN', 'COMPONENT_ESTIMATOR_BREAK_GUESTCOUNT')" role="button"> Try Again <i class="fe-refresh-cw ml-2"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I want to talk to someone</a>
    </div>
    <div class="jumbotron d-none" id="COMPONENT_ESTIMATOR_BREAK_SPINNER">
        <h1>🤓 One Moment, Please! :)</h1>
        <p class="lead" >We're figuring out your estimate. Shouldn't take long!</p>
        <hr class="my-4">
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        </div>
        <br><br>
        <a href="#" class="btn btn-outline-secondary btn-shadow mt-2" role="button" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal">I want to talk to someone</a>
    </div>
    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#COMPONENT_ESTIMATORcontactUsModal2">
        Vertically centered modal
    </button>


</main>
<!-- Back to top button--><a class="btn-scroll-top show" href="#top" data-scroll=""><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon fe-arrow-up">   </i></a>
<!-- Vendor scrits: js libraries and plugins-->
<script src="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/jquery/dist/jquery.slim.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/parallax-js/dist/parallax.min.js"></script>
<!-- Main theme script-->
<script src="https://demo.createx.studio/around/js/theme.min.js"></script>

<script>
    class EventEstimationWizard {
    }

    // User input logging
    EventEstimationWizard.user_configurations = {
        inputs: {
            invited_guests: null,
            event_length: null,
            guest_payable_entry_fee: true,
            vendor_cards:{
                guest_amount: null,
                guest_payable: false
            },
            projector: true,
            venue: null,
            times: {
                is_evening: true,
                is_weekend: true
            }
        },
        result: {
            costs: []
        }
    };
    // Pre-Config Inputs
    EventEstimationWizard.preload = {capacity_preferences: {
            capacity_limit: false,
            capacity_limit_multiplier: .5,
            legal_capacity: 460,
        }};
    // Config Computations
    EventEstimationWizard.inload = {
        compute: {
            capacity: {
                maximum: (EventEstimationWizard.preload.capacity_preferences.legal_capacity * ((EventEstimationWizard.preload.capacity_preferences.capacity_limit) ? EventEstimationWizard.preload.capacity_preferences.capacity_limit_multiplier : 1))
            }
        }
    };
    // Actual Completed Config File
    EventEstimationWizard.config = {
        tables: {
            standard_rate: 15,
            capacity: 8
        },
        taxes: {
            multiplier: .02
        },
        fees: [
             {
                 enabled: true,
                 one_time: 15,
                 per_hour: 10,
                 per_guest: 2,
                 title: "Administration Fee",
                 subtitle: "Getting everything set up and sending invites"
            }
        ],
        vendor: {
            minimum_amount: 5
        }
        ,
        time: {
            maximum_time: 12
        }
        ,
        capacities: {
            maximum: EventEstimationWizard.inload.compute.capacity.maximum,
            minimum: 5
        }
        ,
        modifiers: {
            date: {
                weekend: 1.3,
                weekday: 1
            },
            time: {
                daytime: 1,
                evening: 1.2
            },
            keep_rounded: true
        },
        venues: {
            vip: {
                table: {
                    capacity: 0,
                    cost: {
                        rate: 0,
                        display_rate: 15,
                        entry_fee: 3,
                        guest_payable: true,
                        vendors: {
                            require_upfront: false,
                            guest_payable: true,
                            minimum: 0
                        }
                    },
                    AV: {
                        has_projector: false,
                        projector_count: 0,
                        projector_charge: 0
                    },
                    additional_tables: {
                        available: true,
                        rate: 15,
                        maximum_booking: 2
                    }
                },
                lookout: {
                    capacity: 8,
                    cost: {
                        rate: 40,
                        entry_fee: 3,
                        guest_payable: true,
                        vendors: {
                            require_upfront: false,
                            guest_payable: true,
                            minimum: 0
                        }
                    },
                    AV: {
                        has_projector: false,
                        projector_count: 0,
                        projector_charge: 0
                    },
                    additional_tables: {
                        available: true,
                        rate: 12,
                        maximum_booking: 3
                    }
                },
                stage: {
                    capacity: 8,
                    cost: {
                        rate: 30,
                        entry_fee: 3,
                        guest_payable: true,
                        vendors: {
                            require_upfront: false,
                            guest_payable: true,
                            minimum: 0
                        }
                    },
                    AV: {
                        has_projector: true,
                        projector_count: 1,
                        projector_charge: 40
                    },
                    additional_tables: {
                        available: true,
                        rate: 12,
                        maximum_booking: 3
                    }
                }
            },
            bookout: {
                lawn: {
                    capacity: 32,
                    cost: {
                        rate: 250,
                        entry_fee: 3,
                        guest_payable: false,
                        vendors: {
                            require_upfront: true,
                            guest_payable: true,
                            minimum: 10
                        }
                    },
                    AV: {
                        has_projector: true,
                        projector_count: 1,
                        projector_charge: 40
                    },
                    additional_tables: {
                        available: true,
                        rate: 12,
                        maximum_booking: 2
                    }
                },
                upstairs: {
                    capacity: 75,
                    cost: {
                        rate: 350,
                        entry_fee: 3,
                        guest_payable: false,
                        vendors: {
                            require_upfront: true,
                            guest_payable: false,
                            minimum: 15
                        }
                    },
                    AV: {
                        has_projector: true,
                        projector_count: 1,
                        projector_charge: 60
                    },
                    additional_tables: {
                        available: true,
                        rate: 12,
                        maximum_booking: 3
                    }
                },
                everything: {
                    capacity: EventEstimationWizard.inload.compute.capacity.maximum,
                    cost: {
                        rate: 1000,
                        entry_fee: 3,
                        guest_payable: false,
                        vendors: {
                            require_upfront: true,
                            guest_payable: false,
                            minimum: 15
                        },
                        fees: [
                            {
                                enabled: true,
                                one_time: 35,
                                per_hour: 0,
                                per_guest: 1.5,
                                title: "Cleaning Fee",
                                subtitle: "Due to COVID, we are increasing our cleaning procedures."
                            }
                        ]
                    },
                    AV: {
                        has_projector: true,
                        projector_count: 2,
                        projector_charge: 0
                    },
                    additional_tables: {
                        available: false,
                        rate: 0,
                        maximum_booking: 0
                    }
                }
            }
        }
    };

    // Post Serialization
    EventEstimationWizard.venues_serialized = [];
    EventEstimationWizard.config.feedback = {
        vendor_cards_guest_payable: {
            large_party: "Since your party is large, our vendors require a 'deposit' of a commitment to eating and drinking in the form of a prepaid amount upfront, and not paid by the guests. 🍷"
        },
        guest_payable_entry_fee: {
            large_party: "An issue that comes with the territory of your party being large, is that entry fees need to be paid upfront for us to recoop costs. 💸"
        },
        vendor_cards_too_low:{
            standard: "Some large parties require vendors to stay open longer, meaning that they also need to make more money. Try increasing your funding per person! 😊️"
        }
    }

    EventEstimationWizard.serialize_structure = function(){
        this.venues_serialized = [];
        let categories = Object.entries(this.config.venues);
        let scope = this;
        categories.forEach(function (category) {
            let category_name = category[0];
            Object.entries(category[1]).forEach(function (venue) {
                let max_capacity = venue[1].capacity + ((venue[1].additional_tables.available)? (venue[1].additional_tables.maximum_booking * scope.config.tables.capacity)  : 0);
                scope.venues_serialized.push([category_name, venue[0], {category: category_name, name: venue[0], max_calculated_capacity: max_capacity, options: venue[1]}])
            })
        })
    };
    EventEstimationWizard.find_venues = function(){
        let venue_list = [];
        this.serialize_structure();
        //Sort by AV
        this.venues_serialized.forEach(function (venue) {
            if (EventEstimationWizard.user_configurations.inputs.projector){
                if (venue[2].options.AV.has_projector){
                    venue_list.push(venue);
                }
            }else {
                venue_list.push(venue)
            }
        });
        let venue_list_copy = venue_list;
        venue_list = [];
        venue_list_copy.forEach(function (venue) {
            if (!EventEstimationWizard.user_configurations.inputs.guest_payable_entry_fee){
                if (venue[2].options.cost.guest_payable){
                    venue_list.push(venue);
                }
            }else {
                venue_list.push(venue);
            }
        });
        venue_list_copy = venue_list;
        venue_list = [];
        venue_list_copy.forEach(function (venue) {
            if (EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_payable){
                if (venue[2].options.cost.vendors.guest_payable){
                    venue_list.push(venue);
                }
            }else {
                venue_list.push(venue);
            }
        });
        venue_list_copy = venue_list;
        venue_list = [];
        venue_list_copy.forEach(function (venue) {
            if (EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount >= venue[2].options.cost.vendors.minimum){
                venue_list.push(venue);
            }else {
                if (EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_payable){
                    venue_list.push(venue);
                }
            }
        });
        venue_list_copy = venue_list;
        venue_list = [];
        venue_list_copy.forEach(function (venue) {
            console.log("" + EventEstimationWizard.user_configurations.inputs.invited_guests + " - " + venue[2].max_calculated_capacity);
            if (EventEstimationWizard.user_configurations.inputs.invited_guests <= venue[2].max_calculated_capacity){
                venue_list.push(venue);
            }
        });
        console.log(venue_list);
        EventEstimationWizard.DOM_insert_values();
        this.venues_serialized.forEach(function (venue) {
            $(`div[venue_category='${venue[0]}']`).addClass('d-none');
            EventEstimationWizard.get_chart_element(venue[0], venue[1]).addClass('d-none');
        })
        if (venue_list.length !== 0) {

            venue_list.forEach(function (venue) {
                $(`div[venue_category='${venue[0]}']`).removeClass('d-none');
                EventEstimationWizard.get_chart_element(venue[0], venue[1]).removeClass('d-none');
            })
        }else {
            let feedback = "Some Suggestions: ";
            let use_conj = false;
            let conjunctions = ["Additionally, ", "Furthermore, ", "Beyond this, "];
            if (EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_payable){
                if (EventEstimationWizard.user_configurations.inputs.invited_guests > EventEstimationWizard.config.capacities.maximum/2) {
                    feedback += EventEstimationWizard.config.feedback.vendor_cards_guest_payable.large_party;
                    use_conj = true;
                }
            }
            if (!EventEstimationWizard.user_configurations.inputs.guest_payable_entry_fee){
                if (EventEstimationWizard.user_configurations.inputs.invited_guests > EventEstimationWizard.config.capacities.maximum/2) {
                    if (use_conj){
                        feedback += (" " + conjunctions.pop() + EventEstimationWizard.config.feedback.guest_payable_entry_fee.large_party.trim().replace(/^\w/, (c) => c.toLowerCase()))
                    }else {
                        feedback += EventEstimationWizard.config.feedback.guest_payable_entry_fee.large_party;
                    }
                    use_conj = true;
                }
            }
            if (!EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount < 15){
                    if (use_conj){
                        feedback += (" " + conjunctions.pop() + EventEstimationWizard.config.feedback.vendor_cards_too_low.standard.trim().replace(/^\w/, (c) => c.toLowerCase()))
                    }else {
                        feedback += EventEstimationWizard.config.feedback.vendor_cards_too_low.standard;
                    }
                    use_conj = true;
            }
            if (!use_conj){
                feedback = "If you don't mind, give us a call! You can use the 'I would rather talk to someone'";
            }
            $("#COMPONENT_ESTIMATOR_NOVENUEFOUND_FEEDBACK")[0].innerHTML = feedback;
            EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_VENUE', 'COMPONENT_ESTIMATOR_BREAK_ERROR_NO_VENUE')
        }
    }

    EventEstimationWizard.dev = null;
    EventEstimationWizard.make_venue_selection = function(DOM_Obj){
        EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_VENUE', 'COMPONENT_ESTIMATOR_BREAK_SPINNER');
        EventEstimationWizard.user_configurations.inputs.venue = {
            name: $(DOM_Obj.target).closest("div[venue]").attr("venue"),
            category: $(DOM_Obj.target).closest("div[venue_category]").attr("venue_category")
        }
        EventEstimationWizard.generatePricingBreakdown();
        EventEstimationWizard.generatePricingHTML();
        setTimeout(function () {
            EventEstimationWizard.helpers.switchScreen('COMPONENT_ESTIMATOR_BREAK_SPINNER', 'COMPONENT_ESTIMATOR_BREAK_COST_BREAKDOWN');
        }, 1200)

    // .closest("div[venue]"));
    }
    EventEstimationWizard.get_chart_element = function(category, name){
        return $(`div[venue_category='${category}']`).find(` div[venue='${name}']`);
    };
    EventEstimationWizard.DOM_insert_values = function(){
        this.serialize_structure();
        EventEstimationWizard.venues_serialized.forEach(function (venue) {
            let price = EventEstimationWizard.getVenuePrice((venue[2].options.cost.display_rate == null) ? venue[2].options.cost.rate : venue[2].options.cost.display_rate);
            $(`div[venue_category='${venue[0]}']`).find(` div[venue='${venue[1]}']`).find(".cs-price")[0].innerHTML = EventEstimationWizard.helpers.formatNumber((EventEstimationWizard.config.modifiers.keep_rounded === true) ? Math.round(price) : price)
        })
    };
    EventEstimationWizard.getVenuePrice = function(standard_price){
        return (
            standard_price
            * ((EventEstimationWizard.user_configurations.inputs.times.is_weekend) ? EventEstimationWizard.config.modifiers.date.weekend : EventEstimationWizard.config.modifiers.date.weekday)
            * ((EventEstimationWizard.user_configurations.inputs.times.is_evening) ? EventEstimationWizard.config.modifiers.time.evening : EventEstimationWizard.config.modifiers.time.daytime)
        );
    };
    EventEstimationWizard.generatePricingBreakdown = function(){
        let breakdown = {
            items: [],
            total: 0
        }
        let venue_details = null;
        EventEstimationWizard.serialize_structure();
        EventEstimationWizard.venues_serialized.forEach(function (venue) {
            if (venue[0] == EventEstimationWizard.user_configurations.inputs.venue.category
                && venue[1] == EventEstimationWizard.user_configurations.inputs.venue.name ){
                venue_details = venue[2]
            }
        })
        let left_to_tables = EventEstimationWizard.user_configurations.inputs.invited_guests - venue_details.options.capacity;
        let tables_required = Math.ceil(left_to_tables/EventEstimationWizard.config.tables.capacity);
        let table_rate = ((venue_details.options.additional_tables.rate == null) ? EventEstimationWizard.config.tables.standard_rate : venue_details.options.additional_tables.rate);
        breakdown.items.push({
            title: "Event Fee",
            subtitle: "This is the cost for booking the event and for the use of space at a rate of  $" + EventEstimationWizard.getVenuePrice(venue_details.options.cost.rate) + "/hr for " + EventEstimationWizard.user_configurations.inputs.event_length + (EventEstimationWizard.user_configurations.inputs.event_length === 1 ? " Hour" : " Hours"),
            cost: Math.ceil(EventEstimationWizard.getVenuePrice(venue_details.options.cost.rate) * EventEstimationWizard.user_configurations.inputs.event_length)
        })
        if (left_to_tables > 0){
            breakdown.items.push({
                title: "Additional Tables",
                subtitle: "In order to cover your party, we need " + tables_required + " additional tables at $" + table_rate + "/hr for "+ EventEstimationWizard.user_configurations.inputs.event_length + (EventEstimationWizard.user_configurations.inputs.event_length === 1 ? " Hour" : " Hours") +".",
                cost: Math.ceil(table_rate*tables_required*EventEstimationWizard.user_configurations.inputs.event_length)
            })
        }
        if (EventEstimationWizard.user_configurations.inputs.projector){
            breakdown.items.push({
                title: "Projector Use",
                subtitle: "A charge for setting up the AV system",
                cost: Math.ceil(venue_details.options.AV.projector_charge)
            })
        }
        if (EventEstimationWizard.user_configurations.inputs.guest_payable_entry_fee){
            breakdown.items.push({
                title: "Entry Fee",
                subtitle: EventEstimationWizard.user_configurations.inputs.invited_guests + " Guests @ $" + venue_details.options.cost.entry_fee + " per person",
                cost: Math.ceil(EventEstimationWizard.user_configurations.inputs.invited_guests * venue_details.options.cost.entry_fee)
            })
        }
        if (!EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_payable){
            breakdown.items.push({
                title: "Food and Drink Charge",
                subtitle: EventEstimationWizard.user_configurations.inputs.invited_guests + " Guests @ $" + EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount + " per person",
                cost: Math.ceil(EventEstimationWizard.user_configurations.inputs.invited_guests * EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount)
            })
        }
        EventEstimationWizard.config.fees.forEach(function (fee) {
            if (fee.enabled){
                breakdown.items.push({
                    title: fee.title,
                    subtitle: fee.subtitle,
                    cost: Math.ceil(fee.one_time + (EventEstimationWizard.user_configurations.inputs.event_length * fee.per_hour) + (EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount * fee.per_guest))
                })
            }
        })
        if (venue_details.options.cost.fees != null) {
            venue_details.options.cost.fees.forEach(function (fee) {
                if (fee.enabled) {
                    breakdown.items.push({
                        title: fee.title,
                        subtitle: fee.subtitle,
                        cost: Math.ceil(fee.one_time + (EventEstimationWizard.user_configurations.inputs.event_length * fee.per_hour) + (EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount * fee.per_guest))
                    })
                }
            })
        }
        breakdown.items.forEach(function (item) {
            breakdown.total += item.cost
        })
        breakdown.items.push({
            title: "Tiig Fee",
            subtitle: "The fee that Tiig charges for the event",
            cost: Math.ceil(20 + breakdown.total*.05)
        })
        EventEstimationWizard.user_configurations.result.costs = breakdown;
    }
    EventEstimationWizard.generatePricingHTML = function(){
        let HTML = "";

        EventEstimationWizard.user_configurations.result.costs.items.forEach(function (item) {
            let formatted_price = item.cost;
            if (formatted_price == 0){
                formatted_price = "Included"
            }else {
                formatted_price = "$" + EventEstimationWizard.helpers.formatNumber(item.cost);
            }

            HTML += `
<div class="media align-items-center mb-4">
                <div class="media-body pl-2 ml-1" >


            <div class="d-flex align-items-center justify-content-between">
                        <div class="mr-3">
                            <h4 class="nav-heading font-size-lg mb-1">
                                <a class="font-weight-medium" href="#">${item.title}</a>
                            </h4>
                            <div class="d-flex align-items-center font-size-sm">
                                <span class="mr-2">${item.subtitle}</span>
                            </div>
                        </div>
                        <div class="pl-3 border-left">
                            <a class="d-block text-info text-decoration-none font-size-xl" href="#" data-toggle="tooltip" title="Remove">
                                <span class="mr-2">${formatted_price}</span>
                            </a>
                        </div>
                    </div>
   </div>
            </div>
            `
        });
        $("#COMPONENT_ESTIMATOR_REPORT_BREAKDOWN")[0].innerHTML = HTML
        $("#COMPONENT_ESTIMATOR_REPORT_SUBTOTAL")[0].innerHTML = "$" + EventEstimationWizard.helpers.formatNumber(EventEstimationWizard.user_configurations.result.costs.total);
        let taxes = EventEstimationWizard.user_configurations.result.costs.total * EventEstimationWizard.config.taxes.multiplier;
        $("#COMPONENT_ESTIMATOR_REPORT_TAXES")[0].innerHTML = "$" + EventEstimationWizard.helpers.formatNumber(taxes.toFixed(2));
        $("#COMPONENT_ESTIMATOR_REPORT_TOTAL")[0].innerHTML = "$" + EventEstimationWizard.helpers.formatNumber((EventEstimationWizard.user_configurations.result.costs.total+taxes).toFixed(2));


    }
    EventEstimationWizard.helpers = class{};
    EventEstimationWizard.helpers.setListeners = function(){
        $("#COMPONENT_ESTIMATOR_INPUT_GUESTS_INVITED").on('input', function () {
            let process_var = this.value.replace(/\D/g,'');
            let display_width
            if (process_var !== '') {
                process_var = parseInt(process_var);
                display_width = ("" + process_var).length;
            }else {
                display_width = 0;
            }
            if (display_width !== 0) {
                if (process_var > EventEstimationWizard.config.capacities.maximum) {
                    process_var = COMPONENT_ESTIMATOR_HELPER_GUESTS_PREVIOUS;
                    display_width = ("" + process_var).length;
                    if (EventEstimationWizard.preload.capacity_preferences.capacity_limit) {
                        $("#COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_CAPACITY").removeClass("d-none");
                        $("#COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_MESSAGE").addClass("d-none");
                    }

                }else {
                    if (EventEstimationWizard.preload.capacity_preferences.capacity_limit) {
                        $("#COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_CAPACITY").addClass("d-none");
                        $("#COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_MESSAGE").removeClass("d-none");
                    }
                }
                EventEstimationWizard.user_configurations.inputs.invited_guests = process_var;
                this.value = "" + process_var + ((process_var == 1) ? " Guest" : " Guests");
                COMPONENT_ESTIMATOR_HELPER_GUESTS_PREVIOUS = process_var;
                this.actual_value = process_var;
                setCaretPosition('COMPONENT_ESTIMATOR_INPUT_GUESTS_INVITED', display_width);
                if (process_var != 0) $("#COMPONENT_ESTIMATOR_BREAK_INTRO_BUTTON_CONTINUE").removeClass("disabled");
            }else {
                this.value = ""
                $("#COMPONENT_ESTIMATOR_BREAK_INTRO_BUTTON_CONTINUE").addClass("disabled");
            }
        })
        $("#COMPONENT_ESTIMATOR_INPUT_TIME_HOURS").on('input', function () {
            let process_var = this.value.replace(/\D/g,'');
            let display_width
            if (process_var !== '') {
                process_var = parseInt(process_var);
                display_width = ("" + process_var).length;
            }else {
                display_width = 0;
            }
            if (display_width !== 0) {
                if (process_var > EventEstimationWizard.config.time.maximum_time) {
                    process_var = COMPONENT_ESTIMATOR_HELPER_TIME_PREVIOUS;
                    display_width = ("" + process_var).length;
                }
                EventEstimationWizard.user_configurations.inputs.event_length = process_var;
                this.value = "" + process_var + ((process_var == 1) ? " Hour" : " Hours");
                COMPONENT_ESTIMATOR_HELPER_TIME_PREVIOUS = process_var;
                this.actual_value = process_var;
                setCaretPosition('COMPONENT_ESTIMATOR_INPUT_TIME_HOURS', display_width);
                if (process_var != 0) $("#COMPONENT_ESTIMATOR_BREAK_TIME_BUTTON_CONTINUE").removeClass("disabled");
            }else {
                this.value = ""
                $("#COMPONENT_ESTIMATOR_BREAK_TIME_BUTTON_CONTINUE").addClass("disabled");
            }
        })
        $("#COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_AMOUNT").on('input', function () {
            HELPER_COMPONENT_ESTIMATOR_VENDOR_CARD_TOGGLE(this);
        })
        $("#COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_MESSAGE_CAPACITY_FIGURE")[0].innerHTML = EventEstimationWizard.config.capacities.maximum;
        $("#COMPONENT_ESTIMATOR_BREAK_INTRO_WARNING_CAPACITY_FIGURE")[0].innerHTML = EventEstimationWizard.config.capacities.maximum;
        $("#COMPONENT_ESTIMATOR_BREAK_TIME_MESSAGE_HOURS_FIGURE")[0].innerHTML = EventEstimationWizard.config.time.maximum_time + " hours";
        $(".COMPONENT_ESTIMATOR_VENUE_SELECT").on("click", function (obj) {
            EventEstimationWizard.make_venue_selection(obj);
        })
    };
    EventEstimationWizard.helpers.switchScreen = function(start_id,end_id){
        $("#"+start_id).addClass('d-none');
        $("#"+end_id).removeClass('d-none');
    }
    EventEstimationWizard.helpers.formatNumber = function(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    let COMPONENT_ESTIMATOR_HELPER_GUESTS_PREVIOUS = "";
    let COMPONENT_ESTIMATOR_HELPER_TIME_PREVIOUS = "";
    let COMPONENT_ESTIMATOR_HELPER_VENDOR_PREVIOUS = "";
    function HELPER_COMPONENT_ESTIMATOR_VENDOR_CARD_TOGGLE(obj) {
        let process_var = obj.value.replace(/\D/g,'');
        let display_width;
        if (process_var !== '') {
            process_var = parseInt(process_var);
            display_width = ("" + process_var).length;
        }else {
            display_width = 0;
        }
        if (display_width !== 0) {
            // if (process_var < EventEstimationWizard.config.vendor.minimum_amount) {
            //     process_var = COMPONENT_ESTIMATOR_HELPER_VENDOR_PREVIOUS;
            //     display_width = ("" + process_var).length;
            // }
            obj.value = "$" + process_var;
            COMPONENT_ESTIMATOR_HELPER_VENDOR_PREVIOUS = process_var;
            obj.actual_value = process_var;
            EventEstimationWizard.user_configurations.inputs.vendor_cards.guest_amount = process_var;
            setCaretPosition('COMPONENT_ESTIMATOR_INPUT_VENDOR_CARD_AMOUNT', display_width+1);

            if (process_var >= EventEstimationWizard.config.vendor.minimum_amount){
                $("#COMPONENT_ESTIMATOR_VENDOR_CARD_BUTTON_CONTINUE").removeClass("disabled")
            }else {
                $("#COMPONENT_ESTIMATOR_VENDOR_CARD_BUTTON_CONTINUE").addClass("disabled")
            };
        }else {
            obj.value = ""
            $("#COMPONENT_ESTIMATOR_VENDOR_CARD_BUTTON_CONTINUE").addClass("disabled");
        }
    }
    function setCaretPosition(elemId, caretPos) {
        var elem = document.getElementById(elemId);

        if(elem != null) {
            if(elem.createTextRange) {
                var range = elem.createTextRange();
                range.move('character', caretPos);
                range.select();
            }
            else {
                if(elem.selectionStart) {
                    elem.focus();
                    elem.setSelectionRange(caretPos, caretPos);
                }
                else
                    elem.focus();
            }
        }
    }

    $(document).ready(function(){
        EventEstimationWizard.helpers.setListeners();
    });




</script>
</body>