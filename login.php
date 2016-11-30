<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($membersite->Login())
   {
        $membersite->RedirectToURL("loginHome.php");
   }
}
?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
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
			<!-- Form Code Start -->
			<div id='membersite'>
				<form id='login' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<fieldset >
						<legend>Login</legend>

						<input type='hidden' name='submitted' id='submitted' value='1'/>
						<div class='short_explanation'>* required fields</div>

						<div><span class='error'><?php echo $membersite->GetErrorMessage(); ?></span></div>
						<div class='containers'>
							<label for='username' >UserName*:</label><br/>
							<input type='text' name='username' id='username' value='<?php echo $membersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
							<span id='login_username_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='password' >Password*:</label><br/>
							<input type='password' name='password' id='password' maxlength="50" /><br/>
							<span id='login_password_errorloc' class='error'></span>
						</div>

						<div class='containers'>
							<input type='submit' name='Submit' value='Submit' />
						</div>
						<div class='short_explanation'><a href='resetPasswordRequest.php'>Forgot Password?</a></div>
					</fieldset>
				</form>
				
				<!-- client-side Form Validations:
				Uses the excellent form validation script from JavaScript-coder.com-->

				<script type='text/javascript'>
				// <![CDATA[

					var formvalidator  = new Validator("login");
					formvalidator.EnableOnPageErrorDisplay();
					formvalidator.EnableMsgsTogether();

					formvalidator.addValidation("username","req","Please provide your username");
					formvalidator.addValidation("password","req","Please provide the password");

				// ]]>
				</script>
			</div>
				
		</div>
		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>