<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/loginregisterstyle.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</head>

<body>
	<div class="login-page">
	  <div class="form">
	    <form class="login-form">
	      <label for='firstname'>Username</label>
	      <input type="text" name='username' id='username'/>

	      <label for='firstname'>Password</label>
	      <input type="password" name='password' id='password'/>

	      <button>login</button>
	      <p class="message">Not registered? <a href="newRegister.php">Create an account</a></p>
	    </form>
	  </div>
	</div>
</div>
</body>

</html>