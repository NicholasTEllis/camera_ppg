<!DOCTYPE html>
<html lang="en">
<head>
    <title>Screen One</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div id="formContent">
            <h1 class="text-center" style="font-size:22px;">User Information</h1>
            

            <!-- Login Form -->
            <form class="form-horizontal" method="POST" action="step2.php" style="margin-top:20px;">
                <input type="text" id="name" class="second" name="name" placeholder="Full Name" value="" oninvalid="this.setCustomValidity('Please input your name!')" oninput="setCustomValidity('')" required="" maxlength="70">
                <input type="text" id="email" class="third" name="email" placeholder="Email" value="" oninvalid="this.setCustomValidity('Please input your email address!')" oninput="setCustomValidity('')" required="" maxlength="70">
                <input type="submit" name="submit_btn" id="submit_btn" class="btn btn-primary" value="Submit" style="margn-top: 30px;">
            </form>
        </div>
    </div>
</body>
</html>