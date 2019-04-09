<!DOCTYPE html>
<html>
    <head>
        <title>Screen Two</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
        <style type="text/css">
            #results { border:solid #bababa 1px; background:#bababa; min-width: 485px; min-height: 385px; margin:7px; }
        </style>
    </head>
    <body>
        <?php
            session_start();
            if(isset($_POST['submit_btn']) && $_POST['submit_btn'] === 'Submit') {
                $data['name'] = $_POST['name'];
                $data['email'] = $_POST['email'];
                
                $_SESSION['data'] = $data;
            }
        ?>
        <form method="POST" action="step3.php">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="wrapper2">
                        <div id="formContent2">
                        <h1 class="text-center">Take a Picture</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="image" class="image-tag">
                                    <div id="my_camera" style="margin-left:12px;"></div>
                                    <input type="button" value="Take Snapshot" onClick="take_snapshot()" style="margin-left:120px;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="wrapper2">
                        <div id="formContent2">
                            <h1 class="text-center">Captured Picture</h1>
                            <div id="results"></div>
                            <div class="col-md-12 text-center">
                                <input type="submit" name="submit_image" id="submit_image" class="btn btn-success" value="Submit">
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </form>

        
      
        <!-- Configure a few settings and attach camera -->
        <script language="JavaScript">
            Webcam.set({
                width: 490,
                height: 390,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
          
            Webcam.attach( '#my_camera' );
          
            function take_snapshot() {
                Webcam.snap( function(data_uri) {
                    $('.image-tag').val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                } );
            }
        </script>
    </body>
</html>