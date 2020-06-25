<?php
// Import structure
require_once __DIR__ . "/../../../src/php/elements/container/container_start.php";
?>
<style>


    #main {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .spinner {
        position: relative;
    }
    .spinner:before, .spinner:after {
        content: "";
        position: relative;
        display: block;
        background-color: #cfd0d1;
    }
    .spinner:before {
        animation: spinner 2.5s cubic-bezier(0.75, 0, 0.5, 1) infinite normal;
        width: 3em;
        height: 3em;
        background-color: #ffdd57;
    }
    .spinner:after {
        animation: shadow 2.5s cubic-bezier(0.75, 0, 0.5, 1) infinite normal;
        bottom: -2em;
        height: .25em;
        border-radius: 50%;
        background-color: #f2f2f2;
    }

    @keyframes spinner {
        50% {
            border-radius: 50%;
            transform: scale(0.5) rotate(360deg);
        }
        100% {
            transform: scale(1) rotate(720deg);
        }
    }
    @keyframes shadow {
        50% {
            transform: scale(0.5);
            background-color: rgba(#000,0.1);
        }
    }
</style>
    <div id="main">

        <span class="spinner"></span>

    </div>




    <section class="hero is-small is-warning is-bold">
    <div class="hero-head">
        <?php
        require_once __DIR__ . "/../../../src/php/elements/navbar/navbar_admin_active.php";
        require_once __DIR__ . "/../../../API/autoload.php";
        ?>
    </div>

    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Event Title
            </h1>
            <h2 class="subtitle">
                This event is upcoming in 2 weeks.
            </h2>
        </div>
    </div>
    <div class="hero-foot">
        <nav class="tabs is-boxed is-fullwidth">
            <div class="container">
                <ul>
                    <li class="is-active">
                        <a>Overview</a>
                    </li>
                    <li >
                        <a>Active Cards</a>
                    </li>
                    <li>
                        <a>Guest List</a>
                    </li>
                    <li>
                        <a>Vendor Payouts</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

</section>
    <section class="section">
        <br>
        <div class="container" id="main_page_content">
            <p class="title">
                Funding &nbsp
                <span class="tag is-primary is-light is-large"> &nbsp&nbsp <span class="icon is-small">
  <i class="fas fa-money-bill-wave "></i>
</span> &nbsp &nbsp&nbsp Add Funding </span>
            </p>
            <div class="columns is-mobile">
                <div class="column">
                    <article class="tile is-child notification is-secondary">
                        <p class="title is-6 ">Funds Allotted - <a class="subtitle is-6 ">Add Funding</a></p>
                        <p class="subtitle is-1 has-text-weight-bold">$400.00</p>
                    </article>
                </div>
                <div class="column">
                    <article class="tile is-child notification is-success is-light">
                        <p class="title is-6">Funds Remaining</p>
                        <p class="subtitle is-1 has-text-weight-bold">$218.92 (54.7%)</p>
                    </article>
                </div>

            </div>
            <br>
            <br>
            <hr>
            <br>
            <br>
            <p class="title">
                Scheduling &nbsp
                <span class="tag is-primary is-light is-large"> &nbsp&nbsp <span class="icon is-small">
  <i class="fas fa-clock "></i>
</span> &nbsp &nbsp&nbsp Adjust Scheduled Times</span>
                <span class="tag is-danger is-light is-large"> &nbsp&nbsp <span class="icon is-small">
  <i class="fas fa-radiation-alt"></i>
</span> &nbsp &nbsp&nbsp Stop Event</span>
            </p>
            <div class="columns is-mobile">
                <div class="column">
                    <article class="tile is-child notification is-secondary">

                        <p class="title is-6 ">
                        </span>Event Starts</p>
                        <p class="subtitle is-3 has-text-weight-bold">6/10/2020 @ 7:30PM</p>

                    </article>
                </div>
                <div class="column">
                    <article class="tile is-child notification is-warning is-light">
                        <p class="title is-6">Time Remaining</p>
                        <p class="subtitle is-3 has-text-weight-bold">35 minutes</p>
                    </article>
                </div>
                <div class="column">
                    <article class="tile is-child notification is-secondary is-light">
                        <p class="title is-6">Event Ends</p>
                        <p class="subtitle is-3 has-text-weight-bold">6/10/2020 @ 9:00PM</p>
                    </article>
                </div>

            </div>

            <br>
            <br>
            <br>
        </div>
    </section>
<?php
// Import structure
require_once __DIR__ . "/../../../src/php/elements/container/container_end.php";

?>