<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class Membersite
{
    var $admin_email;
    var $from_address;
    
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $error_message;
    
    //-----Initialization -------
    function Membersite()
    {
        $this->sitename = 'BusyBodies.com';
        $this->rand_key = 'nVYTSdJCqM9qxjT';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
		
		// try 
		// {
			// $DB_con = new PDO("mysql:host=$host;dbname=$database", $uname, $pwd);
			// // set the PDO error mode to exception
			// $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "Connected successfully"; 
		// }
		// catch(PDOException $e)
		// {
			// echo "Connection failed: " . $e->getMessage();
		// }
        
    }
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleError("Please provide the confirmation code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
		$currentuserid = $user_rec['id'];
		
		//once user confirms email, then creat a profile account
		//this should change if confirmation is not compulsory
		if(!$this->CreateUserProfile($currentuserid))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
	
	function CreateUserProfile($currentuserid)
	{
		 if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
		
		$profiletablename = "profile";
		
		if(!$this->Ensuretable($profiletablename))
        {
            return false;
        }
		
		 if(!$this->InsertNewProfileIntoDB($currentuserid))
        {
            $this->HandleError("Inserting Profile to Database failed!");
            return false;
        }	
		
		return true;		
	}
	
	function InsertNewProfileIntoDB($currentuserid)
	{
		$insert_profile_query = "insert into profile (USR_ID) values ($currentuserid)";
		
		 if(!mysqli_query($this->connection,  $insert_profile_query))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_profile_query");
            return false;
        }
		return true;
	}
    
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        //added to sanitize
		$preusername = trim($_POST['username']);
		$prepassword = trim($_POST['password']);
		
        $username = $this->Sanitize($preusername);
        $password = $this->Sanitize($prepassword);
		
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
	
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
	
	function GetUserId()
    {
        return isset($_SESSION['id_of_user'])?$_SESSION['id_of_user']:'';
    }
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("Reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);

    	$salt = $user_rec['USR_SALT'];
        $hash = $this->checkhashSSHA($salt, $pwd);
        
        if($user_rec['USR_PASSWORD'] != $hash)
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
		//done this way rather than in the actual file to 
		//prevent hackers from injecting scripts 
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgdt'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysqli_error($this->connection));
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        // $from ="nobody@$host";
        $from ="postmaster@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL($username);

		$nresult = mysqli_query($this->connection, "SELECT * FROM $this->tablename WHERE USR_USERNAME = '$username'") or die(mysqli_error($this->connection));

        // check for result 
        $no_of_rows = mysqli_num_rows($nresult);
        if ($no_of_rows > 0) {
            $nresult = mysqli_fetch_array($nresult, MYSQLI_ASSOC);
            $salt = $nresult['USR_SALT'];
            $encrypted_password = $nresult['USR_PASSWORD'];
            $hash = $this->checkhashSSHA($salt, $password);         
        }
        else
        {
            // echo 'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>';
            $this->HandleError("Username or Password does not match");
            return false;
        }

        $qry = "Select USR_ID, USR_FIRSTNAME, USR_LASTNAME, USR_EMAILADDRESS from $this->tablename where USR_USERNAME='$username' and USR_PASSWORD='$hash' and USR_VERIFICATIONCODE='y'";
        
        $result = mysqli_query($this->connection, $qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
			// echo 'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>';
            $this->HandleError("Username or Password does not match");
            return false;
        }
        
        $row = mysqli_fetch_assoc($result);
        
        
        $_SESSION['name_of_user']  = $row['USR_FIRSTNAME']." ".$row['USR_LASTNAME'];
        $_SESSION['email_of_user'] = $row['USR_EMAILADDRESS'];
		$_SESSION['id_of_user'] = $row['USR_ID'];
        
        return true;
    }

	public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $verificationcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysqli_query($this->connection, "Select USR_ID, USR_FIRSTNAME, USR_LASTNAME, USR_EMAILADDRESS from $this->tablename where USR_VERIFICATIONCODE='$verificationcode'");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirmation code.");
            return false;
        }
        $row = mysqli_fetch_assoc($result);
        $user_rec['firstname'] = $row['USR_FIRSTNAME'];
		$user_rec['lastname'] = $row['USR_LASTNAME'];
        $user_rec['email']= $row['USR_EMAILADDRESS'];
		$user_rec['id']= $row['USR_ID'];
        
        $qry = "Update $this->tablename Set USR_VERIFICATIONCODE='y' Where  USR_VERIFICATIONCODE='$verificationcode'";
        
        if(!mysqli_query($this->connection, $qry))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);

        $hash = $this->hashSSHA($newpwd);

		$new_password = $hash["encrypted"];

		$salt = $hash["salt"];
        
        $qry = "Update $this->tablename Set USR_PASSWORD='".$new_password."', USR_SALT='".$salt."' Where  USR_ID=".$user_rec['USR_ID']."";
        
        if(!mysqli_query($this->connection, $qry))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysqli_query($this->connection, "Select * from $this->tablename where USR_EMAILADDRESS='$email'");  

        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("This email isn't registered in our system");
            return false;
        }
        $user_rec = mysqli_fetch_assoc($result);       
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['firstname']." ".$user_rec['lastname']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['firstname']." ".$user_rec['lastname']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['firstname']." ".$user_rec['lastname'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['firstname']." ".$user_rec['lastname']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['USR_EMAILADDRESS'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['USR_FIRSTNAME']." ".$user_rec['USR_LASTNAME']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetPassword.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['USR_FIRSTNAME']." ".$user_rec['USR_LASTNAME']."\r\n\r\n".
        "There was a request to reset your password at ".$this->sitename."\r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            $this->HandleError("Reset Password Instructions failed to send");
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['USR_EMAILADDRESS'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['USR_FIRSTNAME']." ".$user_rec['USR_LASTNAME']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Hello ".$user_rec['USR_FIRSTNAME']." ".$user_rec['USR_LASTNAME']."\r\n\r\n".
        "Your password has been reset successfully. ".
        "Here is your updated login:\r\n".
        "username:".$user_rec['username']."\r\n".
        "password:$new_password\r\n".
        "\r\n".
        "Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
		$validator->addValidation("firstname","req","Please fill in your first name");
        $validator->addValidation("lastname","req","Please fill in  your last name");
		$validator->addValidation("username","req","Please fill in a user name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in your EmailSSSS");
  
        $validator->addValidation("password","req","Please fill in Password");

		      
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
	
	function ValidatePersonalDetailsUpdateSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
		$validator->addValidation("firstname","req","Please fill in your first name");
        $validator->addValidation("lastname","req","Please fill in  your last name");
		$validator->addValidation("username","req","Please fill in a user name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in your Email");
  
		      
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
	
	function ValidateProfileDetailsUpdateSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();

        $validator->addValidation("profileemail","email","The input for Email should be a valid email value");
		      
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
	
	function ValidatePasswordDetailsUpdateSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
		  
        $validator->addValidation("currentpassword","req","Please fill in your current Password");
		$validator->addValidation("newpassword","req","Please fill in a Password");
		$validator->addValidation("newpasswordrepeat","req","Please fill in a Password");
		$validator->addValidation("newpasswordrepeat","eqelmnt=newpassword","The confirmed password is not same as password");

		      
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }
				
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
		//&$ references the variable and any changes made are made to the globalvariable
        //we get the details from the form and add to the array
		$formvars['firstname'] = $this->Sanitize($_POST['firstname']);
		$formvars['lastname'] = $this->Sanitize($_POST['lastname']);
		$formvars['username'] = $this->Sanitize($_POST['username']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
   
    }
	
	function CollectPersonalDetailUpdateSubmission(&$personaldetails)
    {
		//&$ references the variable and any changes made are made to the globalvariable
        //we get the details from the form and add to the array
		$personaldetails['firstname'] = $this->Sanitize($_POST['firstname']);
		$personaldetails['lastname'] = $this->Sanitize($_POST['lastname']);
		$personaldetails['username'] = $this->Sanitize($_POST['username']);
        $personaldetails['sex'] = $this->Sanitize($_POST['sex']);
		$personaldetails['dob'] = $this->Sanitize($_POST['dob']);
		$personaldetails['mobilenumber'] = $this->Sanitize($_POST['mobilenumber']);
        $personaldetails['address'] = $this->Sanitize($_POST['address']);
        $personaldetails['email'] = $this->Sanitize($_POST['email']);
        //todo commented out because i havent added the fields yet
        //$personaldetails['city'] = $this->Sanitize($_POST['city']); 

        //state and country to check
        //$personaldetails['state'] = $this->Sanitize($_POST['state']); 
        //$personaldetails['country'] = $this->Sanitize($_POST['country']); 

    }
	
	function CollectProfileDetailUpdateSubmission(&$profiledetails)
    {
		//&$ references the variable and any changes made are made to the globalvariable
        //we get the details from the form and add to the array
		$profiledetails['profilename'] = $this->Sanitize($_POST['profilename']);
		$profiledetails['profilemobnum'] = $this->Sanitize($_POST['profilemobnum']);
		$profiledetails['profileemail'] = $this->Sanitize($_POST['profileemail']);
        $profiledetails['profilehomeadd'] = $this->Sanitize($_POST['profilehomeadd']);
		$profiledetails['profilecity'] = $this->Sanitize($_POST['city']);
		$profiledetails['profilestate'] = $this->Sanitize($_POST['state']);
        $profiledetails['profilecountry'] = $this->Sanitize($_POST['country']);
        $profiledetails['profiledesc'] = $this->Sanitize($_POST['profiledesc']);  
    }
	
	function CollectPasswordDetailUpdateSubmission(&$passworddetails)
    {
		//&$ references the variable and any changes made are made to the globalvariable
        //we get the details from the form and add to the array
		$passworddetails['currentpassword'] = $this->Sanitize($_POST['currentpassword']);
		$passworddetails['newpassword'] = $this->Sanitize($_POST['newpassword']);
		$passworddetails['newpasswordrepeat'] = $this->Sanitize($_POST['newpasswordrepeat']);
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
		//added
		/* $mailer->Host='smtp.gmail.com';  
		$mailer->Port='587';   
		$mailer->Username='beckyrella07@gmail.com'; // SMTP account username
		$mailer->Password='youtube36';  
		$mailer->IsSMTP();
		$mailer->SMTPAuth=true;
		$mailer->SMTPSecure='ssl';
		$mailer->SMTPKeepAlive = true;  
		$mailer->CharSet = 'utf-8';  
		$mailer->SMTPDebug  = 2;   
		$mailer->IsHTML(true);
		$mailer->Priority = 1; */
		//end
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['firstname']." ".$formvars['lastname']);
         
        $mailer->Subject = "Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmRegistration.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['firstname']." ".$formvars['lastname']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
			echo 'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>';
            $this->HandleError("Failed sending registration confirmation email.". $mailer->ErrorInfo);
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';

        $urldir ='';
        $pos = strrpos($_SERVER['REQUEST_URI'],'/');
        if(false !==$pos)
        {
            $urldir = substr($_SERVER['REQUEST_URI'],0,$pos);
        }

        $scriptFolder .= $_SERVER['HTTP_HOST'].$urldir;

        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['firstname']." ".$formvars['lastname'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['firstname']." ".$formvars['lastname']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable($this->tablename))
        {
            return false;
        }
        if(!$this->IsFieldUnique($formvars, 'email', 'USR_EMAILADDRESS'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
		if(!$this->IsFieldUnique($formvars, 'username', 'USR_USERNAME'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        } 
              
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
	function SavePersonalDetailsToDatabase(&$personaldetails)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
		
        if(!$this->ensuretable($this->tablename))
        {
            return false;
        }
		
        if(!$this->IsFieldUniqueToCurrentUser($personaldetails, 'email', 'USR_EMAILADDRESS'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
		if(!$this->IsFieldUniqueToCurrentUser($personaldetails, 'username', 'USR_USERNAME'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }

        if ((!empty($personaldetails['state']) || !empty($personaldetails['country'])) && empty($personaldetails['city']))
        {
             $this->HandleError("Please select a city");
            return false;
        }
              
        if(!$this->InsertPersonalDetailUpdateIntoDB($personaldetails))
        {
            $this->HandleError("Updating Details to Database failed!");
            return false;
        }
        return true;
    }
	
	function SaveProfileDetailsToDatabase(&$profiledetails)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
		
		$profiletable = 'profile';
		
        if(!$this->ensuretable($profiletable))
        {
            return false;
        }

        // if ((!empty($profiledetails['profilestate'])))
        // {
        //     $pp = $profiledetails['profilestate'];
        //     echo "<script type='text/javascript'>alert('$pp');</script>";
        //     //  $this->HandleError("Please select a city");
        //     // return false;
        // }

        if ((!empty($profiledetails['profilestate']) || !empty($profiledetails['profilecountry'])) && empty($profiledetails['profilecity']))
        {
             $this->HandleError("Please select a city");
            return false;
        }
              
        if(!$this->InsertProfileDetailUpdateIntoDB($profiledetails))
        {
            $this->HandleError("Updating Profile Details to Database failed!");
            return false;
        }
        return true;
    }
	
	function SavePasswordDetailsToDatabase(&$passworddetails)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
		
        if(!$this->ensuretable($this->tablename))
        {
            return false;
        }
		
        if(!$this->InsertPasswordDetailUpdateIntoDB($passworddetails))
        {
            $this->HandleError("Updating Password to Database failed!");
            return false;
        }
        return true;
    }
	
	function IsFieldUniqueToCurrentUser($personaldetails, $inputfieldname, $dbcolumnname)
    {
		//give you the currentuserid
		//give me the userid with the detail that is not correct
		//check that they match
		//match = true else flse
		$idcolumn = 'USR_ID';
        $id = $_SESSION['id_of_user'];
		$field_val = $this->SanitizeForSQL($personaldetails[$inputfieldname]);
        $qry = "select $idcolumn, $dbcolumnname from $this->tablename where $dbcolumnname='".$field_val."'";
		$result = mysqli_query($this->connection, $qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
			if((mysqli_num_rows($result) == 1))
			{
				$nresult = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$resultid = $nresult['USR_ID'];
				if($resultid == $id)
				{
					return true;
				}
			}
           return false;
        }
        return true;    
    }
	
	//i changed this so that it runs fluidly because my inputfieldnames are not
	//the same as my dbfield
    function IsFieldUnique($formvars,$inputfieldname, $dbcolumnname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$inputfieldname]);
        $qry = "select $dbcolumnname from $this->tablename where $dbcolumnname='".$field_val."'";
        $result = mysqli_query($this->connection, $qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function DBLogin()
    {

        $this->connection = mysqli_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysqli_select_db($this->connection, $this->database))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysqli_query($this->connection, "SET NAMES 'UTF8'"))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable($nameoftable)
    {
        $result = mysqli_query($this->connection, "SHOW COLUMNS FROM $nameoftable");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            return false;
        }
        return true;
    }
    
    function CreateTable()
    {
       
    	$qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
		"salt VARCHAR( 50 ) NOT NULL ,".
                "password VARCHAR( 80 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
	
                
        if(!mysqli_query($this->connection, $qry))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    }
    
    function InsertIntoDB(&$formvars)
    {
    
		//creating an encryption of the users password
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);

        $formvars['confirmcode'] = $confirmcode;

		$hash = $this->hashSSHA($formvars['password']);

		$encrypted_password = $hash["encrypted"];
        
 		$salt = $hash["salt"];
		
        //inserting registration details
        $insert_query = 'insert into '.$this->tablename.'(
		USR_FIRSTNAME,
		USR_LASTNAME,
		USR_USERNAME,
		USR_EMAILADDRESS,
		USR_PASSWORD,
		USR_VERIFICATIONCODE,
		USR_SALT
		)
		values
		(
		"' . $this->SanitizeForSQL($formvars['firstname']) . '",
		"' . $this->SanitizeForSQL($formvars['lastname']) . '",
		"' . $this->SanitizeForSQL($formvars['username']) . '",
		"' . $this->SanitizeForSQL($formvars['email']) . '",
		"' . $encrypted_password . '",
		"' . $confirmcode . '",
		"' . $salt . '"		
		)';
 
        if(!mysqli_query($this->connection,  $insert_query))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }

		//Create Profile too
		
        return true;
    }
    
	function InsertPersonalDetailUpdateIntoDB(&$personaldetails)
    {
		$uid = $_SESSION['id_of_user'];
		$today = date('Y-m-d');
		$fname = $this->SanitizeForSQL($personaldetails['firstname']);
		$lname = $this->SanitizeForSQL($personaldetails['lastname']);
		$uname = $this->SanitizeForSQL($personaldetails['username']);
		$sid = 	 $this->SanitizeForSQL($personaldetails['sex']);
		$birth = $this->SanitizeForSQL($personaldetails['dob']);
		$mobn = $this->SanitizeForSQL($personaldetails['mobilenumber']);
		$hadd = $this->SanitizeForSQL($personaldetails['address']);
		$emailadd = $this->SanitizeForSQL($personaldetails['email']);
		
		//because these will never be empty
		//$fname = !empty($fname) ? "'$fname'" : "NULL";
		//$lname = !empty($lname) ? "'$lname'" : "NULL";
		//$uname = !empty($uname) ? "'$uname'" : "NULL";
		//$emailadd = !empty($emailadd) ? "'$emailadd'" : "NULL";
		$sid = !empty($sid) ? "'$sid'" : "NULL";
		$birth = !empty($birth) ? "$birth" : "NULL";
		$mobn = !empty($mobn) ? "'$mobn'" : "NULL";
		$hadd = !empty($hadd) ? "'$hadd'" : "NULL";
		
	
		$update_query = "Update $this->tablename Set USR_FIRSTNAME='".$fname."', USR_LASTNAME='".$lname."', USR_USERNAME='".$uname."', SEX_ID=".$sid.", USR_DATEOFBIRTH='".$birth."', USR_MOBILENUMBER=".$mobn.", USR_HOMEADDRESS=".$hadd.", USR_EMAILADDRESS='".$emailadd."' Where USR_ID=".$uid."";
		

        if(!mysqli_query($this->connection,  $update_query))
        {
            $this->HandleDBError("Error updating data to the table\nquery:$update_query");
            return false;
        }        
        return true;
    }
	
	function InsertProfileDetailUpdateIntoDB(&$profiledetails)
    {
		$uid = $_SESSION['id_of_user'];
		$today = date('Y-m-d');
		$profilename = $this->SanitizeForSQL($profiledetails['profilename']);
		$profilemobnum = $this->SanitizeForSQL($profiledetails['profilemobnum']);
		$profileemail = $this->SanitizeForSQL($profiledetails['profileemail']);
		$profilehomeadd = 	 $this->SanitizeForSQL($profiledetails['profilehomeadd']);
		$profilecity = $this->SanitizeForSQL($profiledetails['profilecity']);
		// $profilestate = $this->SanitizeForSQL($profiledetails['profilestate']);
		// $profilecountry = $this->SanitizeForSQL($profiledetails['profilecountry']);
		$profiledesc = $this->SanitizeForSQL($profiledetails['profiledesc']);
		
		
		$profilename = !empty($profilename) ? "$profilename" : "NULL";
		$profilemobnum = !empty($profilemobnum) ? "$profilemobnum" : "NULL";
		$profileemail = !empty($profileemail) ? "$profileemail" : "NULL";
		$profilehomeadd = !empty($profilehomeadd) ? "$profilehomeadd" : "NULL";
		$profiledesc = !empty($profiledesc) ? "$profiledesc" : "NULL";
		
		//for these the users select a name but we should be saving a i.e number field
		//plus we only store city not the others because we can populate them if we know the city code
		$profilecity = !empty($profilecity) ? "$profilecity" : "NULL";
		// $profilestate = !empty($profilestate) ? '$profilestate' : NULL;
		// $profilecountry = !empty($profilecountry) ? '$profilecountry' : NULL;
		
		// $update_queryss = 'UPDATE '.$this->tablename.' 
		// SET USR_PASSWORD="' . $encrypted_password . '",
		// USR_SALT="' . $salt . '"
		// WHERE USR_ID="'.$id.'"';

        echo "<script type='text/javascript'>alert('$profilecity');</script>";
		
		$update_query = 'UPDATE profile SET PFL_NAME="'.$profilename.'", PFL_MOBILENUMBER="'.$profilemobnum.'", PFL_EMAILADDRESS="'.$profileemail.'", PFL_ADDRESS="'.$profilehomeadd.'", CTY_ID='.$profilecity.', PFL_DESCRIPTION="'.$profiledesc.'" WHERE USR_ID="'.$uid.'"';
		
		// CTY_ID=".$profilecity." 

		//$update_query = "Update profile Set PFL_NAME='".$profilename."', PFL_MOBILENUMBER='".$profilemobnum."', PFL_EMAILADDRESS='".$profileemail."', PFL_ADDRESS='".$profilehomeadd."', PFL_DESCRIPTION='".$profiledesc."', CTY_ID=".$profilecity." Where USR_ID=".$uid."";
		

        if(!mysqli_query($this->connection,  $update_query))
        {
            $this->HandleDBError("Error updating data to the table\nquery:$update_query");
            return false;
        }        
        return true;
    }
	
	function InsertPasswordDetailUpdateIntoDB(&$passworddetails)
    {
		//creating an encryption of the users password

		$hash = $this->hashSSHA($passworddetails['newpassword']);

		$encrypted_password = $hash["encrypted"];
        
 		$salt = $hash["salt"];
		
		$id = $_SESSION['id_of_user'];
		
		$update_query = 'UPDATE '.$this->tablename.' 
		SET USR_PASSWORD="' . $encrypted_password . '",
		USR_SALT="' . $salt . '"
		WHERE USR_ID="'.$id.'"';
		
        if(!mysqli_query($this->connection,  $update_query))
        {
            $this->HandleDBError("Error updating data to the table\nquery:$update_query");
            return false;
        }        
        return true;
    }
	
	function hashSSHA($password) 
	{
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
	
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysqli_real_escape_string" ) )
        {
              $ret_str = mysqli_real_escape_string($this->connection, $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
	
	//MYCODE :D
	function GetUserDetails()
	{
		if (isset($_SESSION['name_of_user']))
		{
			if(!$this->DBLogin())
			{
				$this->HandleError("Database login failed!");
				return false;
			}
			
			$accountdetails = array();
			
			$usersid = $this->GetUserId();

			
			//echo "<script type='text/javascript'>alert('$usersid');</script>";
			      
			$result = mysqli_query($this->connection, "select * from $this->tablename where USR_ID='$usersid'");  

			if(!$result || mysqli_num_rows($result) <= 0)
			{
			  $this->handleerror("there is no user with the given id: '$usersid'");
			  return false;
			}
			
			$row = mysqli_fetch_assoc($result);
			$accountdetails['firstname'] = $row['USR_FIRSTNAME'];
			$accountdetails['lastname'] = $row['USR_LASTNAME'];
			$accountdetails['username'] = $row['USR_USERNAME'];
			$accountdetails['email'] = $row['USR_EMAILADDRESS'];
			$accountdetails['mobilenumber'] = $row['USR_MOBILENUMBER'];
			$accountdetails['dateofbirth'] = $row['USR_DATEOFBIRTH'];
			$accountdetails['sex'] = $row['SEX_ID'];
			$accountdetails['address'] = $row['USR_HOMEADDRESS'];
			
			// $nname = $accountdetails['firstname'];
			// echo "<script type='text/javascript'>alert('$nname');</script>";			
			return $accountdetails;
		}
	}
	
		//MYCODE :D
	function GetProfileDetails()
	{
		if (isset($_SESSION['name_of_user']))
		{
			if(!$this->DBLogin())
			{
				$this->HandleError("Database login failed!");
				return false;
			}
			
			$profiledetails = array();
			
			$usersid = $this->GetUserId();
						      
			$result = mysqli_query($this->connection, "select * from profile where USR_ID='$usersid'"); 

           
			if(!$result || mysqli_num_rows($result) <= 0)
			{
			  $this->handleerror("there is no profile for with the given id: '$usersid'");
			  return false;
			}
			
				$row = mysqli_fetch_assoc($result);
				$profiledetails['profilename'] = $row['PFL_NAME'];
				$profiledetails['profilemobnum'] = $row['PFL_MOBILENUMBER'];
				$profiledetails['profileemail'] = $row['PFL_EMAILADDRESS'];
				$profiledetails['profilehomeadd'] = $row['PFL_ADDRESS'];
				
				//change to reflect that the values are shown when an id is given
				$profiledetails['profilecity'] = $row['CTY_ID'];
				// $profiledetails['profilestate'] = $row['CTY_ID'];
				// $profiledetails['profilecountry'] = $row['CTY_ID'];
				$profiledetails['profiledesc'] = $row['PFL_DESCRIPTION']; 

				$selectedcity = $profiledetails['profilecity'];

				// if (!empty($selectedcity)) {
				//     echo "<script type='text/javascript'>alert('$selectedcity');</script>";
				// }



				if (!empty($selectedcity)) 
				{
					 $locationresult = mysqli_query($this->connection, 
					"SELECT CITY.CTY_ID, CITY.CTY_NAME, STATE.STT_ID, STATE.STT_NAME, COUNTRY.CTR_ID, COUNTRY.CTR_NAME FROM CITY, STATE, COUNTRY, PROFILE WHERE PROFILE.CTY_ID='$selectedcity' AND CITY.STT_ID=STATE.STT_ID AND STATE.CTR_ID=COUNTRY.CTR_ID GROUP BY PROFILE.CTY_ID"); 
				 

					if(!$locationresult || mysqli_num_rows($locationresult) <= 0)
					{
					  $this->handleerror("there is no cIty with the given id: '$selectedcity'");
					  return false;
					}
				
					$locationrow = mysqli_fetch_assoc($locationresult);
					$profiledetails['profilestate'] = $locationrow['STT_ID'];
					$profiledetails['profilecountry'] = $locationrow['CTR_ID'];

					$state = $profiledetails['profilestate'];
					$country = $profiledetails['profilecountry'];

					// if (empty($state)) {
					//     echo "<script type='text/javascript'>alert('$selectedcity');</script>";
					// }

					// if (!empty($country)) {
					//     echo "<script type='text/javascript'>alert('$country');</script>";

						//$this->handleerror("JUST PRINTING: '$state'");
				}
				
             return $profiledetails; 
        }		
	}

	function UpdatePersonalDetails()
	{
	
	/* 	we want to check the details, then connect to database
		then update where id matches
		then return true or false for successfull
		so concatenate firstname and lastname
	*/
		if(!isset($_POST['submitted']))
        {
           return false;
        }
		
		$personaldetails = array();
        
        if(!$this->ValidatePersonalDetailsUpdateSubmission())
        {
            return false;
        }
		
		$this->CollectPersonalDetailUpdateSubmission($personaldetails);
        
        if(!$this->SavePersonalDetailsToDatabase($personaldetails))
        {
            return false;
        }
		
		return true;
	}

	function UpdatePasswordDetails()
	{
		
	/* need to check the current pwd matches what we have
	*/
	
		if(!isset($_POST['submittedpassword']))
        {
           return false;
        }
		
		$passworddetails = array();
		     
        if(!$this->ValidatePasswordDetailsUpdateSubmission())
        {
            return false;
        }
				
		$this->CollectPasswordDetailUpdateSubmission($passworddetails);
		
		$user_rec= array();
		
        if(!$this->getuserfromemail($this->useremail(),$user_rec))
        {
          return false;
        }
        
		$pwd = trim($passworddetails['currentpassword']);
    	$salt = $user_rec['USR_SALT'];
        $hash = $this->checkhashSSHA($salt, $pwd);
        
        if($user_rec['USR_PASSWORD'] != $hash)
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        
        if(!$this->SavePasswordDetailsToDatabase($passworddetails))
        {
            return false;
        }
		
		return true;
	}
	
	function UpdateProfileDetails()
	{
		
        // echo "<script type='text/javascript'>alert('ENETERED');</script>";

		if(!isset($_POST['submittedprofile']))
        {
            $this->HandleError("isnot submitted profile");
           return false;
        }
		
		$profiledetails = array();
        
        if(!$this->ValidateProfileDetailsUpdateSubmission())
        {
            $this->HandleError("Failed to validate profile update");
            return false;
        }
		
		$this->CollectProfileDetailUpdateSubmission($profiledetails);
        
        if(!$this->SaveProfileDetailsToDatabase($profiledetails))
        {
            $this->HandleError("Failed to save profile update");
            return false;
        }
		
		return true;
	}
	
	
	
	//the end

}
?>
	
