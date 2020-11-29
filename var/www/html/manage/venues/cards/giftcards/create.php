<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web, API.security, API.venues, API.interface");
\Union\API\security\Auth::bounce_back();
\Union\API\venues\ActiveVenue::bounce_back();
\Union\API\Respondus\Respondus::listen();

\Union\API\web\UI\UIManager::import_header("standard_no_bulma");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cards - Slately for Venues</title>
</head>
<body>
<? \Union\API\web\UI\UIManager::import_file("/elements/navbar/manage/standard.php");?>


<main>
    <div class="container ">
        <div class="vh-100 row align-items-center">
            <div class="col-12 " id="CREATE_CARD_VIEW_STEPS">
                <div id="CREATE_CARD_VIEW_STEP_1" class="animate__animated animate__fadeIn" style="animation-delay: 0s">
                <div class="text-center pb-3">
                    <small class="animate__animated animate__fadeIn" style="animation-delay: 0.3s">Create a Gift Card</small>
                    <h1 class="mb-0 animate__animated animate__fadeIn" style="animation-delay: 0.4s">How much are we putting on it?</h1>
                    <p class="animate__animated animate__fadeIn" style="animation-delay: 0.5s">Please specify an amount to load onto the card</p>
                </div>
                <div class="row">
                    <div class="d-none d-sm-block col-sm-1 col-md-2 col-lg-4"></div>
                    <div class="col-sm-12 col-md-8 col-lg-4 form-group">
<!--                        <label for="large-input" class="form-label-lg">Large input</label>-->
                        <input class="form-control form-control-lg text-center h1" type="tel" onclick=" $(this).maskMoney();" data-thousands="," data-decimal="." data-prefix="$" id="CREATE_CARD_VIEW_STEP_1_INPUT_AMOUNT" placeholder="$0.00">
                    </div>
                </div>
                <div class="row mt-2">
                <div class="d-none d-sm-block col-sm-1 col-md-2 col-lg-4"></div>
                <div class="col-sm-12 col-md-8 col-lg-4">
                    <button type="button" onclick="Page.Steps.step_1()" class="btn btn-primary btn-block btn-lg">
                        Continue
                        <i class="fe-arrow-right ml-1"></i>
                    </button>
                    <button type="button" onclick="window.location = '<?php echo SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS?>'" class="btn btn-secondary btn-block btn-lg">
                        Back
                    </button>
                </div>
                </div>
                </div>
                <div id="CREATE_CARD_VIEW_STEP_2" class="animate__animated animate__fadeIn d-none" style="animation-delay: 0s">
                <div class="text-center pb-3">
                    <small class="animate__animated animate__fadeIn" style="animation-delay: 0.3s">Create a Gift Card</small>
                    <h1 class="mb-0 animate__animated animate__fadeIn" style="animation-delay: 0.4s">Where should we send it?</h1>
                    <p class="animate__animated animate__fadeIn" style="animation-delay: 0.5s">Please specify a phone number to send it to</p>
                </div>
                <div class="row">
                    <div class="d-none d-sm-block col-sm-1 col-md-2 col-lg-4"></div>
                    <div class="col-sm-12 col-md-8 col-lg-4 form-group">
