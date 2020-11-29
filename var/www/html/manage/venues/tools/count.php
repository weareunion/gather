<?php
require_once "/lib/union/lib/REST/v1/build.php";
\Union\PKG\Autoloader::import__require("API.managers.mysql");
\Union\PKG\Autoloader::import__require("API.security, API.interface, API.web");
\Union\PKG\Autoloader::import__require("API.accounts, API.venues, API.venues.management");
if (isset($_GET['terminate'])){
    \Union\API\security\Auth::close_session();
    header("Location: count");
    exit();
}
if (isset($_GET['go']) && !\Union\API\security\Auth::logged_in()){
    \Union\API\security\Auth::bounce_back();
}elseif(isset($_GET['go']) && \Union\API\security\Auth::logged_in()){
    header("Location: count");
}
if (\Union\API\security\Auth::logged_in()){
    \Union\API\venues\ActiveVenue::bounce_back();
}
\Union\API\Respondus\Respondus::listen();
\Union\API\web\UI\UIManager::import_header();
?>

<? \Union\API\web\UI\UIManager::import_file("/elements/navbar/manage/standard.php");?>


<body style="margin: 0px;">
<main class="cs-page-wrapper d-flex flex-column">
    <div class="modal fade" id="MODAL_EXPLAIN_PASSSWORD_BAR" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Fill up the bar? What? 🧐</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>In order to keep your account safe, we use a set of sophisticated algorithms that take into account many factors such as phrases, patterns, and many others to determine how safe your password is. We don't have a checklist like normal websites, since <mark>we believe that security is more than a checklist </mark>. </p>
                    <h6>But for reference, we do always require these:</h6>
                    <ul>
                        <li>- An uppercase letter</li>
                        <li>- A lowercase letter</li>
                        <li>- A number</li>
                        <li>- A symbol</li>
                        <li>- More than 8 characters in length</li>
                    </ul>
                    <br>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        All you have to do is make a password that fills up the bar. You'll know when that happens when the bar turns <span class="text-success">green</span>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raise" data-dismiss="modal">👍 Got It</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content-->
    <!-- Background image-->

    <!-- Actual content-->


    <section class="container d-flex align-items-center pt-0 pb-0 pb-md-4" >
        <div class="w-100 ">
            <div class="row d-flex justify-content-center animate__animated animate__fadeIn" style="z-index: 20;">

                <div class="text-center">
                    <div class="cs-view <? echo (\Union\API\security\Auth::logged_in() ? 'hide' : 'show')?>" >
                        <!-- Sign in view-->
                        <div class="cs-view animate__animated animate__fadeIn show" >
                            <h1 class="font-size-sm pb-0 mb-1 font-weight-normal"><a class="text-primary">Venue Tools</a> <i class="fe-chevron-right"></i>Counter</h1>
                            <h1 class="h1 ">Hey there Stranger 🤠</h1>
                            <p class="font-size-ms text-muted mb-4">Sign in to your Slately account to continue.</p>
                            <div class="border-top text-center animate__animated animate__fadeInUp mt-4 pt-4 mt-3 mb-3"></div>
                            <div novalidate="">
                                <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_EMAIL_ALERT" role="alert">
                                    <i class="fe-alert-triangle font-size-xl mr-1"></i>
                                    <span id="LOGIN_EMAIL_ALERT_BODY"></span>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="LOGIN_EMAIL_BUTTON_CONTINUE" onclick="window.location.href += '?go'">Sign In with Slately <i class="fe-arrow-right ml-1"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="cs-view <? echo (\Union\API\security\Auth::logged_in() ? 'show' : 'hide')?>" >
<!--                        Counter Mode-->
                        <div id="counter_mode" class="cs-view animate__animated animate__fadeIn " >
                            <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">You're logged in as <? echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in()) . " " .  \Union\API\accounts\Account::get_last_name(\Union\API\security\Auth::logged_in())?>. <a class="text-primary" onclick="window.location += '?terminate'">Log Out.</a></h1>
                            <div class="display-1 pt-3 mb-0 pb-0 odometer count_target" id=""></div>
                            <p class="pb-3" onclick="Page.toggle_mode()"><a class="text-primary">Switch to View Mode</a></p>
                            <button type="button" class="btn btn-primary btn-lg btn-block btn-raise" onclick="Page.increase(5)"><h5 class="m-1 text-white"><i class="fe-chevron-up mr-1"></i>5 </h5></button>
                            <button type="button" class="btn btn-primary btn-lg btn-block btn-raise" onclick="Page.increase(1)"><h3 class="m-3 text-white"><i class="fe-chevron-up mr-1"></i>1 </h3></button>

                            <button type="button" class="btn btn-danger btn-lg btn-block btn-raise" id="dec_1" onclick="Page.decrease(1)"><h3 class="m-3 text-white"><i class="fe-chevron-down mr-1"></i>1 </h3></button>
                            <button type="button" class="btn btn-danger btn-lg btn-block btn-raise" id="dec_5" onclick="Page.decrease(5)"><h5 class="m-1 text-white"><i class="fe-chevron-down mr-1"></i>5 </h5></button>
                            <button type="button" class="btn btn-secondary btn-lg btn-block" id="reset" onclick="Page.reset()"><h3 class="m-1 "><i class="fe-rotate-cw mr-1"></i></h3></button>
                        </div>
