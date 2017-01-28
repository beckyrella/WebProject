<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Page</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container"> 
<!-- IF LOGGED IN --> 
          <!-- Header here -->
<!-- IF LOGGED OUT -->
          <!-- Alternate Header here -->
<?php include_once "templates/loggedInHeader.php"; ?>         

<div id="main">
<?php include_once "templates/bodyMainBanner.php"; ?>
<?php include_once "templates/bodyStandardText.php"; ?>
<?php include_once "templates/bodyGallery.php"; ?>
</div>

<?php include_once "templates/subscribePanel.php"; ?>
<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>