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
<title>Home Page[logged IN]</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
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
			<h2>Home Page</h2>
			 Welcome back <?= $membersite->UserFullName(); ?>!

			<p><a href='changePassword.php'>Change password</a></p>

			<p><a href='accessControlled.php'>A sample 'members-only' page</a></p>
			<br><br><br>
			<p><a href='logout.php'>Logout</a></p>
		</div>
	</div>

	<?php include_once "templates/subscribePanel.php"; ?>
	<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>