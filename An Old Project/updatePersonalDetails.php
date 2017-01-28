<?PHP
require_once("./include/membersite_config.php");

if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if($membersite->UpdatePersonalDetails())
   {
	   //change to update page saying its being updated
        //$membersite->RedirectToURL("thankYou.php");
		echo "Personal Details Updated";
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
				<strong> UPDATE YOUR PERSONAL DETAILS </strong>
				
				<form id='updatepersonaldetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<fieldset >
						<legend>Personal Details</legend>
						<input type='hidden' name='submitted' id='submitted' value='1'/>

						<div class='short_explanation'>* required fields</div>
						<input type='text'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />

						<div><span class='error'><?php echo $membersite->GetErrorMessage(); ?></span></div>
						<div class='containers'>
							<label for='firstname' >First Name*: </label><br/>
							<input type='text' name='firstname' id='firstname' value='<?php echo $userdata['firstname']; ?>' maxlength="50" /><br/>
							<span id='update_firstname_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='lastname' >Last Name*: </label><br/>
							<input type='text' name='lastname' id='lastname' value='<?php echo $userdata['lastname']; ?>' maxlength="70" /><br/>
							<span id='update_lastname_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='username' >User Name*: </label><br/>
							<input type='text' name='username' id='username' value='<?php echo $userdata['username']; ?>' maxlength="50" /><br/>
							<span id='update_username_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='sex' >Gender:</label><br/>
							<input type='text' name='sex' id='sex' value='<?php echo $userdata['sex']; ?>' maxlength="50" /><br/>
							<span id='update_sex_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='dob' >Date of birth*:</label><br/>
							<input type='text' name='dob' id='dob' value='<?php echo $userdata['dateofbirth']; ?>' maxlength="50" /><br/>
							<span id='update_dob_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='mobilenumber' >Mobile Number*:</label><br/>
							<input type='text' name='mobilenumber' id='mobilenumber' value='<?php echo $userdata['mobilenumber']; ?>' maxlength="50" /><br/>
							<span id='update_mobilenumber_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='address' >House Address*:</label><br/>
							<input type='text' name='address' id='address' value='<?php echo $userdata['address']; ?>' maxlength="50" /><br/>
							<span id='update_address_errorloc' class='error'></span>
						</div>
						<div class='containers'>
							<label for='email' >Email Address*:</label><br/>
							<input type='text' name='email' id='email' value='<?php echo $userdata['email']; ?>' maxlength="50" /><br/>
							<span id='update_email_errorloc' class='error'></span>
						</div>
												
						<div class='containers'>
							<input type='submit' name='Submit' value='Submit' />
						</div>
					</fieldset>
				</form>
			
			<script type='text/javascript'>
			// <![CDATA[		
				var frmvalidator  = new Validator("updatepersonaldetail");
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
			
			</div>					
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>