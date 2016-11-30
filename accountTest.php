<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign Up</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/accountSetting.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container"> 
<!-- IF LOGGED IN --> 
          <!-- Header here -->
<!-- IF LOGGED OUT -->
          <!-- Alternate Header here -->
<?php include_once "templates/loggedOutHeader.php"; ?>         

<section class="accountSettings" id="main">
<h2>Your Account</h2>

<form action="">
   <div>
      <input type="text" name="username" id="username" />
      <label for="username">Change Email Address</label>

      <input type="submit" name="change-email-submit" id="change-email-submit" value="Change Email" class="button" />
   </div>
</form>

<hr />

<h2>Change Password</h2>

<form action="#">
   <div>
      <label for="password">New Password</label>
      <input type="password" name="r" id="repeat-new-password" />

      <label for="password">Repeat New Password</label>
      <input type="submit" name="change-password-submit" id="change-password-submit" value="Change Password" class="button" />
   </div>
</form>

<hr />

<form action="" id="delete-account-form">
    <div>
        <input type="submit" name="delete-account-submit" id="delete-account-submit" value="Delete Account?" class="button" />
    </div>
</form>
</div>

<?php include_once "templates/subscribePanel.php"; ?>
<?php include_once "footer.php"; ?>
</section>
</body>

</html>