<?php
ini_set("display_errors",1);
error_reporting(E_ERROR);
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web, API.security, API.venues, API.cards");
if (isset($_GET['auth'])) \Union\API\security\Auth::bounce_back();
\Union\API\web\UI\UIManager::import_header();
if (!isset($_GET['c'])) $card_exists = false;
else $card_exists = \Union\API\Cards\GiftCard::static_exists_contingency($_GET['c'], true);
$card = null;
if ($card_exists){
    $card = new \Union\API\Cards\GiftCard($_GET['c'], true);
}

?>
<style>
    .prevent_scrollbar::-webkit-scrollbar {
        width: 0px;
        background: transparent; /* make scrollbar transparent */
    }
    body{

        background: url("/src/media/images/backgrounds/mesh/mesh-01.jpg") rgba(255, 255, 255, 0.5) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    /*Image Preloader*/
    body::after{
        position:absolute; width:0; height:0; overflow:hidden; z-index:-1;
        content:url("/src/media/images/backgrounds/mesh/mesh-01.jpg") url('/src/media/images/backgrounds/mesh/mesh-02.jpg') url('/src/media/images/backgrounds/mesh/mesh-03.jpg');
    }
    #SECURING_ONBOARDING_SELECTION_BUTTON_PANEL_LOGIN_WITH {
        background: url('/src/media/images/backgrounds/mesh/mesh-02.jpg') rgba(255, 255, 255, 0.5) no-repeat center center;
        background-size: 120%;
        transition: all 1s cubic-bezier(.32,0,.09,.98);
        -moz-transition: all 1s cubic-bezier(.32,0,.09,.98);
        -ms-transition: all 1s cubic-bezier(.32,0,.09,.98);
        -webkit-transition: all 1s cubic-bezier(.32,0,.09,.98);
        -o-transition: all 1s cubic-bezier(.32,0,.09,.98);
        -webkit-box-shadow: 0px 0px 5px -13px rgba(102,96,148,1);
        -moz-box-shadow: 0px 0px 5px -13px rgba(102,96,148,1);
        box-shadow: 0px 0px 5px -13px rgba(102,96,148,1);
    }
    #SECURING_ONBOARDING_SELECTION_BUTTON_PANEL_LOGIN_WITH:hover{
        background-size: 160%;
        transform: scale(1.05) translateY(-10px);
        -webkit-box-shadow: 0px 10px 40px -13px rgba(102,96,148,1);
        -moz-box-shadow: 0px 10px 40px -13px rgba(102,96,148,1);
        box-shadow: 0px 10px 40px -13px rgba(102,96,148,1);
    }
    #SECURING_ONBOARDING_SELECTION_BUTTON_PANEL_LOGIN_WITH:active{
        background-size: 100%;
        transform: scale(.97) translateY(5px);
        -webkit-box-shadow: 0px 10px 36px -25px rgba(102,96,148,1);
        -moz-box-shadow: 0px 10px 36px -25px rgba(102,96,148,1);
        box-shadow: 0px 10px 36px -25px rgba(102,96,148,1);
    }
    #SECURING_ONBOARDING_SELECTION {
        background: url('/src/media/images/backgrounds/mesh/mesh-02.jpg') rgba(255, 255, 255, 0.5) no-repeat center center;
        background-size: cover;

    }
    #IMPORT_MODAL_ERROR_FATAL {
        background: url('/src/media/images/backgrounds/mesh/mesh-03.jpg') rgba(255, 255, 255, 0.5) no-repeat center center;
        background-size: cover;

    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sf-bootstrap-pincode-input@1.5.0/css/bootstrap-pincode-input.min.css">
<title>Gather - Your Gift Card</title>
<body style="margin: 0px;">
<div class="modal  fade" id="MODAL_LOADING_PAGE" tabindex="-1" role="dialog">
    <div class="container h-100" style="z-index: 1;">
        <div class="d-flex justify-content-center align-items-center " style="z-index: 1; height: 100vh;">
            <div class="spinner-border text-white animate__animated animate__fadeIn" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>
<div class="modal  fade" id="MODAL_ERROR_FATAL" tabindex="-1" role="dialog" style="overflow-x: hidden;">
    <div class="modal-dialog modal-dialog-centered border-0 " role="document" style="overflow-x: hidden;">
        <div class="modal-content border-danger border-3" style="overflow-x: hidden;">
            <div class="modal-header row d-flex bg-faded-danger">
