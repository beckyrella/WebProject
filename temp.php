<?PHP
require_once("include/membersite_config.php");

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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- <script>
      $( function() {
        var availableTags = [
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
        ];
        $( "#profilecity" ).autocomplete({
          source: availableTags
        });
      } );
      </script> -->

  </head>
  <body data-spy="scroll" data-target=".navbar1" data-offset="50">
              <!-- <div class="ui-widget">
                <label for="tags">Tags: </label>
                <input id="tags">
              </div> -->
               
                <div class="col-sm-9 ">
                    <h1>My Profile Info</h1>
                    <form class="form-horizontal" id='updateprofiledetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='get' accept-charset='  UTF-8'>

                    <input type='hidden' name='submittedprofile' id='submittedprofile' value='1'/>
                    <input type='hidden'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />
                    <div><span class='pflerror'><?php echo $membersite->GetErrorMessage(); ?></span></div>

                    <div class="form-group">
                      <label for="profilename" class="col-sm-3 control-label">Name*</label>
                      <div class="col-sm-7">
                      <input type="text" class="form-control" name="profilename" id="profilename" placeholder="Business Name" value='<?php echo $profiledata['profilename']; ?>' maxlength="50">
                      </div>
                    </div>
                    <!-- //working on  -->
                     <div class="form-group">
                      <label for="city" class="col-sm-3 control-label">City*</label>
                      <div class="col-sm-7">
                      <input type="hidden" name="profileselectedcityid" id="profileselectedcityid" value=''/>
                      <input type="text" class="form-control" name="profilecity" id="profilecity" placeholder="City">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="state" class="col-sm-3 control-label">State*</label>
                      <div class="col-sm-7">
                      <input type="hidden" name="profileselectedstateid" id="profileselectedstateid" value=''/>
                      <input type="text" class="form-control" name="profilestate" id="profilestate" placeholder="State">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="country" class="col-sm-3 control-label">Country*</label>
                      <div class="col-sm-7">
                      <input type="hidden" name="profileselectedcountryid" id="profileselectedcountryid" value=''/>
                      <input type="text" class="form-control" name="profilecountry" id="profilecountry" placeholder="Country">
                      </div>
                    </div>
                
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-sec" name='Submit'>Update</button>
                      </div>
                    </div>
                    </form>
                </div>

    <!-- Vendor -->

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

    <!--  <script>
      $( function() {
        var availableTags = [
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
        ];
        $( "#profilecity" ).autocomplete({
          source: availableTags
        });
      } );
      </script> -->
     <script>
      $('#profilecity').autocomplete({
          source: function( request, response ) {
              $.ajax({
                url : 'locationautocomplete.php',
                dataType: 'json',
                data: { name_startsWith: request.term, type:'citycomplete'},
                success: function( data ) 
                {
                   response( $.map( data, function( item ) {
                    var code = item.split("|");
                    return {
                              label: code[1],
                              value: code[1],
                              data : item
                            }
                    }));
                },
                error: function(xhr, status, error) {
                    // check status && error
                   alert("Hello! I am an alert box!" + error);
                 },
              });
            },
            autoFocus: true,          
            minLength: 0,
            select: function( event, ui ) {
            var names = ui.item.data.split("|");  
            $('#profileselectedstateid').val(names[2]);          
            $('#profilestate').val(names[3]);
            $('#profileselectedcountryid').val(names[4]);
            $('#profilecountry').val(names[5]);
          }           
        });
    </script>

   <!--  <script>
    
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

    </script> -->

  </body>
</html>