<!--                        <label for="large-input" class="form-label-lg">Large input</label>-->
                        <input class="form-control form-control-lg text-center h1" type="tel" onclick=" $(this).mask('(000) 000-0000');" data-thousands="," data-decimal="." data-prefix="$" id="CREATE_CARD_VIEW_STEP_2_INPUT_PHONE_NUMBER" placeholder="Enter a Phone Number">
                    </div>
                </div>
                <div class="row mt-2">
                <div class="d-none d-sm-block col-sm-1 col-md-2 col-lg-4"></div>
                <div class="col-sm-12 col-md-8 col-lg-4">
                    <button type="button" onclick="Page.Steps.step_2()" class="btn btn-primary btn-block btn-lg">
                        Continue
                        <i class="fe-arrow-right ml-1"></i>
                    </button>
                    <button type="button" onclick="Page.Steps.switch_step(1,0)" class="btn btn-secondary btn-block btn-lg">
                        Back
                    </button>
                </div>
                </div>
                </div>
                <div id="CREATE_CARD_VIEW_STEP_3" class="animate__animated animate__fadeIn d-none" style="animation-delay: 0s">
                    <div class="text-center pb-3">
                        <small class="animate__animated animate__fadeIn" style="animation-delay: 0.3s">Create a Gift Card</small>
                        <h1 class="mb-0 animate__animated animate__fadeIn" style="animation-delay: 0.4s">How are they going to pay for it?</h1>
                        <p class="animate__animated animate__fadeIn" style="animation-delay: 0.5s">Please select a payment method</p>
                    </div>
                    <div class="btn btn-translucent-info btn-raise text-left mt-2 btn-block" onclick="Page.Steps.step_3('card')">
                        <div class="card-body row">
                            <div class="float-left">
                                <i class='fe-credit-card mr-1 lead  mt-3 mr-4 align-middle '></i>
                            </div >
                            <div class="float-left col-10 col-sm-10 col-md-10 col-lg-10">
                                <p class="lead font-weight-bold text-wrap mb-0">Pay with a Credit Card Number</p>
                                <p class="card-text font-size-sm text-wrap mt-0">You must have the card number, expiration date, CVV, and zip code to do this method. </p>
                            </div>
                            <div class="float-right col d-none d-md-block">
                                <p class="lead font-weight-bold mb-0  mt-3"><i class='fe-arrow-right mr-1 float-right '></i></p>
                            </div>

                        </div>
                    </div>
                    <div class="btn btn-translucent-success btn-raise text-left mt-2 btn-block" onclick="Page.Steps.step_3('cash')">
                        <div class="card-body row">
                            <div class="float-left">
                                <i class='fe-dollar-sign mr-1 lead  mt-3 mr-4 align-middle '></i>
                            </div >
                            <div class="float-left col-10 col-sm-10 col-md-10 col-lg-10">
                                <p class="lead font-weight-bold text-wrap mb-0">Pay with Cash or other Payment Method</p>
                                <p class="card-text font-size-sm text-wrap mt-0">We will trust that you have taken care of the financials.</p>
                            </div>
                            <div class="float-right col d-none d-md-block">
                                <p class="lead font-weight-bold mb-0  mt-3"><i class='fe-arrow-right mr-1 float-right '></i></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-none" id="CREATE_CARD_VIEW_CONCLUDE">
                <div id="CREATE_CARD_VIEW_STEP_1" class="animate__animated animate__fadeIn" style="animation-delay: 0s">
                    <div class="text-center pb-3">
                        <small class="animate__animated animate__fadeIn" style="animation-delay: 0.3s">Create a Gift Card</small>
                        <h1 class="mb-0 animate__animated animate__fadeIn" style="animation-delay: 0.4s">Here it is!</h1>
                        <p class="animate__animated animate__fadeIn" style="animation-delay: 0.5s">Find below the card information</p>
                    </div>
                    <div class="row">
                        <div class="d-none d-sm-block col-sm-1 col-md-2 col-lg-4"></div>
                        <div class="col-sm-12 col-md-8 col-lg-4 form-group">
                            <div class="card bg-faded-primary border-0">
                                <div class="card-body " id="CREATE_CARD_VIEW_CONCLUDE_INFO">
                                    <h4 class="text-danger text-center">An Unknown Error Occurred</h4>
                                    <p class="text-center">We aren't quite certain what could have caused this, but feel free to contact support.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="d-none d-sm-block col-sm-1 col-md-2 col-lg-4"></div>
                        <div class="col-sm-12 col-md-8 col-lg-4">
                            <button type="button" onclick="window.location = '<?php echo SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS?>'" class="btn btn-primary btn-block btn-lg">
                                Done
                            </button>
                            <button type="button" onclick="window.location = '<?php echo SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS?>'" class="btn  btn-link btn-block">
                                Edit Card
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</main>
</body>

<!--Import all scripts-->
<?php \Union\API\web\UI\UIManager::import_footer();?>

