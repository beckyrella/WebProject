<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($membersite->RegisterUser())
   {
        $membersite->RedirectToURL("thankYou.php");
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script> 


<!-- <script src="plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/jquery/jquery.validate.min.js"></script>
<script src="plugins/bootstrapvalidator/bootstrapValidator.js"></script>  -->
<!-- <script src="js/gen_validatorv4.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript">
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script> -->
<script>
$(document).ready(function() {
    $('#register').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            firstname: {
                validators: {
                    notEmpty: {
                        message: 'First name is required'
                    }
                }
            },
            lastname: {
                validators: {
                    notEmpty: {
                        message: 'Last name is required'
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: 'A username is required'
                    },
                    stringLength: {
                        min: 6,
                        message: 'The username must be more than 6 characters long'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email address is required'
                    },
                    emailAddress: {
                        message: 'This is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            }
        }
    });
});
</script>
</head>

<body>
	<div class="login-page">
	  <div class="form">
	    <form class="register-form" id="register" action="<?php echo $membersite->GetSelfScript(); ?>" method="post" accept-charset="UTF-8">

	      <input type='hidden' name='submitted' id='submitted' value='1'/>
	      <input type='text'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />

	      <div><span class='errorinfo'><?php echo $membersite->GetErrorMessage(); ?></span></div><br>

	      <label for='firstname'>First Name</label>
	      <input type="text" name='firstname' id='firstname' value='<?php echo $membersite->SafeDisplay('firstname') ?>' maxlength="50" required/>

	      <label for='firstname'>Last Name</label><br/>
	      <input type="text" name='lastname' id='lastname' value='<?php echo $membersite->SafeDisplay('lastname') ?>' maxlength="70"/>

	      <label for='firstname'>Username</label><br/>
	      <input type="text" name='username' id='username' value='<?php echo $membersite->SafeDisplay('username') ?>' maxlength="50"/>

	      <label for='firstname'>Email Address</label><br/>
	      <input type="text" name='email' id='email' value='<?php echo $membersite->SafeDisplay('email') ?>' maxlength="70"/>
	      <!-- <div><span class='errormetadata' id='register_email_errorloc'><?php// echo $membersite->GetErrorMessage(); ?></span></div> -->

	      <label for='firstname'>Password</label><br/>
	      <input type="password" name='password' id='password' maxlength="50"/>
	      
	      <button type='submit' name='Submit'>Register</button>
	      <p class="message">Already registered? <a href="newLogin.php">Log In</a></p>
	     </form>

	    <!--  <script type='text/javascript'>			
				var frmvalidator  = new Validator("register");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();
				
				frmvalidator.addValidation("firstname","req","Please provide your first name");
				frmvalidator.addValidation("lastname","req","Please provide your last name");
				frmvalidator.addValidation("username","req","Please provide a User name");
				frmvalidator.addValidation("email","req","Please provide your email address");
				frmvalidator.addValidation("email","email","Please provide a valid email address");
				frmvalidator.addValidation("password","req","Please provide a password");
			// ]]>
			</script> -->

	  </div>
	</div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script> -->
</body>

</html>