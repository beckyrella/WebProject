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
	    <form class="login-form" id='login' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>

	      <input type='hidden' name='submitted' id='submitted' value='1'/>
	      <div><span class='errorinfo' id='errorinfo'><?php echo $membersite->GetErrorMessage(); ?></span></div><br>
	      
	      <label for='firstname'>Username</label>
	      <input type="text" name='username' id='username'/>
	    
	      <label for='firstname'>Password</label>
	      <input type="password" name='password' id='password'/>
	    
	      <button>login</button>
	      <p class="message">Not registered? <a href="newRegister.php">Create an account</a></p>
	    </form>	    
	  </div>
	</div>

	<script type='text/javascript'>
		var formvalidator  = new Validator("login");
		formvalidator.EnableOnPageErrorDisplay();
		formvalidator.EnableMsgsTogether();
		formvalidator.addValidation("username","req","Username Required");
		formvalidator.addValidation("password","req","Password Required");
	</script>

</body>

</html>