<!--                <p class="modal-title text-center col-12 align-content-center mt-3"> <i class="fe-alert-circle h1 pb-0 mb-0 text-danger"></i> <br> </p>-->
                <div class="p-2 ">
                    <h2 class="text-center pb-4 text-danger mb-0 mt-2">😞 Oh, Shucks.</h2>
                    <p class="text-center font-size-md pt-1 text-danger opacity-80 pl-4 pr-4">It seems like something went wrong getting this card. This could be because the card is marked as in active, has been reported for fraud, or other reasons. Please contact us for support. <br> <span class="font-weight-semibold"><?php echo (isset($_GET['id']) ? 'If you do, tell them that the ID is "'. $_GET['id'] . "\"." : 'If you do, tell them that the ID was not given.');?></span> </p>
                </div>
                <button type="button" class="ml-4 mr-4 mb-3 mt-1 btn btn-translucent-danger btn-lg btn-block">Contact Support</button>

            </div>
        </div>

    </div>
</div>
<div class="modal  fade" id="MODAL_ERROR" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered border-0 " role="document" >
        <div class="modal-content border-danger border-3" style="overflow-x: hidden;">
            <div class="modal-header row d-flex bg-faded-danger">
                <p class="modal-title text-center col-12 align-content-center mt-3 mb-0 pb-0"> <i class="fe-alert-octagon h1 pb-0 mb-0 text-danger"></i> <br> </p>

                <!--                <p class="modal-title text-center col-12 align-content-center mt-3"> <i class="fe-alert-circle h1 pb-0 mb-0 text-danger"></i> <br> </p>-->
                <div class="p-2 col-12 ">
                    <h2 class="text-center pb-2 text-danger mb-0 mt-1" id="MODAL_ERROR_TITLE">😞 Oh, Shucks.</h2>
                    <p class="text-center font-size-md pt-1 text-danger opacity-80 pl-4 pr-4" id="MODAL_ERROR_SUBTITLE">It seems like something went wrong getting this card. This could be because the card is marked as in active, has been reported for fraud, or other reasons. Please contact us for support. <br> <span class="font-weight-semibold"><?php echo (isset($_GET['id']) ? 'If you do, tell them that the ID is "'. $_GET['id'] . "\"." : 'If you do, tell them that the ID was not given.');?></span> </p>
                </div>
                <button type="button" class="ml-4 mr-4 mb-3 mt-1 btn btn-danger btn-lg btn-block" id="MODAL_ERROR_BUTTON_PRIMARY" data-dismiss="modal" >Okay</button>
                <button type="button" class="ml-4 mr-4 mb-3 mt-1 btn btn-translucent-danger btn-lg btn-block" id="MODAL_ERROR_BUTTON_SECONDARY" data-dismiss="modal" >Okay</button>

            </div>
        </div>

    </div>
