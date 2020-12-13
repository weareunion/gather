<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.web, API.security, API.venues");
\Union\API\security\Auth::bounce_back();
\Union\API\venues\ActiveVenue::bounce_back();
\Union\API\web\UI\UIManager::import_header();
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
            <div class="col">
                <div class="text-center pb-3">

                    <span class="badge badge-primary"><span class="font-weight-normal"><i class='fe-credit-card  '></i> Cards</span></span>

                    <span class="badge badge-secondary"><span class="font-weight-normal"><i class='fe-credit-card  '></i> Gift Card</span></span>

                    <h1 class="mb-0">What do you want to do?</h1>
                    <p>Please choose one of the following to get started.</p>
                </div>
                <div class="btn btn-translucent-primary btn-raise text-left mt-2 btn-block" onclick="window.location = '<?php echo SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS_CREATE ?>'">
                    <div class="card-body row">
                        <div class="float-left">
                            <i class='fe-plus mr-1 lead  mt-3 mr-4 align-middle '></i>
                        </div >
                        <div class="float-left col-10 col-sm-10 col-md-10 col-lg-10">
                            <p class="lead font-weight-bold text-wrap mb-0">Create a new Gift Card</p>
                            <p class="card-text font-size-sm text-wrap mt-0">Issue a user a fresh new Gift Card</p>
                        </div>
                        <div class="float-right col d-none d-md-block">
                            <p class="lead font-weight-bold mb-0  mt-3"><i class='fe-arrow-right mr-1 float-right '></i></p>
                        </div>

                    </div>
                </div>
                <div class="btn btn-secondary btn-raise text-left mt-2 btn-block disabled">
                    <div class="card-body row">
                        <div class="float-left">
                            <i class='fe-search mr-1 lead  mt-3 mr-4 align-middle '></i>
                        </div >
                        <div class="float-left col-10 col-sm-10 col-md-10 col-lg-10">
                            <p class="lead font-weight-bold text-wrap mb-0 ">Find, View or Edit an existing Gift Card</p>
                            <p class=" font-size-sm text-wrap mb-0 mt-0">Change PINs, validity dates, transfer the card, view transactions and many other actions on an existing Gift Card</p>
                        </div>
                        <div class="float-right col d-none d-md-block">
                            <p class="lead font-weight-bold mb-0 mt-3"><i class='fe-arrow-right mr-1 float-right '></i></p>
                        </div>
                    </div>
                </div>
                <div class="btn btn-translucent-info btn-raise text-left mt-4 btn-block disabled" disabled onclick="window.location = '<?php echo SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS_CREATE ?>'">
                    <div class="card-body row">
                        <div class="float-left">
                            <i class='fe-send mr-1 lead  mt-3 mr-4 align-middle '></i>
                        </div >
                        <div class="float-left col-10 col-sm-10 col-md-10 col-lg-10">
                            <p class="lead font-weight-bold text-wrap mb-0">Send the User a link to do this process</p>
                            <p class="card-text font-size-sm text-wrap mt-0">We will text the user a link to the client portal for buying a gift card</p>
                        </div>
                        <div class="float-right col d-none d-md-block">
                            <p class="lead font-weight-bold mb-0  mt-3"><i class='fe-arrow-right mr-1 float-right '></i></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

<?php \Union\API\web\UI\UIManager::import_footer();?>
 