<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Page TRIAL</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>
	<div class="container"> 
		<!-- IF LOGGED IN --> 
				  <!-- Header here -->
		<!-- IF LOGGED OUT -->
				  <!-- Alternate Header here -->
		<?php include_once "templates/loggedInHeader.php"; ?>         
	
		<div id="main">
			<div id='membersite_content'>
				<h2>Membership website TRAIL</h2>
				
				<ul>
				<li><a href='register.php'>Register</a></li>
				<li><a href='confirmRegistration.php'>Confirm registration</a></li>
				<li><a href='login.php'>Login</a></li>
				<li><a href='accessControlled.php'>A sample member's only page</a></li>
				<li><a href='accountManagement.php'>Account Management</a></li>
				<li><a href='sampledropdown.php'>SAMPLE Drop Down List</a></li>				
				</ul>
			</div>
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>