</div>
<div class="modal  fade" id="MODAL_SECURING_INPUT_PIN" style="overflow-x: hidden;" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered border-0 " role="document" style="overflow-x: hidden;">
        <div class="modal-content border-danger border-3 border-0" style="overflow-x: hidden;">
            <div class="modal-header row d-flex bg-darker border-0">
                <p class="modal-title text-center col-12 align-content-center mt-3"> <i class="fe-shield h1 pb-0 mb-0 text-white"></i> <br> </p>
                <div class="modal-title col-12 p-2 ">
                    <h3 class="text-center pb-0 text-white mb-0 mt-2" id="MODAL_SECURING_INPUT_PIN_TITLE">Please Enter your PIN</h3>
                    <p class="text-center font-size-sm pt-1 text-white opacity-65 pl-4 pr-4" id="MODAL_SECURING_INPUT_PIN_SUBTITLE">In order to ensure that nobody uses this card without authorization, we ask you for a method of authentication. </p>
                </div>
            </div>
            <div class="modal-body  p-lg-5 p-md-4  p-sm-1 p-3 pb-4 bg-dark border-0">

            <div class="" >
                <div class="row align-content-center">
                    <div class="input-group input-group-lg p-lg-3 p-md-2 p-sm-1 pl-4 pr-4 mt-0 pt-0">
                        <input class="form-control float-left form-control-pin-digit text-center bg-darker border-dark text-white" data-digitcontrol-start="true" data-digitcontrol-index="0" data-digitcontrol-end="false" type="tel" maxlength="1" style="width: 53px" placeholder="">

                        <label class="sr-only">Pin Digit 2</label>
                        <input class="form-control float-left form-control-pin-digit text-center bg-darker border-dark text-white" data-digitcontrol-start="true" data-digitcontrol-index="1" data-digitcontrol-end="false" type="tel" maxlength="1" style="width: 53px" placeholder="">
                        <label class="sr-only">Pin Digit 3</label>
                        <input class="form-control float-left form-control-pin-digit text-center bg-darker border-dark text-white" data-digitcontrol-start="true" data-digitcontrol-index="2" data-digitcontrol-end="false" type="tel" maxlength="1" style="width: 53px" placeholder="">
                        <label class="sr-only">Pin Digit 4</label>
                        <input class="form-control float-left form-control-pin-digit text-center bg-darker border-dark text-white" data-digitcontrol-start="true" data-digitcontrol-index="3" data-digitcontrol-end="false" type="tel" maxlength="1" style="width: 53px" placeholder="">
                    </div>
                    <button type="button" id="MODAL_SECURING_INPUT_PIN_CONTINUE" class="btn btn-lg btn-block btn-translucent-primary ml-4 mr-4 mt-3" disabled>Continue</button>
                    <button type="button" id="MODAL_SECURING_INPUT_PIN_CANCEL" class="btn btn-lg btn-block btn-translucent-secondary ml-4 mr-4 mt-3">Cancel</button>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="SECURING_ONBOARDING_SELECTION" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered border-0 " role="document">
        <div class="modal-content border-0 ">
            <div class="modal-header row d-flex bg-dark">
                <p class="modal-title text-center col-12 align-content-center mt-3"> <i class="fe-shield h1 pb-0 mb-0 text-white"></i> <br> </p>
                <div class="p-2 ">
                    <h3 class="text-center pb-0 text-white mb-0 mt-2">Securing your Experience.</h3>
                    <p class="text-center font-size-sm pt-1 text-white opacity-65 pl-4 pr-4">In order to ensure that nobody uses this card without authorization, we ask you for a method of authentication. </p>
                </div>
            </div>
            <div class="modal-body  p-lg-5 p-md-4  p-sm-1 p-3 pb-4 hide" id="SECURING_ONBOARDING_SELECTION_BUTTON_PANEL">

                <div class="pt-0 btn btn-primary bg-dark btn-raise border-0  mb-2"  onclick="Page.Auth.SSO.start()"id="SECURING_ONBOARDING_SELECTION_BUTTON_PANEL_LOGIN_WITH" style="width: 100%; height: 120px; ">
                    <div class="card-body d-block w-100 pl-2 p-0 pt-3">
                        <div class="float-left">
                            <i class="fe-user mt-3 pt-3 h2 text-white"></i>

                        </div>
                        <div class="float-left ml-4 pt-4">
                            <h6 class="m-0 p-0 text-white-50 font-size-xs text-left">Recommended</h6>
                            <h4 class="text-white animate__animated animate__fadeIn text-left "  style="animation-delay: 0.1s">Sign in with Slately </h4>

                        </div>
                        <i class="fe-chevron-right float-right mt-3 ml-0 pl-0 pt-4 pr-2"></i>
                    </div>
                </div>
                <div class="pt-0 btn btn-secondary btn-raise border-0 shadow-none  mt-3 mb-2" style="width: 100%; height: 85px;">
                    <div class="card-body d-block w-100 pl-2 p-0">
                        <div class="float-left">
                            <i class="fe-unlock mt-3 pt-3 h4 text-dark"></i>

                        </div>
                        <div class="float-left ml-4 pt-4">
                            <h6 class="m-0 p-0 text-muted font-size-xs text-left">Less Secure and Slower</h6>
                            <h5 class="text-white animate__animated animate__fadeIn text-left text-dark" onclick="Page.Auth.PIN.onboarding()" style="animation-delay: 0.1s">Continue with a Code</h5>

                        </div>
<!--                        <i class="fe-chevron-right float-right mt-3 ml-0 pl-0 pt-4 pr-2"></i>-->
                    </div>
                </div>
