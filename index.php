<?PHP

require_once("include/membersite_config.php");
require_once("include/DbConfig.php");

?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>BusyBodies - Homepage</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="BusyBodies - Homepage">
		<meta name="author" content="okler.net">

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
		<link rel="stylesheet" href="vendor/rs-plugin/css/layers.css" media="screen">
		<link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/skin-corporate-6.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

	</head>
	<body>

		<div class="body">
			<!-- check whether logged in or not and decide on header to display -->
			<?php 

			if(!$membersite->CheckLogin())			{
			    include_once "template/loggedOutHeader.php";
			}
			else{
				include_once "template/loggedInHeader.php";
			}
			

			 ?>

			<div role="main" class="main">
				<div class="slider-container rev_slider_wrapper">
					<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 440}'>
						<ul>
							<li data-transition="fade">
								<img src="img/slides/slide-corporate-7.jpg"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">	
							</li>
							<li data-transition="fade">
								<img src="img/slides/slide-corporate-8.jpg"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">
							</li>
						</ul>
					</div>
				</div>
				
				
				<section class="section ">
					<div class="container">
						<!--<div class="row">
							<div class="col-md-12 center">
								<h2 class="heading-dark">Our Services</h2>
							</div>
						</div>-->

						<div class="row">
							<div class="col-md-3 center">
                <a href="index-classic.html" class="text-decoration-none block-link pt-md">
                  <img class="img-responsive img-rounded mb-lg" src="img/projects/project.jpg" alt="Project Image">
                  <h4 class="mb-xs">Home Classic Original</h4>
                  <p class=" line-height-xs">Here's a one line description</p>
                 </a>
              </div>
              <div class="col-md-3 center">
                <a href="index-classic.html" class="text-decoration-none block-link pt-md">
                  <img class="img-responsive img-rounded mb-lg" src="img/projects/project.jpg" alt="Project Image">
                  <h4 class="mb-xs">Home Classic Original</h4>
                  <p class=" line-height-xs">Here's a one line description</p>
                 </a>
              </div>
              <div class="col-md-3 center">
                <a href="index-classic.html" class="text-decoration-none block-link pt-md">
                  <img class="img-responsive img-rounded mb-lg" src="img/projects/project.jpg" alt="Project Image">
                  <h4 class="mb-xs">Home Classic Original</h4>
                  <p class=" line-height-xs">Here's a one line description</p>
                 </a>
              </div>
              <div class="col-md-3 center">
                <a href="index-classic.html" class="text-decoration-none block-link pt-md">
                  <img class="img-responsive img-rounded mb-lg" src="img/projects/project.jpg" alt="Project Image">
                  <h4 class="mb-xs">Home Classic Original</h4>
                  <p class=" line-height-xs">Here's a one line description</p>
                 </a>
              </div>

					</div>
				</section>
        
				<section class="section section-tertiary section-no-border mt-none">
					<div class="container">
						<div class="row">
							<div class="col-md-12 center">
								<h1 class="heading-dark mb-sm">What We Do</h1>
                <p class="lead">Trusted by over 19,000 satisfied users, BusyBodies is a huge success<br>in the of one of the world’s largest MarketPlace.</p>
							</div>
						</div>
						
            <div class="row">
							<div class="col-md-4">
								<div class="featured-box featured-box-primary featured-box-effect-7">
									<div class="box-content">
										<i class="icon-featured fa fa-user"></i>
										<h4>Loved by Customers</h4>
										<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="featured-box featured-box-secondary featured-box-effect-7" >
									<div class="box-content">
										<i class="icon-featured fa fa-book"></i>
										<h4>Well Documented</h4>
										<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="featured-box featured-box-tertiary featured-box-effect-7" >
									<div class="box-content">
										<i class="icon-featured fa fa-trophy"></i>
										<h4>Winner</h4>
										<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
									</div>
								</div>
							</div>
              
						</div>
            
					</div>
				</section>
				
				
				<div class="container">
					<div class="row">
						<div class="col-md-12 center">
							<div class="owl-carousel owl-theme mt-xl" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
								<div>
									<img class="img-responsive" src="img/logos/logo-1.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-2.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-3.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-4.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-5.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-6.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-4.png" alt="">
								</div>
								<div>
									<img class="img-responsive" src="img/logos/logo-2.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
 
			<?php include_once "template/footer.php"; ?>
      
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
		<script src="js/views/view.home.js"></script>
		
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
      console.log('fgh');
      $(document).ready(function () {
      var menu = $('#home-intro');
      var origOffsetY = menu.offset().top;
    
      function scroll() {
        if ($(window).scrollTop() >= origOffsetY) {

        $('.intro').addClass('sticky');
        $('.intro').addClass('sticky-active');
          //$('.content').addClass('menu-padding');
        } else {

        $('.intro').removeClass('sticky');	
        $('.intro').removeClass('sticky-active');
          //$('.content').removeClass('menu-padding');
        }	
      }
      document.onscroll = scroll;
      });

    </script>
	</body>
</html>
