<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CHANGED PASSWORD</title>
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
			<div id='fg_membersite_content'>
				<h2>Changed password</h2>
					Your password is updated!
				<p>
				<a href='logout.php'>logout</a>
				</p>
			</div>
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>