<?php
ini_set("display_errors",1);
error_reporting(E_ERROR);
require_once "/lib/union/lib/REST/v1/build.php";

\Union\PKG\Autoloader::import__require("API.managers");
\Union\PKG\Autoloader::import__require("API.cards");
\Union\PKG\Autoloader::import__require("API.transactions");
\Union\PKG\Autoloader::import__require("API.web");

//\Union\API\managers\mongo\connect::get_obj()->slately->cards->deleteMany([]);
//var_dump(\Union\API\managers\mongo\connect::get_obj()->slately->cards->find([])->toArray());

\Union\API\web\UI\UIManager::import_header();

?>
<style>
    /* Variables */
    * {
        box-sizing: border-box;
    }
    body {
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 16px;
        -webkit-font-smoothing: antialiased;
        display: flex;
        justify-content: center;
        align-content: center;
        height: 100vh;
        width: 100vw;
    }

    .result-message {
        line-height: 22px;
        font-size: 16px;
    }
    .result-message a {
        color: rgb(89, 111, 214);
        font-weight: 600;
        text-decoration: none;
    }
    .hidden {
        display: none;
    }
    #card-error {
        color: rgb(105, 115, 134);
        text-align: left;
        font-size: 13px;
        line-height: 17px;
        margin-top: 12px;
    }
    #card-element {
        border-radius: 4px 4px 0 0 ;
        padding: 12px;
        border: 1px solid rgba(50, 50, 93, 0.1);
        height: 44px;
        width: 100%;
        background: white;
    }
    #payment-request-button {
        margin-bottom: 32px;
    }
    /* Buttons and links */
    /*button {*/
    /*    background: #5469d4;*/
    /*    color: #ffffff;*/
    /*    font-family: Arial, sans-serif;*/
    /*    border-radius: 0 0 4px 4px;*/
    /*    border: 0;*/
    /*    padding: 12px 16px;*/
    /*    font-size: 16px;*/
    /*    font-weight: 600;*/
    /*    cursor: pointer;*/
    /*    display: block;*/
    /*    transition: all 0.2s ease;*/
    /*    box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);*/
    /*    width: 100%;*/
    /*}*/
    /*button:hover {*/
    /*    filter: contrast(115%);*/
    /*}*/
    /*button:disabled {*/
    /*    opacity: 0.5;*/
    /*    cursor: default;*/
    /*}*/
    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }
    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }
    .spinner:before,

</style>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Accept a card payment</title>
        <meta name="description" content="A demo of a card payment on Stripe" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
        <script src="/client.js" defer></script>
    </head>
    <body>
    <!-- Display a payment form -->
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form id="payment-form">
                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                <button class="btn btn-primary btn-block mt-2" id="submit">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="button-text">Pay</span>
                </button>
                <p id="card-error" role="alert"></p>
                <p class="result-message hidden">
                    Payment succeeded, see the result in your
                    <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
                </p>
            </form>
        </div>
    </div>
    <script>
        // A reference to Stripe.js initialized with your real test publishable API key.
        var stripe = Stripe("pk_test_51H5xy4LURMDkduvjkiRShGJygKjmj0uF2wIZf6ZShL0I1o8r34G0PcnyIbBkM2weyo3NJFCwu9ssDc187MTW6kyr00XdPJ7g4a");
        // The items the customer wants to buy
        var purchase = {
            items: [{ id: "xl-tshirt" }]
        };
        // Disable the button until we have Stripe set up on the page
        document.querySelector("button").disabled = true;
        fetch("/create.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(purchase)
        })
            .then(function(result) {
                return result.json();
            })
            .then(function(data) {
                var elements = stripe.elements();
                var style = {
                    base: {
                        color: "#32325d",
                        fontFamily: 'Arial, sans-serif',
                        fontSmoothing: "antialiased",
                        fontSize: "16px",
                        "::placeholder": {
                            color: "#32325d"
                        }
                    },
                    invalid: {
                        fontFamily: 'Arial, sans-serif',
                        color: "#fa755a",
                        iconColor: "#fa755a"
                    }
                };
                var card = elements.create("card", { style: style });
                // Stripe injects an iframe into the DOM
                card.mount("#card-element");
                card.on("change", function (event) {
                    // Disable the Pay button if there are no card details in the Element
                    document.querySelector("button").disabled = event.empty;
                    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
                });
                var form = document.getElementById("payment-form");
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    // Complete payment when the submit button is clicked
                    payWithCard(stripe, card, data.clientSecret);
                });
            });
        // Calls stripe.confirmCardPayment
        // If the card requires authentication Stripe shows a pop-up modal to
        // prompt the user to enter authentication details without leaving your page.
        var payWithCard = function(stripe, card, clientSecret) {
            loading(true);
            stripe
                .confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card
                    }
                })
                .then(function(result) {
                    if (result.error) {
                        // Show error to your customer
                        showError(result.error.message);
                    } else {
                        // The payment succeeded!
                        orderComplete(result.paymentIntent.id);
                    }
                });
        };
        /* ------- UI helpers ------- */
        // Shows a success message when the payment is complete
        var orderComplete = function(paymentIntentId) {
            loading(false);
            document
                .querySelector(".result-message a")
                .setAttribute(
                    "href",
                    "https://dashboard.stripe.com/test/payments/" + paymentIntentId
                );
            document.querySelector(".result-message").classList.remove("hidden");
            document.querySelector("button").disabled = true;
        };
        // Show the customer the error from Stripe if their card fails to charge
        var showError = function(errorMsgText) {
            loading(false);
            var errorMsg = document.querySelector("#card-error");
            errorMsg.textContent = errorMsgText;
            setTimeout(function() {
                errorMsg.textContent = "";
            }, 4000);
        };
        // Show a spinner on payment submission
        var loading = function(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("button").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("button").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        };
    </script>
    </body>
    </html>
<?php //\Union\API\web\UI\UIManager::import_footer(); ?>