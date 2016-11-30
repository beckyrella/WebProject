<?PHP
require_once("./include/membersite_config.php");

if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}
if(isset($_POST['submittedprofile']))
{
	if($membersite->UpdateProfileDetails())
   {
	   //change to update page saying its being updated
       // $membersite->RedirectToURL("thankYou.php");
	   echo "Profile Updated Successfully";
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
			<strong> UPDATE YOUR PROFILE DETAILS </strong>
			<?php $profiledata = $membersite->GetProfileDetails() ?>
				<form id='updateprofiledetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<fieldset >
						<legend>Profile Details</legend>
						<input type='hidden' name='submittedprofile' id='submittedprofile' value='1'/>

						<div class='short_explanation'>* required fields</div>
						<input type='text'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />

						<div><span class='pflerror'><?php echo $membersite->GetErrorMessage(); ?></span></div>
						<div class='containers'>
							<label for='profilename' >Profile Name*: </label><br/>
							<input type='text' name='profilename' id='profilename' value='<?php echo $profiledata['profilename']; ?>' maxlength="250" /><br/>
							<span id='update_profilename_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilemobnum' >Telephone Number*: </label><br/>
							<input type='text' name='profilemobnum' id='profilemobnum' value='<?php echo $profiledata['profilemobnum']; ?>' maxlength="30" /><br/>
							<span id='update_profilemobnum_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profileemail' >Email Address*:</label><br/>
							<input type='text' name='profileemail' id='profileemail' value='<?php echo $profiledata['profileemail']; ?>' maxlength="70" /><br/>
							<span id='update_profileemail_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilehomeadd' >Address*: </label><br/>
							<input type='text' name='profilehomeadd' id='profilehomeadd' value='<?php echo $profiledata['profilehomeadd']; ?>' maxlength="250" /><br/>
							<span id='update_username_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilecity' >City*:</label><br/>
							<input type='text' name='profilecity' id='profilecity' value='<?php echo $profiledata['profilecity']; ?>' maxlength="80" /><br/>
							<span id='update_profilecity_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilestate' >State*:</label><br/>
							<input type='text' name='profilestate' id='profilestate' value='<?php echo $profiledata['profilestate']; ?>' maxlength="80" /><br/>
							<span id='update_profilestate_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilecountry' >Country*:</label><br/>
							<input type='text' name='dob' id='dob' value='<?php echo $profiledata['profilecountry']; ?>' maxlength="70" /><br/>
							<span id='update_profilecountry_errorloc' class='pflerror'></span>
						</div>						
						<div class='containers'>
							<label for='profiledesc' >Description*:</label><br/>
							<input type='text' name='profiledesc' id='profiledesc' value='<?php echo $profiledata['profiledesc']; ?>' maxlength="250" /><br/>
							<span id='update_profiledesc_errorloc' class='pflerror'></span>
						</div>
												
						<div class='containers'>
							<input type='submit' name='Submit' value='Submit' />
						</div>
					</fieldset>
				</form>
			
			</div>					
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>