<!--                <input class="form-control form-control-lg" type="text" id="large-input" placeholder="Phone Number or Email">-->
<!--                <p class="font-size-sm mt-3 text-muted mb-0">By using this service, you agree to our <a target="_blank" href="/legal/policies/privacy">Privacy Policy</a> and our <a target="_blank" href="/legal/policies/terms">Terms of Service</a>.</p>-->
            </div>
<!--                <input class="form-control form-control-lg" type="text" id="large-input" placeholder="Phone Number or Email">-->
<!--                <p class="font-size-sm mt-3 text-muted mb-0">By using this service, you agree to our <a target="_blank" href="/legal/policies/privacy">Privacy Policy</a> and our <a target="_blank" href="/legal/policies/terms">Terms of Service</a>.</p>-->
            </div>

        </div>
    </div>

<div class="container h-100" id="loading" style="z-index: 1;">
    <div class="d-flex justify-content-center align-items-center " style="z-index: 1; height: 100vh;">
        <div class="spinner-border text-white animate__animated animate__fadeIn" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<div class="d-none" id="primary_display">
<div class=" container-fluid " style="z-index: -1;">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center "style="z-index: -1;">
            <div class="col-12">
                <div class="">
                    <br>
                    <h1 class="text-center text-white display-4 font-weight-bolder mb-0 pb-0 mt-7 mt-sm-4 animate__animated animate__fadeInDown">You got a Gift Card.</h1>
                    <p class="text-center pt-0 text-white-50 mt-0 mb-5 animate__animated animate__fadeInDown" style="animation-delay: 0.1s">Your one card for all your Gather needs. <a class="text-primary "></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="z-index: 1;">
    <div class="d-flex justify-content-center align-items-center " style="z-index: 1; height: 75vh;">
        <div>
        <div class="card  bg-faded-dark border-0 shadow-none justify-content-center animate__animated animate__fadeIn animate__fadeInUp" style="width: 400px; height: 230px; animation-delay: .2s">
            <div class="card-body d-block">
                <div>
                    <img src="/src/media/images/Gather_Logo_Small_white.png" class="float-left animate__animated animate__fadeInUp" style="animation-delay: 0.1s" width="30">
                    <h4 class="float-right text-white animate__animated animate__fadeInUp" style="animation-delay: 0.2s"><p class="font-size-sm float-left">$</p><? echo ($card_exists ? $card->get_transaction_account()->get_balance() : "--.--") ;?> </h4>
                </div>
                <br>
                <br>
                <br class="">

                <div class="row d-flex justify-content-center mt-2" style="clear:left">

                    <p class="card-text font-size-xl credit-card-font font-weight-bold text-white text-center float-left justify-content-center "><span class="animate__animated animate__fadeIn" style="animation-delay: .8s">••••</span> <span class="animate__animated animate__fadeIn" style="animation-delay: .9s">••••</span> <span class="animate__animated animate__fadeIn" style="animation-delay: 1s">••••</span> <span class="animate__animated animate__fadeIn" style="animation-delay: 1.1s">••••</span></p>

                </div>
                <div class="row d-flex justify-content-center mt-2" style="clear:left">



                </div>


            </div>

        </div>

        <div class="row d-flex justify-content-center ml-1 mt-3 mr-1">
                                    <button type="button" class="btn btn-light btn-block btn-lg  animate__animated animate__fadeInUp" style="animation-delay: 0.5s" onclick="Page.Card.redeem();"><i class="fe-dollar-sign mr-2"></i>Redeem Card</button>
                                </div>
            <div class="row d-flex justify-content-center mr-1 ml-1 mt-2 mb-4">
                <button type="button" class="btn btn-block btn-translucent-secondary btn-lg animate__animated animate__fadeInUp"  onclick="Page.Card.share();" style="animation-delay: 0.6s"><i class="fe-share mr-2"></i>Send to Someone</button>

            </div>

        </div>
    </div>
</div>
<div>
    <p class="text-white text-center mb-0 animate__animated animate__fadeInUp" style="animation-delay: 1.5s">Must be redeemed within <?php echo (($card_exists) ? (int)($card->security->validity->getActivationInterval()/86400) : "28") ?> days after card becomes active.</p>
    <p class="text-white-50 text-center font-size-sm mt-0  animate__animated animate__fadeInUp" style="animation-delay: 1.7s">Funds must be used within <?php echo (($card_exists) ? (int)(($card->security->validity->getExpirationDate()-$card->security->validity->getActivationStartDate())/2592000) : "3") ?>  months after redemption. </p>
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
<script src="https://cdn.jsdelivr.net/npm/sf-bootstrap-pincode-input@1.5.0/js/bootstrap-pincode-input.min.js"></script>

