<?php
// Import structure
 require_once __DIR__ ."/../../src/php/elements/container/container_start.php";
// require_once __DIR__ ."/../../src/php/elements/navbar/navbar_admin_active.php";
?>

<head>
    <title>QR Code Scan Demo</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<!--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>-->
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>

<style>
    video.big_vid {
        object-fit: fill;
        width: 100%    !important;
        height: 100%   !important;
    }
</style>

<section class="hero is-primary is-large">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Scan a new Card
            </h1>
            <h2 class="subtitle">
                Have the client hold their QR Code under the camera. If that doesn't work, you can manually enter their code.

            </h2>
            <br>
            <div class="big_vid">
                <div class="notification is-primary mb-6 animate__animated animate__fadeInUp" id="camera_getting_ready">

                    <span class="is-pulled-left">
                        <h1 class="title is-5">One Moment</h1>
                        We're getting the camera ready...
                    </span>
                <span class="is-pulled-right">
                        <button class="button is-primary is-loading">Loading</button>
                    </span>
                <br>
                <br>
            </div>

                <article class="message is-danger">
                    <d iv class="notification mb-0 is-danger animate__animated animate__fadeIn " id="camera_getting_ready">

<!--                    <span class="is-pulled-left">-->
                        <h1 class="title is-5">Whoops! There was a problem getting your camera ready</h1>
<!--                    </span>-->
<!--                    </span>-->

                    <div class="message-body has-text-white">
                       We have run into a problem while trying to access your camera
                    </div>
                    </div>
                </article>
            <video class="box is-hidden" id="preview"></video>
        </div>
        </div>
    </div>
</section>

<!--IMPORTED SCRIPTING -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.js" crossorigin="anonymous"></script>-->

<!--<script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/index.min.js"></script>-->

<script>
    // var app = new ADS({
    //     el: '#app',
    //     data: {
    //         scanner: null,
    //         activeCameraId: null,
    //         cameras: [],
    //         scans: []
    //     },
    //     mounted: function () {
    //
    //     },
    //     methods: {
    //         formatName: function (name) {
    //             return name || '(unknown)';
    //         },
    //         selectCamera: function (camera) {
    //             this.activeCameraId = camera.id;
    //             this.scanner.start(camera);
    //         }
    //     }
    // });

    let Core_Binder;

    class Core {

    }

    class ExceptionManager extends Core {
        static throw(name, message, messageHTML=null){
            if (messageHTML == null) messageHTML = message;
            throw {
                name:        name,
                message:     message,
                htmlMessage: messageHTML,
                toString:    function(){return this.name + ": " + this.message;}
            };
        }
    }


    class CardInterface extends Core{

    }

    class CameraScannerPlugin extends CardInterface {
        static self = this;

        static start(){
            self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
            Instascan.Camera.getCameras().then(function (cameras) {

                self.cameras = cameras;
                if (cameras.length > 0) {
                    self.activeCameraId = cameras[0].id;
                    self.scanner.start(cameras[0]).then(function () {
                        setTimeout(function () {
                            $("#camera_getting_ready").addClass("is-hidden");
                            $("#preview").removeClass("is-hidden");
                        }, 2000);
                    })
                } else {
                    ExceptionManager.throw("No Cameras Found", "There were no cameras found", "We couldn't find any cameras to connect to.")
                }
            }).catch(function (e) {
                console.error(e);
            });
        }

        static stop(){
            return self.scanner.stop()
        }

        static bind(callback){
            self.scanner.addListener('scan', callback);
        }

    }
    CameraScannerPlugin.start();
    CameraScannerPlugin.bind(
        function (content, image) {
            let sound = new Audio('../../../src/media/sounds/scanner_success.wav');
            sound.play();
            console.log("Scanned: " + content);
        })



</script>
