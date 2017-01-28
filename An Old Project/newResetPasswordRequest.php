<?PHP
require_once("./include/membersite_config.php");

$emailsent = false;
if(isset($_POST['submitted']))
{
   if($membersite->EmailResetPasswordLink())
   {
        $membersite->RedirectToURL("newResetPasswordLinkSent.php");
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
<link href="css/loginregisterstyle.css?d=<?php echo time(); ?>"" rel="stylesheet" type="text/css">
<script type="text/javascript">
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</head>

<body>
	<!-- add logo in here  -->

	<div class="login-page">
	  <div class="form">
	    <form class="login-form" id='resetpassword' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>

	      <input type='hidden' name='submitted' id='submitted' value='1'/>

		  <div>RESET PASSWORD </div>

	      <div><span class='errorinfo' id='errorinfo'><?php echo $membersite->GetErrorMessage(); ?></span></div><br>
	      
	      <label for='email'>Email Address</label>
	      <input type="text" name='email' id='email'/>
	    
	      <div class='short_explanation'>Instructions to reset your password will be sent to this email address</div><br>

	      <button type='submit' name='Submit'>Reset Password</button>
	      
	    </form>	    
	  </div>
	</div>

	<script type='text/javascript'>
		var formvalidator  = new Validator("resetpassword");
		formvalidator.EnableOnPageErrorDisplay();
		formvalidator.EnableMsgsTogether();

		formvalidator.addValidation("email","req","Please provide the email address used to sign-up");
		formvalidator.addValidation("email","email","Please provide the email address used to sign-up");

	</script>

</body>

</html>