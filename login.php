<?PHP
require_once("include/membersite_config.php");
if(isset($_POST['submitted']))
{
   if($membersite->Login())
   {
   		$membersite->RedirectToURL("dashboard.php");
   }
   else
   {
   	  // echo "<script type=\"text/javascript\">
		    //         var e = document.getElementById('errorinfossss'); e.hide();
		    //         </script>";  
		// echo "<script type=\"text/javascript\">$('#errorinfo').hide()</script>";
   }
}
?>
<!DOCTYPE html>
<html class="login-html">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>BusyBodies - Profile</title>	

		<meta name="keywords" content="BusyBodies" />
		<meta name="description" content="BusyBodies - Profile">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/skin-corporate-6.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

		<script type=\"text/javascript\">

			$('#errorinfo').hide();

		</script>

	</head>
	<body >

		<div class="body register">
			<div role="main" class="main">
				
				<section class="account">

					<div class="container">
						<div class="row">
		              	<div class="col-md-12">
		              	<div class="center logo-login">
		                	<img alt="BusyBodies" width="" height="48" src="img/logo.png">
		              	</div>
		                <div class="panel panel-default login-form ">
		                  <!-- Default panel contents -->
			                <div class="panel-body ">			                      
			                     <h2 class="">Login</h2>
			                     
			                     <div class="alert alert-danger alert-dismissible" id="dismissableerror" role="alert">
				                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                      <strong>Alert!</strong> Wrong email address or password.
			                    </div>
			                   
			                    <form id='login' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>

			                    	<input type='hidden' name='submitted' id='submitted' value='1'/>
			                    	<div><span class='errorinfo' id='errorinfo'><?php echo $membersite->GetErrorMessage(); ?></span></div><br>

				                    <div class="form-group">
				                      <label class="control-label" for="username">Username</label>
				                      <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Username">
				                    </div>
				                    <div class="form-group has-error">
				                      <a class="pull-right" href="resetPasswordRequest.php">(Forgot Password?)</a>
				                      <label class="control-label" for="password">Password</label>
				                      <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password">
				                    </div>
				                    <div class="checkbox">
				                      <label>
				                        <input type="checkbox"> Remember me
				                      </label>
				                    </div>
				                    <button type="submit" name='Submit' class="btn btn-sec btn-lg btn-block">Login</button>
				                    <p class="question center">Don't have an account? <a class="" href="signup.php">Create an Account</a>
			                  	</form>

			                </div> <!-- End Profile head-->
			       
		                  </div>                     
		                    
		                </div>
		              </div>

							</div>
		          
		          	</div>
				</section>

		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="vendor/jquery.validation/jquery.validation.js"></script>
		<script src="vendor/jquery.stellar/jquery.stellar.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.js"></script>
		<script src="vendor/jquery.lazyload/jquery.lazyload.js"></script>
		<script src="vendor/isotope/jquery.isotope.js"></script>
		<script src="vendor/owl.carousel/owl.carousel.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/vide/vide.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->
     
     	<script>
	  
	$(document).ready(function () {
    	$('#myTabs a').click(function (e) {
		      e.preventDefault()
		      $(this).tab('show')
    	})   
     });

    </script>

	</body>
</html>
