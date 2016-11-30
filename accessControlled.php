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
<title>An access Controlled Page </title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
</head>

<body>
	<div class="container"> 
		<!-- // /* this script should be on everypage that is only 
		// accessible once a user is logged in */ --> 
		<!-- IF LOGGED IN --> 
				  <!-- Header here -->
		<!-- IF LOGGED OUT -->
				  <!-- Alternate Header here -->
		<?php include_once "templates/loggedInHeader.php"; ?>         

		<div id="main">
			<div id='membersite_content'>
				<h2>This is an Access Controlled Page</h2>
				This page can be accessed after logging in only. To make more access controlled pages, 
				copy paste the code between &lt;?php and ?&gt; to the page and name the page to be php.
				<p>
					Logged in as: <?= $membersite->UserFullName() ?>
				</p>
				<p>
				<a href='loginHome.php'>Home</a>
				</p>
			</div>					
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>