<!--                        View Mode-->
                        <div id="view_mode" class="cs-view animate__animated animate__fadeIn show" onclick="" >
                            <h1 class="font-size-sm pb-0 mb-1 font-weight-normal">You're logged in as <? echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in()) . " " .  \Union\API\accounts\Account::get_last_name(\Union\API\security\Auth::logged_in())?>. <a class="text-primary" onclick="window.location += '?terminate'">Log Out.</a></h1>

                            <div class="display-1 pt-3 mb-0 pb-0 odometer count_target" ></div>
                            <p class="pb-3" onclick="Page.toggle_mode()"><a class="text-primary">Switch to Count Mode</a></p>
                            <button type="button" class="btn btn-primary" onclick="alert('test');">
                                <i class="fe-file-text mr-2"></i>
                                Open Reports
                            </button>
<!--                            <h5>Trendline</h5>-->
<!--                            <p>View the average attendance of your venue.</p>-->



                            <!--                            <div class="btn-group btn-group-lg" role="group" aria-label="Solid button group">-->
                            <!--                                <button type="button" class="btn bt btn-primary"><h3 class="m-3 text-white">+1 </h3></button>-->
                            <!--                                <button type="button" class="btn btn-secondary">Reset</button>-->
                            <!--                                <button type="button" class="btn bt btn-primary"><h3 class="m-3 text-white pr-1">-1 </h3></button>-->
                            <!--                            </div>-->
                            <!--                            <h1 class="h1 ">Hey there Stranger 🤠</h1>-->
                            <!--                            <p class="font-size-ms text-muted mb-4">Sign in to your Slately account to continue.</p>-->
                            <!--                            <div class="border-top text-center animate__animated animate__fadeInUp mt-4 pt-4 mt-3 mb-3"></div>-->
                            <!--                            <div novalidate="">-->
                            <!--                                <div class="alert alert-warning d-none animate__animated animate__headShake" id="LOGIN_EMAIL_ALERT" role="alert">-->
                            <!--                                    <i class="fe-alert-triangle font-size-xl mr-1"></i>-->
                            <!--                                    <span id="LOGIN_EMAIL_ALERT_BODY"></span>-->
                            <!--                                </div>-->
                            <!--                                <button class="btn btn-lg btn-primary btn-block btn-raise mb-3" id="LOGIN_EMAIL_BUTTON_CONTINUE" onclick="window.location.href += '?go'">Sign In with Slately <i class="fe-arrow-right ml-1"></i></button>-->
                            <!--                            </div>-->
                        </div>
                    </div>

                    <!--                    <p class="text-center font-size-xs pt-3 mb-0 text-muted"><a  class="font-weight-medium" data-view="#USER_ACTIVATING_ACCOUNT">ACTI</a> <a  class="font-weight-medium" data-view="#USER_CONFIRM_PHONE">CONF</a>  <a class="font-weight-medium" data-view="#USER_AWIATING_CONFIRMATIONS">AA</a></p>-->
                </div>
            </div>

        </div>
    </section>

    <div style="position: relative;  z-index: 0;" class="cs-view animate__animated animate__fadeInUp <? echo (\Union\API\security\Auth::logged_in() ? 'show' : '')?>" id="graph_view">

    <div class="chart-container" style="pointer-events:none !important; position: absolute; bottom: 0; width: 100vw; height: 40vh;">
        <canvas id="myChart" style="position: absolute; bottom: 0; max-height: 30vh; z-index: -1;"></canvas>
    </div>
    </div>
</main>
<?php \Union\API\web\UI\UIManager::import_footer(); ?>
<script>
    window.odometerOptions = {
        auto: true,
        duration: 3000, // Change how long the javascript expects the CSS animation to take
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.bundle.min.js"></script>
<script src="http://github.hubspot.com/odometer/odometer.js"></script>

<script>
    Chart.defaults.global.responsive = true;
    let data = {
        max: null,
        min: null,
        avg: null,
        previous: null
    }
     data.max = [190, 155, 200, 200, 200, 200];
     data.min = [92, 135, 173, 200, 200, 165];
     data.avg = [145, 142, 180, 200, 200, 180];
     data.previous = [122, 192, 180, 190, 194, 190];
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['5:00 pm', '5:15 pm', '5:30 pm', '5:45 pm', '6:00 pm', 'Now'],
            datasets: [{
                label: 'Average',
                data: data.avg,
                backgroundColor: [
                    'rgba(244, 244, 255, 1.00)'
                ],
                borderColor: [
                    'rgba(118, 109, 244, 1.00)'
                ],
                borderWidth: 3
            },{
                label: 'Last Week Average',
                data: data.previous,
                backgroundColor: [
                    'rgba(242, 247, 255, 0)'
                ],
                borderColor: [
                    'rgba(93, 154, 252, 1.00)'
                ],
                borderDash: [10,5],
                borderWidth: 3
            }]
        },
        options: {
            fill: 'rgba(118, 109, 244, 1.00)',
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: Math.min.apply(this, data.min),
                        max: Math.max.apply(this, data.max)+10,
                        callback: function(value, index, values) {
                            if (index === values.length - 1) return Math.min.apply(this, data.min);
                            else if (index === 0) return Math.max.apply(this, data.max)+10;
                            else return '';
                        },
                        display: false,
                        minRotation: 90
                    },
                    gridLines: {
                        drawOnChartArea: false,
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: false,
                        display: false,
                        minRotation: 90
                    },
                    gridLines: {
                        drawOnChartArea: false,
                        drawBorder: false
                    }
                }]
            }
        }
    });
