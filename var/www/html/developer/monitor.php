<head>
    <meta charset="UTF-8">
    <title>Slately Developers | Uptime Monitor </title>
</head>
<div class="shadow">
    <?php
    try {
        require_once "/lib/union/lib/REST/v1/build.php";
        \Union\PKG\Autoloader::import__require("API.web,API.security, API.storage");
        \Union\API\storage\GCStorageClient::register_stream();

        //file_put_contents("gs://slately_buckets_public_general/5050.txt", "test");

        \Union\API\web\UI\UIManager::import_header();
        require_once "/lib/union/lib/REST/v1/API/web/UI/resources/elements/navbar/standard_fitted_logo.php";
    }catch (\Exception $exception){
        require_once __DIR__ . "/isolated/header.php";
        echo "<strong> CRITICAL ERROR! ATTENTION REQUIRED </strong>";
    }



    ?>
</div>
<div class="container">
    <h1 class="mt-5">Uptime Monitor</h1>
    <p>Last Check: 1 min ago</p>
    <div class="card shadow-none bg-secondary border-0">
        <div class="card-body ">
            <div class="float-left">
                <p class="text-muted font-size-sm mb-0">Latest Result: (4 minutes ago) </p>
                <p class="mb-0 text-muted"><span class="text-success "><i class="fe-check mr-2"></i> Systems OK.</span> 2342/2342 (100%) tests ran successfully.</p>

            </div>
            <div class="float-right">
                <a href="#" class="btn  btn-success btn-md btn-raise"><i class="fe-play mr-2"></i>Run All</a>
                <a href="#" class="btn  btn-outline-secondary disabled btn-md btn-raise">Show History</a>
            </div>

        </div>
    </div>
    <div class="row mt-1">
        <small class="col-12 text-muted text-center">Next Scheduled Test: Sep 08 2020 22:36:31</small>
    </div>
    <div class="cs-widget cs-widget-categories">
        <h3 class="cs-widget-title">Collapsable categories</h3>
        <ul id="categories">
            <li>
                <a class="cs-widget-link" href="#clothing" data-toggle="collapse">
                    <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Accounts
                    <small class="text-muted pl-1 ml-2">235</small>
                </a>
                <ul class="collapse show" id="clothing" data-parent="#categories">
                    <li><a class="cs-widget-link" href="#">Creation <span href="#" class="badge badge-success"><i class="fe-play mr-1 "></i>Run</span></a></li>
                    <li>
                        <a class="cs-widget-link" href="#"><span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Activation <span class="text-muted">- Running</span><span href="#" class="badge badge-secondary ml-1"><i class="fe-more-horizontal mr-1 font-size-sm"></i>Running</span></a>
                        <ul>
                            <li><a class="cs-widget-link" href="#"><i class="fe-check mr-1 text-success"></i> Validate Inputs <span class="text-muted">- Finished in 10ms</span></a> </li>
                            <li><a class="cs-widget-link" href="#"><span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Connect to Database <span class="text-muted">- Running...</span></a></li>
                            <li><a class="cs-widget-link" href="#"><i class="fe-more-horizontal mr-1 text-muted"></i> Check Phone Verification <span class="text-muted">- Waiting...</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>

</div>
<script src="https://demo.createx.studio/around/components/../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://demo.createx.studio/around/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.createx.studio/around/vendor/parallax-js/dist/parallax.min.js"></script>

<!-- Main theme script-->
<script src="https://demo.createx.studio/around/js/theme.min.js"></script>


<!--Jquery Plugins-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/3.0.9/pwstrength-bootstrap.min.js" integrity="sha512-HvxKicgd5m5yRIotHDzL9iFZ2PK/KzyrPqLDYPboT7WQrq3q3NuG+1eWeCZgPru4Pc7fhyPF+71qRQr7mUNWCg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js" integrity="sha512-ePSfiGQMIzYzXVQLqWoVC3yxVEHIM5Y3EGh9jPNxpf+hPuLtzPdxJX+lTC3ziPMlDgc5OsM4JThxGwN2DkWEeA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/offline-js/0.7.19/offline.min.js" integrity="sha512-KTivTC9CKUCyHiWM0wIqmkGMlMPREqaQlPIXcEMzza3fceLHnyuzJ00VSRw75TUXQE80MmugpySjAVu75S+bNg==" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYue8B6qCoWEbfasU0bByxNY2L44CJhcM&libraries=places"></script>