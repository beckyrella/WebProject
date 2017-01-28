<?PHP
require_once("./include/membersite_config.php");

$emailsent = false;
if(isset($_POST['submitted']))
{
   if($membersite->EmailResetPasswordLink())
   {
        $membersite->RedirectToURL("resetPasswordLinkSent.php");
        exit;
   }
}
?>
<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RESET PWD RQST</title>
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
	
		<!-- Form Code Start -->
		<div id='membersite'>
			<form id='resetreq' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
				<fieldset >
					<legend>Reset Password</legend>

					<input type='hidden' name='submitted' id='submitted' value='1'/>

					<div class='short_explanation'>* required fields</div>

					<div><span class='error'><?php echo $membersite->GetErrorMessage(); ?></span></div>
					<div class='containers'>
						<label for='username' >Your Email*:</label><br/>
						<input type='text' name='email' id='email' value='<?php echo $membersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
						<span id='resetreq_email_errorloc' class='error'></span>
					</div>
					<div class='short_explanation'>A link to reset your password will be sent to the email address</div>
					<div class='containers'>
						<input type='submit' name='Submit' value='Submit' />
					</div>
				</fieldset>
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[

				var formvalidator  = new Validator("resetreq");
				formvalidator.EnableOnPageErrorDisplay();
				formvalidator.EnableMsgsTogether();

				formvalidator.addValidation("email","req","Please provide the email address used to sign-up");
				formvalidator.addValidation("email","email","Please provide the email address used to sign-up");

			// ]]>
			</script>
		</div>
		<!--
		Form Code End (see html-form-guide.com for more info.)
		-->	
	</div>

	<?php include_once "templates/subscribePanel.php"; ?>
	<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>