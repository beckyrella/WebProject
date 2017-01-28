<?PHP
require_once("./include/membersite_config.php");

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

if(isset($_POST['submittedpassword']))
{
   if($membersite->UpdatePasswordDetails())
   {
	   //change to update page saying its being updated
       // $membersite->RedirectToURL("thankYou.php");
	   echo "Password Updated Successfully";
   }
}
if(isset($_POST['submittedprofile']))
{
   if($membersite->UpdateProfileDetails())
   {
	   //change to update page saying its being updated
       // $membersite->RedirectToURL("thankYou.php");
	   echo "Profile Updated Successfully";
   }
}

$profiledata = $membersite->GetProfileDetails();
if (!empty($profiledata['profilecity']))
{
	$pcty = $profiledata['profilecity'];
	$pstt = $profiledata['profilestate'];
	$pctry = $profiledata['profilecountry'];
	//echo "FETCHED Profile U Successfully";
}

?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Account Management</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<link rel="stylesheet" type="text/css" href="css/pwdwidget.css" />
<script src="js/gen_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'selectedCountryId='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first1</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'selectedStateId='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
</head>

<body>
	<div class="container"> 

		<?php include_once "templates/loggedInHeader.php"; ?>     
		<?php include "include/DbConfig.php"; ?>   	
		<?php
		    if(isset($_POST['btn'])){
		        echo "
		            <script type=\"text/javascript\">
		            var e = document.getElementById('testForm'); e.action='test.php'; e.submit();
		            </script>
		        ";
		     }
		  ?>	

		<div id="main">
			<input type="text" name="inputText"/>
			<div id='membersite'>
			
			<strong> UPDATE YOUR PROFILE DETAILS </strong>
			
		
			<form id='updateprofiledetail' action='<?php echo $membersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<fieldset >
						<legend>Profile Details</legend>
						<input type='hidden' name='submittedprofile' id='submittedprofile' value='1'/>

						<div class='short_explanation'>* required fields</div>
						<input type='text'  class='spmhidip' name='<?php echo $membersite->GetSpamTrapInputName(); ?>' />

						<div><span class='pflerror'><?php echo $membersite->GetErrorMessage(); ?></span></div>
						<div class='containers'>
							<label for='profilename' >Profile Name*: </label><br/>
							<input type='text' name='profilename' id='profilename' value='<?php echo $profiledata['profilename']; ?>' maxlength="250" /><br/>
							<span id='update_profilename_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilemobnum' >Telephone Number*: </label><br/>
							<input type='text' name='profilemobnum' id='profilemobnum' value='<?php echo $profiledata['profilemobnum']; ?>' maxlength="30" /><br/>
							<span id='update_profilemobnum_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profileemail' >Email Address*:</label><br/>
							<input type='text' name='profileemail' id='profileemail' value='<?php echo $profiledata['profileemail']; ?>' maxlength="70" /><br/>
							<span id='update_profileemail_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilehomeadd' >Address*: </label><br/>
							<input type='text' name='profilehomeadd' id='profilehomeadd' value='<?php echo $profiledata['profilehomeadd']; ?>' maxlength="250" /><br/>
							<span id='update_username_errorloc' class='pflerror'></span>
						</div>							
						<div class='containers'>
							<label for='profilecountry'>Country*:</label><br/>
							<?php
								//Include database configuration file
								include('dbConfig.php');

								//Get all country data
								$query = $db->query("SELECT * FROM country ORDER BY CTR_NAME ASC");

								//Count total number of rows
								$rowCount = $query->num_rows;
							?>
							<select name="country" id="country">
								 <option value="">Select Country</option>
								    <?php
								    if($rowCount > 0){
								        while($row = $query->fetch_assoc()){ 
								        	$currentid = $row['CTR_ID'];
								        	$selected = '';


								        	$selected = ($currentid == $pctry) ? ' selected="selected"' : '';
		 									echo "<option value='" . $row['CTR_ID'] . "' ".$selected.">" . $row['CTR_NAME'] . "</option>";					            
								        }
								    }else{
								        echo '<option value="">Country not available</option>';
								    }
								    ?>
							</select>

							<span id='update_profilecountry_errorloc' class='pflerror'></span>
						</div>						
												
						<div class='containers'>
							<label for='profilestate' >State*:</label><br/>
							<select name="state" id="state">
								 <option value="">Select country first</option>
							</select>
							<span id='update_profilestate_errorloc' class='pflerror'></span>
						</div>
						<div class='containers'>
							<label for='profilecity' >City*:</label><br/>
							<select name="city" id="city">
								 <option value="">Select state first</option>
							</select>
							<span id='update_profilecity_errorloc' class='pflerror'></span>
						</div>			
						<div class='containers'>
							<label for='profiledesc' >Description*:</label><br/>
							<input type='text' name='profiledesc' id='profiledesc' value='<?php echo $profiledata['profiledesc']; ?>' maxlength="250" /><br/>
							<span id='update_profiledesc_errorloc' class='pflerror'></span>
						</div>
												
						<div class='containers'>
							<input type='submit' name='Submit' value='Submit' />
						</div>
					</fieldset>
				</form>

			
				
			<script type='text/javascript'>
			// <![CDATA[
							
				// var frmvalidator  = new Validator("updatepersonaldetail");
				// frmvalidator.EnableOnPageErrorDisplay();
				// frmvalidator.EnableMsgsTogether();
				
				// frmvalidator.addValidation("firstname","req","Please provide your first name");
				// frmvalidator.addValidation("lastname","req","Please provide your last name");
				// frmvalidator.addValidation("username","req","Please provide a User name");
				// //frmvalidator.addValidation("sex","req","Please provide your sex");
				// //frmvalidator.addValidation("dob","req","Please provide your date of birth");
				// //frmvalidator.addValidation("mobilenumber","req","Please provide a mobile number");
				// //frmvalidator.addValidation("address","req","Please provide your address");
				// frmvalidator.addValidation("email","req","Please provide your email address");
				// frmvalidator.addValidation("email","email","Please provide a valid email address");
				// frmvalidator.addValidation("password","req","Please provide a password");
				
				
				
				var pwdfrmvalidator  = new Validator("updatepassworddetail");
				pwdfrmvalidator.EnableOnPageErrorDisplay();
				pwdfrmvalidator.EnableMsgsTogether();
				
				pwdfrmvalidator.addValidation("currentpassword","req","Please provide your password");
				pwdfrmvalidator.addValidation("newpassword","req","Please provide a password");
				pwdfrmvalidator.addValidation("newpasswordrepeat","req","Please provide a password");
			// ]]>
			</script>
			
			</div>					
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>