<script>
    let card_attributes = {
        amount: null,
        payment: {
            method: null,
            attributes: null
        },
        contact: {
            type: null,
            value: null
        }
    };
    let Page = {
        Submit : {
          push: function () {
              slately.UI.modals.loading.open();
              setTimeout(function () {
                  let client = new HTTPClient();
                  client.set_service("API.cards.issuing").set_action("transact").set_data(card_attributes);
                  client.send().then(
                      function(e) {
                          console.log(e);
                          console.log(JSON.parse(e))
                          Page.Steps.conclude(JSON.parse(e));
                          slately.UI.modals.loading.close();
                      }
              ).catch(function (e) {
                      slately.UI.modals.loading.close();

                      slately.UI.modals.error("There was a Problem creating your card", "We aren't sure what happened, but we tracked the problem. (Error:" + e.response.lookup + ")", "Restart").then(function () {
                          location.reload();
                      })
                  })
              }, 500)
          }
        },
        Steps : {
            step_ids : [
                'CREATE_CARD_VIEW_STEP_1',
                'CREATE_CARD_VIEW_STEP_2',
                'CREATE_CARD_VIEW_STEP_3'
            ],
            switch_step: function(f, t){
                let delay = 500;
                try {
                    slately.UI.modals.loading.open();
                }catch (e) {
                    delay = 0;
                }
                setTimeout(function() {
                    console.log('f');
                    if (f >= 0) $("#" + Page.Steps.step_ids[f]).addClass('d-none');
                    if (t < Page.Steps.step_ids.length) $("#" + Page.Steps.step_ids[t]).removeClass('d-none');
                    try{
                        slately.UI.modals.loading.close();
                    }catch (e) {
                        
                    }
                }, delay)
            },
            step_1: function(){
                let amount = $("#" + this.step_ids[0] + "_INPUT_AMOUNT").val();
                let amount_val = parseInt(amount.replace(/\D/g,''))/100;
                let promise;
                if (amount <= 0) {
                    slately.UI.modals.error("Nothing here!", "You must enter a value in the text box to continue.");
                    return;
                }
                try {
                    if (amount_val < 5) {
                        promise = slately.UI.modals.warning("Looks a Little Low", "The amount " + amount + " seems a little low. Is this correct?", "Yes it is", "Whoops! No it isn't")
                    } else if (amount_val > 100) {
                        promise = slately.UI.modals.warning("Looks a Little High", "The amount " + amount + " seems a little high. Is this correct?", "Yes it is", "Whoops! No it isn't")
                    } else {
                        promise = slately.UI.modals.warning("Just to Double Check", "We just want to confirm that the amount of " + amount + " is correct. Is it?", "Yes it is", "Whoops! No it isn't")
                    }
                }catch (e) {
                    card_attributes.amount = amount_val;
                    Page.Steps.switch_step(0,1);
                }
                promise.then(function () {
                    Page.Steps.switch_step(0,1);
                    card_attributes.amount = amount_val;
                })
            },
            step_2: function(){
                let amount = $("#" + this.step_ids[1] + "_INPUT_PHONE_NUMBER").val();
                if (!amount.replace(/\D/g,'').match(/^\d{10}$/)) {
                    slately.UI.modals.error("Something doesn't look right", "You must enter a phone number in the text box to continue.");
                    return;
                }
                card_attributes.contact.type = 'phone_number';
                card_attributes.contact.value = amount;
                Page.Steps.switch_step(1,2);

            },
            step_3: function(selection){
                switch (selection) {
                    case 'cash':
                        slately.UI.modals.warning(
                            "We will NOT keep track of this payment.",
                            "This payment must be manually processed and will not be included in payouts.",
                            "I understand",
                            "Cancel").then(function(){
                                card_attributes.payment.method = 'cash'
                            Page.Submit.push()
                        })
                        break;
                }
            },
            conclude: function(data){
                $("#CREATE_CARD_VIEW_STEPS").addClass('d-none');
                $("#CREATE_CARD_VIEW_CONCLUDE").removeClass('d-none');
                $("#CREATE_CARD_VIEW_CONCLUDE_INFO").html(
                    '                                    <div class="cs-widget">\n' +
                    '                                        <h3 class="cs-widget-title">Card details</h3>\n' +
                    '                                        <div class="media pb-3  border-0  border-bottom">\n' +
                    '                                            <i class="fe-message-square font-size-lg mt-2 mb-0 text-primary"></i>\n' +
                    '                                            <div class="media-body pl-3">\n' +
                    '                                                <span class="font-size-ms text-muted">Activation Link</span>\n' +
                    '                                                <a class="d-block nav-link-style font-size-sm" href="#">'+(data.client_message_sent ? '<i class="fe-check mr-1 text-success font-weight-bolder"></i> Sent to '+card_attributes.contact.value+'</a>\n' : '<i class="fe-x mr-1 text-danger font-weight-bolder"></i> The client message could not be sent.</a>\n')  +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="media pt-2 pb-3  border-0  border-bottom">\n' +
                    '                                            <i class="fe-link font-size-lg mt-2 mb-0 text-primary"></i>\n' +
                    '                                            <div class="media-body pl-3">\n' +
                    '                                                <span class="font-size-ms text-muted">Card Link</span>\n' +
                    '                                                <a class="d-block nav-link-style font-size-sm btn-link " _target="_blank" href="'+data.card_access_URL+'"><u>'+data.card_access_URL+'</u></a>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="media pt-2 border-0 border-bottom">\n' +
                    '                                            <i class="fe-maximize font-size-lg mt-2 mb-0 text-primary"></i>\n' +
                    '                                            <div class="media-body pl-3 mb-2">\n' +
                    '                                                <span class="font-size-ms text-muted">QR Code</span>\n' +
                    '                                                <a class="d-blockfont-size-sm btn btn-primary btn-sm btn-block" onclick="slately.UI.qr.display_qr(\'Here is your QR Code\', \'Scan it to view your card\', \''+data.card_access_URL+'\')">Open QR Code</a>\n' +
                    '                                                <span class="font-size-xs text-muted">This is the clients QR code</span>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="media  border-0  pt-2">\n' +
                    '                                            <i class="fe-rotate-cw font-size-lg mt-2 mb-0 text-primary"></i>\n' +
                    '                                            <div class="media-body pl-3">\n' +
                    '                                                <span class="font-size-ms text-muted">Backup Pin</span>\n' +
                    '                                                <a class="d-block nav-link-style font-size-sm" >'+data.backup_pin+'</a>\n' +
                    '                                                <span class="font-size-xs mt-0 pt-0 text-muted">Remind the user to write this down</span>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n'
                )
            }
        }
    }
</script>

