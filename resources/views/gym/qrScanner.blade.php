@extends('layouts.app')

@section('content')
<div class="container centerText">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <!-- <input type="submit" value="قبول" class="btn btn-warning"> -->
                <div class="card-header">ماسح الكود</div>
                <br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">



                    <!-- <video id="preview"></video>
                    <script type="text/javascript" src='https://github.com/schmich/instascan-build/master/instascan.min.js'></script>
                    <script type="text/javascript">
                    let scanner = new Instascan.Scanner({
                        video: document.getElementById('preview')
                    });
                    scanner.addListener('scan', function (content) {
                        console.log(content);
                    });
                    Instascan.Camera.getCameras().then(function (cameras) {
                        if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                        } else {
                        console.error('No cameras found.');
                        }
                    }).catch(function (e) {
                        console.error(e);
                    });
                    </script> -->

                    <div class="container">
                    <h1>Scan QR Codes</h1>
                    <div class="section">
                        <div id="my-qr-reader">
                        </div>
                    </div>
                </div>
                <script
                    src="https://unpkg.com/html5-qrcode">
                </script>
                <script src="script.js"></script>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
