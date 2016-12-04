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

if ($rowCount > 0) 
{
	 while($row = $query->fetch_assoc())
	 { 
	 	 echo 'Profile: '.$row['PFL_ID'].' <br/>';   
	 }
}
else
{
	echo "Sorry, your search returned no result";
}


//for now we search by name 
// but should be search by id for location because location will dropdown specific

?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Page</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="container"> 
		<!-- IF LOGGED IN --> 
		          <!-- Header here -->
		<!-- IF LOGGED OUT -->
		          <!-- Alternate Header here -->
		<?php include_once "templates/loggedOutHeader.php"; ?>         

		<div id="main">


		</div>

		<?php include_once "templates/subscribePanel.php"; ?>
		<?php include_once "templates/footer.php"; ?>

	</div>
</body>

</html>