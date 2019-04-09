<!DOCTYPE html>
<html>
    <head>
        <title>Screen Two</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style type="text/css">
            .results { border:solid #bababa 1px; background:#bababa; min-width: 485px; min-height: 345px; margin:7px; }
        </style>
    </head>
    <body>
        <?php
        	session_start();
            if(isset($_POST['submit_image']) && $_POST['submit_image'] === 'Submit') {
            	$img = $_POST['image'];
            	$folderPath = "uploads/";

            	$image_parts = explode(";base64,", $img);
            	$image_type_aux = explode("image/", $image_parts[0]);
            	$image_type = $image_type_aux[1];

            	$image_base64 = base64_decode($image_parts[1]);

            	$fileName = uniqid() . '.png';

            	$file = $folderPath . $fileName;
            	file_put_contents($file, $image_base64);

            	$data = $_SESSION['data'];
            	$data['image'] = $fileName;

            	$_SESSION['data'] = $data;
            }

            if(isset($_POST['send_to_us']) && $_POST['send_to_us'] === 'SENT TO US') {
            	$data = $_SESSION['data'];
            	$filename = $data['image'];
			    $file = "uploads/" . $filename;

			    $mailto = $data['email'];
			    $subject = 'Thank you for submit your information!';
			    $message = 'Thank you for submit your information, Here is your details:';

			    $content = file_get_contents($file);
			    $content = chunk_split(base64_encode($content));

			    // a random hash will be necessary to send mixed content
			    $separator = md5(time());

			    // carriage return type (RFC)
			    $eol = "\r\n";

			    // main header (multipart mandatory)
			    $headers = "From: name <info@test.com>" . $eol;
			    $headers .= "MIME-Version: 1.0" . $eol;
			    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
			    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
			    $headers .= "This is a MIME encoded message." . $eol;

			    // message
			    $body = "--" . $separator . $eol;
			    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
			    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
			    $body .= $message . $eol;

			    // attachment
			    $body .= "--" . $separator . $eol;
			    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
			    $body .= "Content-Transfer-Encoding: base64" . $eol;
			    $body .= "Content-Disposition: attachment" . $eol;
			    $body .= $content . $eol;
			    $body .= "--" . $separator . "--";

			    //SEND Mail
			    if (mail($mailto, $subject, $body, $headers)) {
			        $success_mgs = "mail send ... OK";
			    } else {
			        $error_mgs = "mail send ... ERROR!";
			    }
            }
        ?>
        <form class="form-horizontal" method="POST" action="">
        <div class="wrapper2">
	        <div id="formContent2">
	        	<?php if(isset($success_mgs)) { ?>
		        	<div class="alert alert-success">
		        		<strong>Success!</strong> mail send ... OK.
		        	</div>
	        	<?php } ?>

	        	<?php if(isset($error_mgs)) { ?>
		        	<div class="alert alert-warning">
		        		<strong>Warning!</strong> mail send ... ERROR!
		        	</div>
	        	<?php } ?>

	        	<h1 class="text-center">Preview</h1>
				<div class="row">
				    <div class="col-md-12">
				    	<div class="form-group">
				    		<div class="col-sm-12" style="text-align:left; margin-left:30px;"><b>Full Name:</b></div>
				    		<div class="col-sm-12" style="text-align:left; margin-left:30px;">
				    			<?php if(isset($data['name'])) echo $data['name']; ?>
				    		</div>
				    	</div>

				    	<div class="form-group">
				    		<div class="col-sm-12" style="text-align:left; margin-left:30px;"><b>Email:</b></div>
				    		<div class="col-sm-12" style="text-align:left; margin-left:30px;">
				    			<?php if(isset($data['email'])) echo $data['email']; ?>
				    		</div>
				    	</div>

				    	<div class="form-group">
				    		<div class="col-sm-12" style="text-align:left; margin-left:30px;"><b>Picture:</b></div>
				    		<div class="col-sm-12">
				    			<?php if(isset($data['image'])) { ?>
				    				<img src='./uploads/<?php echo $data['image']; ?>' class="results">
				    			<?php } ?>
				    		</div>
				    	</div>

				    	<!--Fin datos personales-->
				    	<div class="col-md-12">
				    		<div class="col-md-5">
				    			<input type="button" name="retake_btn" id="retake_btn" class="btn btn-primary" value="RETAKE" onclick="location.href='step2.php';">
				    		</div>
				    		<div class="col-md-5" style="margin-right:10px;">
				    			<input type="submit" name="send_to_us" id="send_to_us" class="btn btn-primary" value="SENT TO US">
				    		</div>
				    	</div>
				    </div>
				</div>
			</div>
		</div>
		</form>
    </body>
</html>