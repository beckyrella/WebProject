<?PHP
require_once("./include/membersite_config.php");

if(isset($_GET['code']))
{
   if($membersite->ConfirmUser())
   {
        $membersite->RedirectToURL("thankYouRegistered.php");
   }
}
?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Confirm Registration</title>
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
	
		<h2>Confirm registration</h2>
		<p>Please enter the confirmation code in the box below</p>

		<!-- Form Code Start -->
		<div id='membersite'>
			<form id='confirm' action='<?php echo $membersite->GetSelfScript(); ?>' method='get' accept-charset='UTF-8'>
				<div class='short_explanation'>* required fields</div>
				<div><span class='error'><?php echo $membersite->GetErrorMessage(); ?></span></div>
				<div class='containers'>
					<label for='code' >Confirmation Code:* </label><br/>
					<input type='text' name='code' id='code' maxlength="50" /><br/>
					<span id='register_code_errorloc' class='error'></span>
				</div>
				<div class='containers'>
					<input type='submit' name='Submit' value='Submit' />
				</div>
			</form>
		
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[
				var formvalidator  = new Validator("confirm");
				formvalidator.EnableOnPageErrorDisplay();
				formvalidator.EnableMsgsTogether();
				formvalidator.addValidation("code","req","Please enter the confirmation code");
			// ]]>
			</script>		
		</div>		
	</div>

	<?php include_once "templates/subscribePanel.php"; ?>
	<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>