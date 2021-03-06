<?PHP
require_once("include/membersite_config.php");
require_once("include/DbConfig.php");

if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if($membersite->UpdatePersonalDetails())
   {
     //change to update page saying its being updated
        //$membersite->RedirectToURL("thankYou.php");
    echo "Personal Details Updated";
   }
}

// saving profile deetss
$profiledata = $membersite->GetProfileDetails();
if(isset($_POST['submittedprofile']))
{
   if($membersite->UpdateProfileDetails())
   {
     //change to update page saying its being updated
       // $membersite->RedirectToURL("thankYou.php");
     echo "Profile Updated Successfully";
   }
}

if(isset($_POST['submittedpassword']))
{
   if($membersite->UpdatePasswordDetails())
   {
     //change to update page saying its being updated
       // $membersite->RedirectToURL("thankYou.php");
     echo "Password Updated Successfully";
   }
}
?>
<!DOCTYPE html>
<html>
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

    <!-- //mine -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- end -->
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
	<body data-spy="scroll" data-target=".navbar1" data-offset="50">

		<div class="body profile-body">

    <?php include_once "template/loggedInHeader.php"; ?>

			<div role="main" class="main">
				
				<div class="semi-header" >
					<div class="container ">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="testerautocomplete.php">Profile</a></li>
              <li class="active">My Account</li>
            </ol>
					</div>
				</div>
				
				<section class="account">

					<div class="container">
						<div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <div class="panel-body ">
                    
                    <div class="row">
                      <div class="col-sm-3 no-padding border-right" style="height: 500px;">
                        <ul id="myTabs" class="nav nav-pills nav-stacked" role="tablist">
                          <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">Account Details</a></li>
                          <li role="presentation"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Profile Details</a></li>
                          <li role="presentation"><a href="#password" aria-controls="personal" role="tab" data-toggle="tab">Password</a></li>
                          <li role="presentation"><a href="#deactivate" aria-controls="personal" role="tab" data-toggle="tab">Deactivate</a></li>
                        </ul>
                      </div>
                      
                      <div class="col-sm-9 ">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="account">
                          <h1>My Personal Details</h1>
                          <?php $userdata = $membersite->GetUserDetails() ?>
                          <form class="form-horizontal" id='updatepersonaldetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='  UTF-8'>

                            <input type='hidden' name='submitted' id='submitted' value='1'/>
                            <input type='hidden'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />
                            <div><span class='pflerror'><?php echo $membersite->GetErrorMessage(); ?></span></div>

                            <div class="form-group">
                              <label for="firstname" class="col-sm-3 control-label">First Name*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value='<?php echo $userdata['firstname']; ?>' maxlength="50">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="lastname" class="col-sm-3 control-label">Last Name*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value='<?php echo $userdata['lastname']; ?>' maxlength="70">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="dob" class="col-sm-3 control-label">Date of Birth*</label>
                              <div class="col-sm-7">
                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Birthdate" value='<?php echo $userdata['dateofbirth']; ?>' maxlength="50" >
                              </div>
                            </div>
                             <div class="form-group">
                              <label for="sex" class="col-sm-3 control-label">Gender*</label>
                              <div class="col-sm-7">
                                 <input type="radio" name="sex" id="sex"  <?php if (isset($userdata['sex']) && $userdata['sex']==1) echo "checked";?> value="1"> Female 
                                <input type="radio" name="sex" id="sex" <?php if (isset($userdata['sex']) && $userdata['sex']==2) echo "checked";?> value="2">Male
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="username" class="col-sm-3 control-label">Username*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value='<?php echo $userdata['username']; ?>' maxlength="50" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="email" class="col-sm-3 control-label">Email Address*</label>
                              <div class="col-sm-7">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value='<?php echo $userdata['email']; ?>' maxlength="50" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="mobilenumber" class="col-sm-3 control-label">Mobile Number*</label>
                              <div class="col-sm-7">
                                <input type="number" class="form-control" name="mobilenumber" id="mobilenumber" placeholder="080xxxxxxxx" value='<?php echo $userdata['mobilenumber']; ?>' pattern="[0-9]{11}" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="address" class="col-sm-3 control-label">Address*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value='<?php echo $userdata['address']; ?>' maxlength="250" >
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="city" class="col-sm-3 control-label">City*</label>
                              <div class="col-sm-7">
                                <select type="text" class="form-control" name="usercity" id="usercity" placeholder="City">
                                  <option selected="selected" value="">--Select City--</option>
                                  <?php 
                                  $isprofile = false;
                                    if(!$membersite->FetchAllCities($isprofile))
                                    { 
                                      echo '<script type="text/javascript">alert("ERROR");</script>';
                                    }                           
                                  ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="state" class="col-sm-3 control-label">State*</label>
                            <div class="col-sm-7">
                            <select type="text" class="form-control" name="userstate" id="userstate" placeholder="State">
                                <option selected="selected" value="">--Select your State--</option>
                            </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="country" class="col-sm-3 control-label">Country*</label>
                            <div class="col-sm-7">
                            <select type="text" class="form-control" name="usercountry" id="usercountry" placeholder="City">
                               <option selected="selected" value="">--Select your Country--</option>
                            </select>
                            </div>
                          </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="submit" class="btn btn-sec">Update</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        
                        <div role="tabpanel" class="tab-pane fade" id="personal">
                          <h1>My Profile Info</h1>
                          <form class="form-horizontal" id='updateprofiledetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='  UTF-8'>

                            <input type='hidden' name='submittedprofile' id='submittedprofile' value='1'/>
                            <input type='hidden'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />
                            <div><span class='pflerror'><?php echo $membersite->GetErrorMessage(); ?></span></div>

                            <div class="form-group">
                              <label for="profilename" class="col-sm-3 control-label">Name*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="profilename" id="profilename" placeholder="Business Name" value='<?php echo $profiledata['profilename']; ?>' maxlength="50">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="profilemobnum" class="col-sm-3 control-label">Mobile Number*</label>
                              <div class="col-sm-7">
                                <input type="number" class="form-control" name="profilemobnum" id="profilemobnum" placeholder="Last Name" value='<?php echo $profiledata['profilemobnum']; ?>'  pattern="[0-9]{11}" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="profileemail" class="col-sm-3 control-label">Email Address*</label>
                              <div class="col-sm-7">
                                <input type="email" class="form-control" name="profileemail" id="profileemail" placeholder="Email Address" value='<?php echo $profiledata['profileemail']; ?>' maxlength="50" >
                              </div>
                            </div>
                              <div class="form-group">
                              <label for="profilehomeadd" class="col-sm-3 control-label">Address*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="profilehomeadd" id="profilehomeadd" placeholder="Business Address" value='<?php echo $profiledata['profilehomeadd']; ?>' maxlength="150" >
                              </div>
                            </div>
                            <!-- //working on  -->
                            <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">City*</label>
                            <div class="col-sm-7">
                              <select type="text" class="form-control" name="profilecity" id="profilecity" placeholder="City">
                                <option selected="selected">--Select City--</option>
                                <?php 
                                  $isprofile = true;
                                  if(!$membersite->FetchAllCities($isprofile))
                                  { 
                                    echo '<script type="text/javascript">alert("ERROR");</script>';
                                  } 
                                ?>
                            </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="state" class="col-sm-3 control-label">State*</label>
                            <div class="col-sm-7">
                            <select type="text" class="form-control" name="profilestate" id="profilestate" placeholder="City">
                                <option selected="selected">--Select State--</option>
                            </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="country" class="col-sm-3 control-label">Country*</label>
                            <div class="col-sm-7">
                            <select type="text" class="form-control" name="profilecountry" id="profilecountry" placeholder="City">
                               <option selected="selected">--Select Country--</option>
                            </select>
                            </div>
                          </div>

                           <div class="form-group">
                              <label for="profiledesc" class="col-sm-3 control-label">About you*</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="profiledesc" id="profiledesc" placeholder="Description of your services" value='<?php echo $profiledata['profiledesc']; ?>' maxlength="250" rows="5" cols="50">
                              </div>
                            </div>
                    
                            
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-sec" name='Submit'>Update</button>
                              </div>
                            </div>
                          </form>
                        </div>


                        
                        <div role="tabpanel" class="tab-pane fade" id="password">
                          <h1>Change Password</h1>
                          <form class="form-horizontal" id='updatepassworddetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
                          
                            <input type='hidden' name='submittedpassword' id='submittedpassword' value='1'/>
                            <input type='hidden'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />


                            <div class="form-group">
                              <label for="currentpassword" class="col-sm-3 control-label">Current Password*</label>
                              <div class="col-sm-7">
                                <input type="password" class="form-control" name="currentpassword" id="currentpassword" value='<?php echo $membersite->SafeDisplay('currentpassword')?>' maxlength="50">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="newpassword" class="col-sm-3 control-label">New Password*</label>
                              <div class="col-sm-7">
                                <input type="password" class="form-control" name="newpassword" id="newpassword" value='<?php echo $membersite->SafeDisplay('newpassword') ?>' maxlength="50">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="newpasswordrepeat" class="col-sm-3 control-label">Confirm New Password*</label>
                              <div class="col-sm-7">
                                <input type="password" class="form-control" name="newpasswordrepeat" id="newpasswordrepeat"  value='<?php echo $membersite->SafeDisplay('newpasswordrepeat') ?>' maxlength="50">
                              </div>
                            </div>

                            
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name='Submit' class="btn btn-sec">Change Password</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="deactivate">
                          <h1>Deactivate</h1>
                        </div>
                      </div>
                                         
                      </div>

                    </div> <!-- End Profile head-->
       
                  </div>                     
                    
                </div>
              </div>

					</div>
          
          </div>
				</section>
			
	
    <?php include_once "template/footer.php"; ?>
			
		</div>

		<!-- Vendor -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<!-- <script src="vendor/jquery/jquery.js"></script> -->
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

     <!-- //hi -->




    <script type="text/javascript">
        function profileLocationFunction() {
              var id=$(this).val();
              var dataString = id;

            $.ajax
              ({
                type: "GET",
                url: "locationautocomplete.php",
                dataType:'json',
                data: {datatext: dataString, type: 'cityselect'},
                cache: false,
                success: function(data) { 
                  $('#profilestate').html(data.message1); 
                  $('#profilecountry').html(data.message2);        
                },
                error: function(xhr, status, error) { alert("Hello! ERROR!" + error); }
              });

        }

        function userLocationFunction() {
                var id = $(this).val();
                var dataString = id;
                $.ajax({
                  type: "GET",
                  url: "locationautocomplete.php",
                  dataType: 'json',
                  data: { datatext: dataString, type: 'cityselect' },
                  cache: false,
                  success: function(data) {
                    $('#userstate').html(data.message1);
                    $('#usercountry').html(data.message2);
                  },
                  error: function(xhr, status, error) { alert("Hello! ERROR!" + error);
                  }
                });
        }


        $(document).ready(function() {
               $('#usercity').change(userLocationFunction).change();
               $('#profilecity').change(profileLocationFunction).change();

        });

    </script>

    <script>
	  
  	  $(document).ready(function () {
  		var menu = $('.member-since');
  		var origOffsetY = menu.offset().top;
      $('.hidden_header').addClass('hidden');
  	
  		function scroll() {
  		  if ($(window).scrollTop() >= origOffsetY) {
  			$('.hidden_header').removeClass('hidden');
        $('#header').addClass('hidden');
  			$('.hidden_header').addClass('sticky');
  			  //$('.content').addClass('menu-padding');
  		  } else {
  			$('.hidden_header').addClass('hidden');
  			$('.always_active').addClass('active');
        $('#header').removeClass('hidden');
  			$('.hidden_header').removeClass('sticky');	
  			  //$('.content').removeClass('menu-padding');
  		  }	
  		}
  		document.onscroll = scroll;
      
      $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      })
      
      });

    </script>

	</body>
</html>