</script>
<script>

    let Page = {};
    Page.user = {};
    Page.user.mode = 'view';
    Page.count = 0;
    Page.delta = 0;
    Page.count_ready = false;
    Page.init = function(){

    }
    Page.increase = function(amount) {
        Page.delta += amount;
        Page.count += amount;
        Page.update_count();
    }
     Page.decrease = function(amount) {
        if ((Page.count - amount) < 0){
            Page.count = 0;
        }else {
            Page.count -= amount;
            Page.delta -= amount;
        }
        Page.update_count();
    }
    Page.reset = function(amount) {
        Page.beacon.hesitation = 20000;
        Page.delta -= Page.count;
        Page.count = 0;
        Page.update_count();
    }
    Page.update_count = function(stopPost=false) {
        if (!stopPost)Page.beacon.hesitate();
        Page.modify_count(Page.count);
        if (Page.count <= 5){
            $("#dec_5").addClass("disabled");
            if (Page.count <=1){
                $("#dec_1").addClass("disabled");
            }
            if (Page.count === 0){
                $("#reset").addClass("disabled");
            }
        }
        if (Page.count >= 1){
            $("#dec_1").removeClass("disabled");
            if (Page.count >=5){
                $("#dec_5").removeClass("disabled");
            }
            if (Page.count > 0){
                $("#reset").removeClass("disabled");
            }
        }
        Page.modify_count(Page.count);
    }
    Page.modify_count = function(number) {
        $(".count_target").each(function(){
            $(this).html(number)
        });
    }
    Page.toggle_mode = function(){
        if (Page.user.mode === 'view'){
            Page.user.mode = 'count'
        }else {
            Page.user.mode = 'view'
        }
        if (Page.user.mode === 'count'){
            Page.beacon.stop_update();
            Page.beacon.start_update(1000);
            Page.beacon.update_sesitive = true;
            $("#counter_mode").addClass('show')
            $("#view_mode").removeClass('show')
            $("#graph_view").removeClass('show')
        }else {
            Page.beacon.stop_update();
            Page.beacon.start_update(1000);
            Page.beacon.update_sesitive = false;
            $("#counter_mode").removeClass('show')
            $("#view_mode").addClass('show')
            $("#graph_view").addClass('show')
        }
    }
    Page.beacon = {};
    Page.beacon.timeout = null;
    Page.beacon.hesitate = function(){
        clearTimeout(Page.beacon.timeout);
        Page.beacon.wake();
    }
    Page.beacon.hesitation = 1000;
    Page.beacon.wake = function(){
        Page.beacon.timeout = setTimeout(Page.beacon.send, Page.beacon.hesitation);
    }
    Page.beacon.update_sesitive = false;
    Page.beacon.send = function(){
        if (Page.count_ready === false) return;
        Page.beacon.hesitation = 1000;
        let server = new HTTPClient();
        server.set_service("API.venues.management.tools.counter");
        server.set_action("push_update");
        server.set_data({
            delta: Page.delta
        });
        server.send().then(function (data){
            Page.delta = 0;
            data = JSON.parse(data)
            console.log(data);
            Page.count = parseInt(data.current_count);
        }).catch(

        );
    }
    Page.beacon.update_interval = null;
    Page.beacon.update = function (){
        Page.beacon.getCurrentCount().then(function (){
            if (Page.beacon.update_sesitive && Page.delta != 0) return false;
            Page.update_count(true);
        })
    }
    Page.beacon.getCurrentCount = function(){
        if (Page.beacon.update_sesitive && Page.delta != 0) return false;
        return new Promise(function (resolve, reject) {
            Page.count_ready = true;
            let server = new HTTPClient();
            server.set_service("API.venues.management.tools.counter");
            server.set_action("pull_update");
            server.send().then(
                function (data){
                    data = JSON.parse(data)
                    console.log(data);
                    Page.count = parseInt(data.current_count);
                    resolve(data.current_count);
                }
            );
        })

    }
    Page.beacon.start_update = function(interval = 1000){
        Page.beacon.update_interval = setInterval(Page.beacon.update, interval);
    }
    Page.beacon.stop_update = function (){
        clearInterval(Page.beacon.update_interval);
    }
    $(document).ready(function () {
        Page.count = 0;
        Page.beacon.getCurrentCount().then(
            function (){
                Page.update_count(true)
            }
        );
        Page.beacon.start_update(1000);
    });
</script>
</body>
