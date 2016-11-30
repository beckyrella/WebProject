<?PHP
require_once("./include/membersite_config.php");

if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if($membersite->ChangePassword())
   {
        $membersite->RedirectToURL("changedPassword.php");
   }
}

?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CHANGE PASSWORD</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css" />
<script type='text/javascript' src='js/gen_validatorv31.js'></script>
<link rel="stylesheet" type="text/css" href="css/pwdwidget.css" />
<script src="js/pwdwidget.js" type="text/javascript"></script>       
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
				<form id='changepwd' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<fieldset >
						<legend>Change Password</legend>

						<input type='hidden' name='submitted' id='submitted' value='1'/>

						<div class='short_explanation'>* required fields</div>

						<div><span class='error'><?php echo $membersite->GetErrorMessage(); ?></span></div>
						<div class='containers'>
							<label for='oldpwd' >Old Password*:</label><br/>
							<div class='pwdwidgetdiv' id='oldpwddiv' ></div><br/>
							<noscript>
							<input type='password' name='oldpwd' id='oldpwd' maxlength="50" />
							</noscript>    
							<span id='changepwd_oldpwd_errorloc' class='error'></span>
						</div>

						<div class='containers'>
							<label for='newpwd' >New Password*:</label><br/>
							<div class='pwdwidgetdiv' id='newpwddiv' ></div>
							<noscript>
							<input type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
							</noscript>
							<span id='changepwd_newpwd_errorloc' class='error'></span>
						</div>

					<br/><br/><br/>
					<div class='containers'>
						<input type='submit' name='Submit' value='Submit' />
					</div>
				</fieldset>
			</form>
			
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[
				var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
				pwdwidget.enableGenerate = false;
				pwdwidget.enableShowStrength=false;
				pwdwidget.enableShowStrengthStr =false;
				pwdwidget.MakePWDWidget();
				
				var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
				pwdwidget.MakePWDWidget();
				
				
				var formvalidator  = new Validator("changepwd");
				formvalidator.EnableOnPageErrorDisplay();
				formvalidator.EnableMsgsTogether();

				formvalidator.addValidation("oldpwd","req","Please provide your old password");				
				formvalidator.addValidation("newpwd","req","Please provide your new password");

			// ]]>
			</script>

			<p>
			<a href='loginHome.php'>Home</a>
			</p>

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