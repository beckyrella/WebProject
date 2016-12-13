<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Search Bar</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>
	<div class="container"> 
		<?php include_once "templates/loggedInHeader.php"; ?>

		<div id="main">
			<form class="form-wrapper">
			    <input type="text" id="search" placeholder="Search for CSS3, HTML5, jQuery ..." required>
			   <!--  <input type="text" id="searchlocation" placeholder="Search for CSS3, HTML5, jQuery ..." required> -->
			    <input type="submit" value="go" id="submit">
			</form>
			
		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>