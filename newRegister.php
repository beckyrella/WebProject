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
	    <form class="register-form">

	      <label for='firstname'>First Name</label>
	      <input type="text" name='firstname' id='firstname' />

	      <label for='firstname'>Last Name</label><br/>
	      <input type="text" name='lastname' id='lastname'/>

	      <label for='firstname'>Username</label><br/>
	      <input type="text" name='username' id='username'/>

	      <label for='firstname'>Email Address</label><br/>
	      <input type="text" name='email' id='email'/>

	      <label for='firstname'>Password</label><br/>
	      <input type="password" name='password' id='password' maxlength="50"/>
	      
	      <button>create</button>
	      <p class="message">Already registered? <a href="newLogin.php">Sign In</a></p>
	  </div>
	</div>
</div>
</body>

</html>