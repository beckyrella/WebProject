<?php 
include('dbConfig.php');

$searchkeyword = null;
$city = null;
$selectedcityid = null;

if (isset($_GET['searchkeyword'])) {
    $searchkeyword = $_GET['searchkeyword'];
}
if (isset($_GET['searchlocation'])) {
    $city = $_GET['searchlocation'];
}
if (isset($_GET['selectedcityid'])) {
	$selectedcityid = $_GET['selectedcityid'];
}
if(isset($_GET['submitted']))
{
	if ($searchkeyword === NULL || $city === NULL || $selectedcityid === NULL) {
		echo "Please enter a text and location to search for";
	}
}
else { 	return false; }

$keyword = '%'.$searchkeyword.'%';

$query = $db->query("SELECT * 
					FROM profile pfl
					WHERE pfl.CTY_ID = '$selectedcityid'
					AND pfl_id IN (
					SELECT pflcat.pfl_id
					FROM category cat, profile_category pflcat
					WHERE cat.cat_id = pflcat.cat_id
					AND cat.cat_description LIKE '$keyword'
					)");

//Count total number of rows
$rowCount = $query->num_rows;
// $resultset = array();

// if ($rowCount > 0) 
// {
// 	 while($row = $query->fetch_assoc())
// 	 { 
// 	 		$resultset[] = $row;
// 	 }
// }
?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Page</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
	<div class="container"> 

	<?php include_once "templates/loggedInHeader.php"; ?>         

	<div class="searchview">

	    <hgroup class="mb20">
			<h1>Search Results</h1>
			<h2 class="lead"><strong class="text-danger">3</strong> results were found for the search for <strong class="text-danger">Lorem</strong></h2>								
		</hgroup>

		<ul class="searchresultlisting" style="list-style-type: none;">
			      
	         <?php if ($rowCount > 0) {            
	             while($row = $query->fetch_assoc()) { ?>
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
							<p>Member since <?php echo $row['PFL_ID']; ?></p>
						</div>
					</div>	
				</li>
	         <?php }} ?>
	     
		</ul>
	</div>

	<?php include_once "templates/footer.php"; ?>
	</div>
</body>


</html>