<?PHP
require_once("./include/membersite_config.php");

if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}
?>
<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Account Settings</title>
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
		<div id='membersite_content'>
			<h2>Membership website TRAIL</h2>
			
			<ul>
				<li><a href='updatePersonalDetails.php'>Update Personal Details</a></li>
				<li><a href='updatePasswordDetails.php'>Update Password Details</a></li>
				<li><a href='updateProfileDetails.php'>Update Profile Details</a></li>		
			</ul>
		</div>
	</div>

	<?php include_once "templates/subscribePanel.php"; ?>
	<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>