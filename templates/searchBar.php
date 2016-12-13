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
<title>Search Bar</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/membersite.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	$(document).ready(function(){
		$( "#searchlocation" ).autocomplete({
		    source: './search.php',
		    select: function (event, ui) {
		        $("#searchlocation").val(ui.item.label); // display the selected text
		        $("#selectedcityid").val(ui.item.id); // save selected id to hidden input
			    }
		});
	});
</script>
</head>

<body>
	<form class="form-wrapper" id="register" action="./results.php" method="get" accept-charset="UTF-8">
		<input type="hidden" name="submitted" id="submitted" value="1"/>
		<input type="hidden" name="selectedcityid" id="selectedcityid" value=''/>
	    <input type="text" class="search" name="searchkeyword" id="searchkeyword" placeholder="What are you looking for?..." required>
	    <input type="text" class="search" name="searchlocation" id="searchlocation" placeholder="Where?..." required>
	    <input type="submit" value="go" name="Submit" id="submit">
	</form>
</body>

</html>