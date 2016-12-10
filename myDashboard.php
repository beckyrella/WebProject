<?PHP
require_once("./include/membersite_config.php");
require_once("results.php");
if(!$membersite->CheckLogin())
{
    $membersite->RedirectToURL("login.php");
    exit;
}
?>
<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Dashboard</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	$(document).ready(function(){
		$( "#searchlocation" ).autocomplete({
		    source: 'search.php',
		    select: function (event, ui) {
		        $("#searchlocation").val(ui.item.label); // display the selected text
		        $("#selectedcityid").val(ui.item.id); // save selected id to hidden input
			    }
		});
	});
</script>
</head>

<body>
	<div class="container"> 

	<?php include_once "templates/loggedInHeader.php"; ?>         

	<div id="main">
		<h1> What can we help you with </h1>
		<form id='register' action='results.php' method='get' accept-charset='UTF-8'>
			<input type='hidden' name='submitted' id='submitted' value='1'/>
			<input type='text' name='selectedcityid' id='selectedcityid' value=''/>

			<div class='searchkeyword'>
				<input type='text' name='searchkeyword' id='searchkeyword' placeholder="What can we help you with? ..." value='<?php echo $membersite->SafeDisplay('lastname') ?>' maxlength="70" />
			</div>
			<div class='searchlocation'>
				<input type='text' name='searchlocation' id='searchlocation' placeholder="and Where? ..." value='' maxlength="70" />
			</div>

			<!-- <div class="ui-widget">
			    <label for="skills">City:</label>
			    <input id="skills">
			</div> -->

			<div class='searchbutton'>
				<input type='submit' name='Submit' value='Search' />
			</div>
			
		</form>
	</div>
	<div class="searchview">

	    <hgroup class="mb20">
			<h1>Search Results</h1>
			<h2 class="lead"><strong class="text-danger">3</strong> results were found for the search for <strong class="text-danger">Lorem</strong></h2>								
		</hgroup>

		<ul class="searchresultlisting" style="list-style-type: none;">
			<li class="searchresultlistingitem">
				<div class="searchresultprofile">
					<div class="searchresultprofileimage">
						<img src="http://placehold.it/140x100" alt="Profile View">
					</div>
					<div class="searchresultprofiledetail">
						<h3><a href="http://www.google.com" title="My Title">chvj</a></h3>			
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, exercitationem, suscipit, distinctio, qui sapiente aspernatur molestiae non corporis magni sit sequi iusto debitis delectus doloremque.</p>
						<p>Category is Driving, Cleaning etc<p>
						<p>Primary Location is Edinburgh<p>
						<p>Member since 2013</p>
					</div>
				</div>	
			</li>	
			<!-- </li>
				<li class="searchresultlistingitem">
				<div class="searchresultprofile">
					<div class="searchresultprofileimage">
						<img src="http://placehold.it/140x100" alt="Profile View">
					</div>
					<div class="searchresultprofiledetail">
						<h3><a href="http://www.google.com" title="My Title">chvj</a></h3>			
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, exercitationem, suscipit, distinctio, qui sapiente aspernatur molestiae non corporis magni sit sequi iusto debitis delectus doloremque.</p>
						<p>Category is Driving, Cleaning etc<p>
						<p>Primary Location is Edinburgh<p>
						<p>Member since 2013</p>
					</div>
				</div>		
			</li> -->
		</ul>
	</div>

	<?php include_once "templates/subscribePanel.php"; ?>
	<?php include_once "templates/footer.php"; ?>
	</div>
</body>

</html>