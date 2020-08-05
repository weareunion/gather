<?php
// Import structure
require_once __DIR__ ."/../../../src/php/elements/container/container_start.php";
?>

<section class="hero is-danger is-fullheight is-bold">
    <div class="hero-body">
        <div class=" container is-text-secondary">
            <h1 class="title is-1 animate__animated animate__fadeInUp" style="animation-delay: 0s;">
                Get Started with <br> an Event
            </h1>
            <p class="subtitle is-5 animate__animated animate__fadeInUp" style="animation-delay: 0.2s; padding-top: 1rem">
                Please enter in the code that your event host or Gather GVL <br> gave you.
            </p>
            <br>
            <div class="columns is-mobile">
                <div class="column is-two-fifths-desktop is-full-mobile">
                    <div class="field ">
                        <div class="control">
                            <input type="tel" class="input is-large is-danger animate__animated animate__fadeInUp box" style="animation-delay: 0.4s;" type="text" placeholder="Your Event Code">
                        </div>
                    </div>
                    <button class="button is-large is-fullwidth is-danger  title box animate__animated animate__fadeInUp" style="animation-delay: 0.6s;" onclick="$(this).addClass('is-loading')">Continue</button>
                    <div class="notification is-warning animate__animated animate__fadeInUp">
                        <strong>Whoops!</strong> We don't recognize that Event Code
                    </div>
                    <div class="has-text-centered animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                        <a href="#" class="has-text-white-bis ">I don't have an event code</a>
                    </div>

                </div>
                <div class="column ">
                </div>
            </div>
        </div>
    </div>
</section>