<script>

    setTimeout(function (){
        $("#loading").removeClass("animate__animated animate__fadeIn").addClass("animate__animated animate__fadeOut")
        setTimeout(function () {
            $("#loading").addClass("d-none");
            $("#primary_display").removeClass("d-none");
        },500)
    }, 1000)
    let Page = {
        init: function(){
            // Bind PIN form controllers
            $(".form-control-pin-digit").each(function(){
                Page.Input.Pin.bind(this,
                    $(this).attr("data-digitcontrol-start"),
                    $(this).attr("data-digitcontrol-end")
                )
            })
        },
        Auth: {
            SSO: {
                // Adds authentication param to URL to start auth
                start: function () {
                    let url = new URL(window.location);
                    let search_params = url.searchParams;
                    search_params.set('auth', '0');
                    url.search = search_params.toString();
                    window.location = url.toString();
                }
            },
            PIN : {
                onboarding: function (){
                    let valid = false;
                    let pin_to_be_set = null;
                    $("#SECURING_ONBOARDING_SELECTION").modal('hide');
                    Page.Input.Pin.onboarding()
                },
                unlock(){
                    $("#SECURING_ONBOARDING_SELECTION").modal('hide');
                    Page.Input.Pin.ask("Please enter your PIN Number", "If you do not remember your PIN, check your email for your recovery code.").then(

                    )
                },
                create: function (){

                },
                validate: function(pin){

                }
            }
        },
        Card: {
            attributes: undefined,
            load: function (id){

            },
            redeem: function(){
                if (!<?php echo (($card_exists && $card->security->validity->valid(false)) ? "true" : "false") ?>){
                    slately.UI.modals.error("We're not quite ready for you yet!", "We know you want to get started on using your gift card, but unfortunately your card doesn't become active until " + "<?php   echo ($card_exists ?  gmdate("M d, Y", $card->security->validity->getActivationStartDate()): "invalid")  ?>." )
                }
            },
            share: function(){
                if (!<?php echo (($card_exists && $card->security->validity->valid(false)) ? "true" : "false") ?>){
                    slately.UI.modals.error("We're not quite ready for you yet!", "We know you want to get started on using your gift card, but unfortunately your card doesn't become active until " + "<?php  echo ($card_exists ? gmdate("M d, Y", $card->security->validity->getActivationStartDate()): "invalid") ?>." )
                }
            }
        },
        Data : {
            FlowStates : {
                fail: {
                    // If there is a fatal error loading the card, dispaly dead end message
                    fatal: function () {
                        $('#MODAL_ERROR_FATAL').modal({backdrop: 'static', keyboard: false})
                    },
                    error: function (title, subtitle, primary_option='Okay', secondary_option=null){
                        $('#MODAL_ERROR_TITLE').html(title);
                        $('#MODAL_ERROR_SUBTITLE').html(subtitle);
                        $('#MODAL_ERROR_BUTTON_PRIMARY').html(primary_option);
                        if (secondary_option == null){
                            $('#MODAL_ERROR_BUTTON_SECONDARY').addClass('d-none');
                        }else{
                            $('#MODAL_ERROR_BUTTON_SECONDARY').html(secondary_option).removeClass('d-none');
                        }
                        $('#MODAL_ERROR').modal({backdrop: 'static', keyboard: false});
                        return new Promise(function (resolve, reject) {
                            $("#MODAL_ERROR_BUTTON_PRIMARY").click(function (){
                                $("#MODAL_ERROR").modal("hide");
                                resolve(true);
                            })
                            $("#MODAL_ERROR_BUTTON_SECONDARY").click(function (){
                                $("#MODAL_ERROR").modal("hide");
                                reject(false);
                            })
                        })
                    }
                }
            }
        },
        Input: {
            Pin: {
                helpers: {
                    promises: {
                        inputReturn: undefined
                    }
                },
                inputs: [],

                onboarding: function(){
                    return new Promise(function (resolve, reject) {
                        // while(true) {
                            Page.Input.Pin.ask(
                                "Please Create a PIN Number",
                                "Make sure you keep this safe. We will send you an email with unlock code, however it can only be used once."
                            ).then(function (pin) {
                                setTimeout(function () {
                                    Page.Input.Pin.ask(
                                        "Please Confirm your PIN Number",
                                        "In order to verify that you have entered the correct PIN number, we ask you to repeat it."
                                    ).then(function (pin_confirm, pin_init = pin) {
                                        setTimeout(function () {
                                            if (pin_confirm !== pin_init) {
                                                Page.Data.FlowStates.fail.error(
                                                    'Whoops! Looks like a Typo',
                                                    'The PIN numbers you entered did not match.',
                                                    'Try Again',
                                                    'Cancel').then(function () {
                                                    setTimeout(function () {
                                                        Page.Input.Pin.onboarding().then(resolve).catch(reject)
                                                    },400)
                                                }).catch(
                                                    function () {
                                                        reject(null);
                                                    }
                                                )

                                            } else {
                                                resolve(pin_init);
                                            }
                                        }, 400)
                                    })
                                }, 400)
                            })
                        // }
                    })
                },

                // Returns promise with readable pin
                ask: function (title, subtitle=""){

                    // Change title and subtitle of modal
                    $("#MODAL_SECURING_INPUT_PIN_TITLE").text(title).addClass('text-center');
                    $("#MODAL_SECURING_INPUT_PIN_SUBTITLE").text(subtitle).addClass('text-center');
                    $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", true);

                    // Clear inputs
                    Page.Input.Pin.inputs.forEach((input) => {
                        $(input).val("");
                    })

                    // Open modal
                    $("#MODAL_SECURING_INPUT_PIN").modal({backdrop: 'static', keyboard: false});

                    setTimeout(function (){
                        $(Page.Input.Pin.inputs[0]).focus();
                    },400)
                    return new Promise(function (resolve, reject) {
                        // Focus first input
                        $("#MODAL_SECURING_INPUT_PIN_CONTINUE").click(function (){
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").blur();
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", true);
                            $("#MODAL_SECURING_INPUT_PIN").modal("hide");
                            resolve(Page.Input.Pin.get());
                        })
                        $("#MODAL_SECURING_INPUT_PIN_CANCEL").click(function (){
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").blur();
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", true);
                            $("#MODAL_SECURING_INPUT_PIN").modal("hide");
                            reject(null);
                        })
                    })
                },

                // Bind pin input for auto advance
                bind: function (object, start=false, end=false){

                    // Add attributes
                    object.properties = {
                        input :{
                            pin: {
                                position: {
                                    start: start,
                                    end: end
                                }
                            }
                        }
                    }

                    // Add object to input list
                    this.inputs.push(object);

                    // Add event listeners
                    $(object).keydown(function (e) {
                        if (e.which === 8) {
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", true);
                            if ($(this).val() === "")
                                $(Page.Input.Pin.inputs[$(this).attr('data-digitcontrol-index') - 1]).focus();
                        }
                    })
                    $(object).keypress(function (e) {
                        //if the letter is not digit then display error and don't type anything
                        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                            return false;
                        }
                    });
                    $(object).keyup(function (e){

                        if (isNaN(parseInt($(object).val()))){
                            $(object).val("");
                            return;
                        }
                        if (e.which === 13 && Page.Input.Pin.inputs.every(function (value) {
                            return $(value).val() !== "";
                        })){
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", false);
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").click();
                        }
                        if ($(object).val())
                            $(Page.Input.Pin.inputs[parseInt($(this).attr('data-digitcontrol-index')) + 1]).focus();
                        if (Page.Input.Pin.inputs.every(function (value) {
                            return $(value).val() !== "";
                        })){
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", false);
                        }else{
                            $("#MODAL_SECURING_INPUT_PIN_CONTINUE").prop("disabled", true);
                        }
                    })
                },

                // Get Value
                get: function (i_start = 0, i_end = Page.Input.Pin.inputs.length){
                    let str = '';
                    this.inputs.forEach(input => {
                        if ($(input).attr('data-digitcontrol-index') >= i_start && $(input).attr('data-digitcontrol-index') <= i_end)
                            str += $(input).val();
                    })
                    return parseInt(str);
                }
            }
        }
    }
    $(document).ready(function (){
        Page.init();
        //Preprocessor Functions
        if(<? echo (!$card_exists ? 'true' : 'false')?>){
            slately.UI.modals.fatal();
        }
    })


</script>