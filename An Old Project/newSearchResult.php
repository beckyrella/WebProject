<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Result</title>
<link href="css/style.css?d=<?php echo time(); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css?d=<?php echo time(); ?>">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
<div class="container"> 
<!-- IF LOGGED IN --> 
          <!-- Header here -->
<!-- IF LOGGED OUT -->
          <!-- Alternate Header here -->
<?php include_once "templates/loggedOutHeader.php"; ?>         

<div class="searchview">
<!-- <?php// include_once "templates/bodyStandardText.php"; ?> -->
<ul class="searchresultlisting" style="list-style-type: none;">
	<li class="searchresultlistingitem">
        <div class="searchresultprofile">
			<div class="searchresultprofileimage">
				<img src="http://placehold.it/140x100" alt="Profile View">
			</div>
			<div class="searchresultprofiledetail">
			<!-- 	<h3><a href="http://www.google.com" title="My Title">P F George</a></h3>
				<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Primary Location: </a> -->
				<h3><a href="http://www.google.com" title="My Title">P F George</a></h3>
				<ul class="profilecontact">
					<li>Primary Location: London</li>
					<li>|</li>
					<li>Tel Num: +234 8052865284</li>
					<li>|</li>
					<li>Email: London@yahoo.com</li>
				</ul>
			<!-- 	<p class="locationtext">Primary Location: London</p>
				<p class="telephonenumber">Tel Num: +234 8052865284</p>
				<p class="emailAddress">Email: London@yahoo.com</p> -->
				<p class="searchdescription">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, exercitationem, suscipit, distinctio, qui sapiente aspernatur molestiae non corporis magni sit sequi iusto debitis delectus doloremque.</p>
			</div>
		</div>	
	</li>
	<li class="searchresultlistingitem">
        <div class="searchresultprofile">
			<div class="searchresultprofileimage">
				<img src="http://placehold.it/140x100" alt="Profile View">
			</div>
			<div class="searchresultprofiledetail">
				<h3><a href="http://www.google.com" title="My Title">P F George</a></h3>
				<a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
				<p class="searchdescription">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, exercitationem, suscipit, distinctio, qui sapiente aspernatur molestiae non corporis magni sit sequi iusto debitis delectus doloremque.</p>
				<p>Category is Driving, Cleaning etc<p>
				<p>Primary Location is Edinburgh<p>
				<p>Member since 2004</p>
			</div>
		</div>	
	</li>
</ul>
</div>


<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>