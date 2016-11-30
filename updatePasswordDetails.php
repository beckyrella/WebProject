<?PHP
require_once("./include/membersite_config.php");

if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['submittedpassword']))
{
   if($membersite->UpdatePasswordDetails())
   {
	   //change to update page saying its being updated
       // $membersite->RedirectToURL("thankYou.php");
	   echo "Password Updated Successfully";
   }
}
?>
<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Account Management</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<link rel="stylesheet" type="text/css" href="css/pwdwidget.css" />
<script src="js/gen_validatorv4.js" type="text/javascript"></script>

</head>

<body>
	<div class="container"> 

		<?php include_once "templates/loggedInHeader.php"; ?>         

		<div id="main">
			<input type="text" name="inputText"/>
			<div id='membersite'>
				<?php $userdata = $membersite->GetUserDetails() ?>
				<strong> UPDATE YOUR PASSWORD DETAILS </strong>
				<form id='updatepassworddetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<fieldset >
						<legend>Password Details</legend>
						<input type='hidden' name='submittedpassword' id='submittedpassword' value='1'/>

						<div class='short_explanation'>* required fields</div>
						<input type='text'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />

						<div><span class='pwderror'><?php echo $membersite->GetErrorMessage(); ?></span></div>
						
						<div class='containers'>
							<label for='currentpassword' >Current Password*: </label><br/>
							<input type='text' name='currentpassword' id='currentpassword' value='<?php echo $membersite->SafeDisplay('currentpassword') ?>' maxlength="50" /><br/>
							<span id='update_currentpassword_errorloc' class='pwderror'></span>
						</div>
						<div class='containers'>
							<label for='newpassword' >New Password*: </label><br/>
							<input type='text' name='newpassword' id='newpassword' value='<?php echo $membersite->SafeDisplay('newpassword') ?>' maxlength="50" /><br/>
							<span id='update_newpassword_errorloc' class='pwderror'></span>
						</div>
						<div class='containers'>
							<label for='newpasswordrepeat' >Confirm New Password*: </label><br/>
							<input type='text' name='newpasswordrepeat' id='newpasswordrepeat' value='<?php echo $membersite->SafeDisplay('newpasswordrepeat') ?>' maxlength="50" /><br/>
							<span id='update_newpasswordrepeat_errorloc' class='pwderror'></span>
						</div>
												
						<div class='containers'>
							<input type='submit' name='Submit' value='Submit' />
						</div>
					</fieldset>
				</form>
			
			
				
			<script type='text/javascript'>
			// <![CDATA[		
				var pwdfrmvalidator  = new Validator("updatepassworddetail");
				pwdfrmvalidator.EnableOnPageErrorDisplay();
				pwdfrmvalidator.EnableMsgsTogether();
				
				pwdfrmvalidator.addValidation("currentpassword","req","Please provide your password");
				pwdfrmvalidator.addValidation("newpassword","req","Please provide a password");
				pwdfrmvalidator.addValidation("newpasswordrepeat","req","Please provide a password");
			// ]]>
			</script>
			
			</div>					
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>