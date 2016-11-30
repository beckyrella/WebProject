<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RequestPasswordLinkSent</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
</head>

<body>
<div class="container"> 
	<!-- IF LOGGED IN --> 
			  <!-- Header here -->
	<!-- IF LOGGED OUT -->
			  <!-- Alternate Header here -->
	<?php include_once "templates/loggedOutHeader.php"; ?>         

	<div id="main">
		<div id='membersite_content'>
			<h2>Reset password link sent</h2>
				An email has been sent to your email address that contains the link to reset the password.
		</div>
	</div>

	<?php include_once "templates/subscribePanel.php"; ?>
	<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>