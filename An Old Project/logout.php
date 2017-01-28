<?PHP
require_once("./include/membersite_config.php");

$membersite->LogOut();
?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LOGOUT</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css" />
<script type='text/javascript' src='js/gen_validatorv31.js'></script>
</head>

<body>
	<div class="container"> 
		<!-- IF LOGGED IN --> 
				  <!-- Header here -->
		<!-- IF LOGGED OUT -->
				  <!-- Alternate Header here -->
		<?php include_once "templates/loggedOutHeader.php"; ?>         

		<div id="main">
			<h2>You have logged out</h2>
			<p>
			<a href='login.php'>Login Again</a>
			</p>
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>