<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container col-lg-6 py-4">

    <!-- <video
    id="preview"
    class="video-player"
    width="230"
    height="240"
    controls="controls"
    controls-preload="auto"
    autoplay="autoplay" loop muted playsinline
    >

    </video> -->
        <div style="position: fixed" class="card bg-white shadow rounded-3 p-3 border-0">
            <p style="text-align: center;">امسح الباركود للدخول</p>            
            <video id="preview"></video>
           
            <form action="{{ url('qrScanner') }}" method="POST" id="form">
            @csrf
            <input type="hidden" name="qrInfo" id="qrInfo">
            </form>
            
            <!-- <video id="preview" style="left: 0;top: 0;height:100%;position:fixed;width: 100%;z-index: -20;" autoplay loop muted playsinline></video> -->


            <!-- <div style="position: fixed">
                <video id="preview" style="left: 0;top: 0;height:100%;position:fixed;width: 100%;z-index: -20;" autoplay loop muted playsinline></video>
            </div> -->
            
            <!-- <video id="preview" class="video-background" autoplay loop muted playsinline></video> -->
        </div>
    </div>

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">

// var self;
// isQRScannerInitialised = false;
// function testQrCode(textBoxId,DivWidth){
// 	self = initialiseQRScanner(DivWidth);
	
// 	self.scanner.addListener('scan', function (content, image) {
// 		 if(textBoxId == $("#hiddenTextBox").val()){
// 				audio.play();
// 				var code = content;
// 		        $("#"+textBoxId).val(code);
// 		    	isQRScannerInitialised = false;
		    	
// 			}
		    
//     }, false);
    
// }

// function initialiseQRScanner(DivWidth){
	
// 	self = this;
	
//     if(isQRScannerInitialised == false){
    	
//     	var tempVideo = document.getElementsByTagName("video")[0];
//     	tempVideo.width=DivWidth;
//     	tempVideo.height=480;
    	
//     	self.scanner = new Instascan.Scanner({ video: document.getElementsByTagName("video")[0],mirror:false, scanPeriod: 1});
    	
// 		Instascan.Camera.getCameras().then(function (cameras) {
// 		    self.cameras = cameras;
// 		    if (self.cameras.length > 0) {
// 		    	 if(cameras[0].name.match(/back/) || cameras[0].name.match(/Back/)){
// 		    		self.activeCameraId = cameras[0].id;
// 			    	self.scanner.start(cameras[0]);
// 		    	} else if(cameras[1].name.match(/back/) || cameras[1].name.match(/Back/)){
// 		    		self.activeCameraId = cameras[1].id;
// 			    	self.scanner.start(cameras[1]);
// 		    	}
// 		    	isQRScannerInitialised = true;
		    	
// 		    } else {
		    	
// 		    	alert('No cameras found.');
// 		    	isQRScannerInitialised = false;
// 		    	return;
// 		    }
// 		  }).catch(function (e) { 
// 				isQRScannerInitialised = false;
// 				alert("QR error name:-"+e.name + " & QR error message:-"+e.message); console.error(e); 
// 			});
		
// 	}
// 	return self;
// }




      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {

        self.cameras = cameras;
		    if (self.cameras.length > 0) {
		    	 if(cameras[0].name.match(/back/) || cameras[0].name.match(/Back/)){
		    		self.activeCameraId = cameras[0].id;
			    	self.scanner.start(cameras[0]);
		    	} else if(cameras[1].name.match(/back/) || cameras[1].name.match(/Back/)){
		    		self.activeCameraId = cameras[1].id;
			    	self.scanner.start(cameras[1]);
		    	}
		    	isQRScannerInitialised = true;
		    	
		    } else {
		    	
		    	alert('No cameras found.');
		    	isQRScannerInitialised = false;
		    	return;
		    }


        // if (cameras.length > 0) {
        //     console.log(cameras.length)

        // if(cameras[0].name.match(/back/) || cameras[0].name.match(/Back/)){
        //     	    		activeCameraId = cameras[0].id;
        // 	            	scanner.start(cameras[0]);
        //scanner.start(cameras[0]);
        // }else if(cameras.length = 2) {
        //     scanner.start(cameras[1]);
        // }else if(cameras.length = 3) {
        //     scanner.start(cameras[2]);
        // }else if(cameras.length = 4) {
        //     scanner.start(cameras[3]);
        // }else {
        //   console.error('No cameras found.');
        // }
      }).catch(function (e) {
        console.error(e);
      });

      scanner.addListener('scan',function(c){
        document.getElementById('qrInfo').value =c;
        document.getElementById('form').submit();
      })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>
</html>