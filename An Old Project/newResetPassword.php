<?PHP
require_once("./include/membersite_config.php");

$success = false;
if($membersite->ResetPassword())
{
    $success=true;
}

?>
<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/loginregisterstyle.css?d=<?php echo time(); ?>"" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- add logo in here  -->
	<!-- this is the page seen when you click on the link to reset your password -->

	<div class="login-page">
	  	<div class="form">
	  		<?php
				if($success){
				?>
					<div class="texttitle">PASSWORD RESET SUCCESSFUL!</div><br>
					<div class='short_explanation'>Your new password has been sent to your email address.</div>
				<?php
				}else{
				?>
					<div class="texttitle">PASSWORD RESET FAILED!</div><br>
					<div class='short_explanation'><?php echo $membersite->GetErrorMessage(); ?></div>
			<?php
			}
			?>
	  </div>
	</div>
</body>

</html>