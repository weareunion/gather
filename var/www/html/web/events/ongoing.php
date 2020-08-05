<?php
// Import structure
require_once __DIR__ . "/../../src/php/elements/container/container_start.php";
require_once __DIR__ . "/../../src/php/elements/events/hero_start.php"
?>
<li>
    <a>Overview</a>
</li>
<li class="is-active">
    <a>Ongoing Events</a>
</li>
<li>
    <a>Upcoming Events</a>
</li>
<li>
    <a>Past Events</a>
</li>
<?php require_once __DIR__ . "/../../src/php/elements/events/hero_end.php" ?>

<section class="section">
    <br>
    <div class="container" id="main_page_content">

        <h1 class="title">
            Ongoing Events
            <span class="tag  is-light">
                <span class="icon has-text-danger">
                    <i class="fas fa-exclamation-circle"> </i>
                </span>
                &nbsp Changes are real time
            </span>
        </h1>

        <p class="subtitle is-5 is-text-light">
            Here are all of your events that are currently happening.
        </p>
        <hr>
        <br>
        <br>
        <div class="box" style="!important; padding: 80px 50px 75px 100px;">
            <article class="media">

                <div class="media-content">
                        <h1 class="title is-3 ">BMW Group Party <span class="tag is-warning is-light">Event Ends in 45 minutes</span></h1>
                    <h1 class="subtitle is-6 "><strong>Hosted by:</strong> <a>Marian Webber</a></h1>
                        <div class="notification is-primary is-light">
                            <strong>Redistributable Funds</strong> This event is over halfway over and still has unused funds from missing guests. <a class="is-pulled-right">Activate Smart Allotment</a>
                        </div>
                    <div class="columns is-mobile">
                        <div class="column">
                            <article class="tile is-child notification is-secondary">
                                <p class="title is-6 ">Funds Allotted</p>
                                <p class="subtitle is-5">$400.00</p>
                            </article>
                        </div>
                        <div class="column">
                            <article class="tile is-child notification is-success is-light">
                                <p class="title is-6">Funds Remaining</p>
                                <p class="subtitle is-5">$218.92 (54.7%)</p>
                            </article>
                        </div>
                        <div class="column">
                            <article class="tile is-child notification is-secondary is-light">
                                <p class="title is-6">Active Users</p>
                                <p class="subtitle is-5">18/20</p>
                            </article>
                        </div>
                        <div class="column">
                            <article class="tile is-child notification is-white">
                                <a href="manage/overview.php" style="text-decoration: none;">
                                <button class="button is-large is-fullwidth is-light" >
                                    <p class="title is-5 is-primary" >
                                        Manage Event <span class="subtitle"></span>
                                    </p>
                                </button>
                                </a>
                            </article>
                        </div>
                    </div>

                </div>
            </article>
        </div>
    </div>
</section>

<?php
// Import structure
require_once __DIR__ . "/../../src/php/elements/container/container_end.php";

?>
