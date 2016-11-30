<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($membersite->RegisterUser())
   {
        $membersite->RedirectToURL("thankYou.php");
   }
}
?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register[Sign Up]</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/membersite.css" />
<link rel="stylesheet" type="text/css" href="css/pwdwidget.css" />
<script src="js/gen_validatorv4.js" type="text/javascript"></script>
<script src="js/pwdwidget.js" type="text/javascript"></script>      
</head>

<body>
<div class="container"> 
<!-- IF LOGGED IN --> 
          <!-- Header here -->
<!-- IF LOGGED OUT -->
          <!-- Alternate Header here -->
	<?php include_once "common/loggedOutHeader.php"; ?>         

	<div id="main">
	<!-- Form Code Start -->
		<div id='membersite'>
			<form id='register' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
				<fieldset >
					<legend>Register</legend>
					<input type='hidden' name='submitted' id='submitted' value='1'/>

					<div class='short_explanation'>* required fields</div>
					<input type='text'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />

					<div><span class='error'><?php echo $membersite->GetErrorMessage(); ?></span></div>
					<div class='containers'>
						<label for='name' >First Name*: </label><br/>
						<input type='text' name='firstname' id='firstname' value='<?php echo $membersite->SafeDisplay('firstname') ?>' maxlength="50" /><br/>
						<span id='register_name_errorloc' class='error'></span>
					</div>
					<div class='containers'>
						<label for='name' >Last Name*: </label><br/>
						<input type='text' name='lastname' id='lastname' value='<?php echo $membersite->SafeDisplay('lastname') ?>' maxlength="70" /><br/>
						<span id='register_name_errorloc' class='error'></span>
					</div>
					<div class='containers'>
						<label for='name' >User Name*: </label><br/>
						<input type='text' name='username' id='username' value='<?php echo $membersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
						<span id='register_name_errorloc' class='error'></span>
					</div>
					<div class='containers'>
						<label for='email' >Email Address*:</label><br/>
						<input type='text' name='email' id='email' value='<?php echo $membersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
						<span id='register_email_errorloc' class='error'></span>
					</div>
					<div class='containers' style='height:80px;'>
						<label for='password' >Password*:</label><br/>
						<div class='pwdwidgetdiv' id='thepwddiv' ></div>
							<noscript>
								<input type='password' name='password' id='password' maxlength="50" />
							</noscript>    
						<div id='register_password_errorloc' class='error' style='clear:both'></div>
					</div>
					
					<div class='containers'>
						<input type='submit' name='Submit' value='Submit' />
					</div>
				</fieldset>
			</form>
			
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[
				var pwdwidget = new PasswordWidget('thepwddiv','password');
				pwdwidget.MakePWDWidget();
				
				var frmvalidator  = new Validator("register");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();
				
				frmvalidator.addValidation("firstname","req","Please provide your first name");
				frmvalidator.addValidation("lastname","req","Please provide your last name");
				frmvalidator.addValidation("username","req","Please provide a User name");
				frmvalidator.addValidation("email","req","Please provide your email address");
				frmvalidator.addValidation("email","email","Please provide a valid email address");
				frmvalidator.addValidation("password","req","Please provide a password");
			// ]]>
			</script>

			<!--
			Form Code End (see html-form-guide.com for more info.)
			-->
		</div>
	</div>

	<?php include_once "common/subscribePanel.php"; ?>
	<?php include_once "common/footer.php"; ?>
</div>
</body>

</html>