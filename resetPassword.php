<?PHP
require_once("./include/membersite_config.php");

$success = false;
if($membersite->ResetPassword())
{
    $success=true;
}

?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RESET PASSWORD</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
			<div id='membersite'>
				<?php
					if($success){
					?>
						<h2>Your password has been reset successfully</h2>
						Your new password has been sent to your email address.
					<?php
					}else{
					?>
						<h2>Error</h2>
						<span class='error'><?php echo $membersite->GetErrorMessage(); ?></span>
				<?php
				}
				?>
			</div>
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>