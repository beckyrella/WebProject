<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DROP DOWN</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#country').on('change',function(){
			var countryID = $(this).val();
			if(countryID){
				$.ajax({
					type:'POST',
					url:'location.php',
					data:'CTR_ID='+countryID,
					success:function(html){
						$('#state').html(html);
						$('#city').html('<option value="">Select state first</option>');
					}
				}); 
			}else{
				$('#state').html('<option value="">Select country first</option>');
				$('#city').html('<option value="">Select state first</option>'); 
			}
		});
		
		$('#state').on('change',function(){
			var stateID = $(this).val();
			if(stateID){
				$.ajax({
					type:'POST',
					url:'location.php',
					data:'STT_ID='+stateID,
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
<!-- IF LOGGED IN --> 
          <!-- Header here -->
<!-- IF LOGGED OUT -->
          <!-- Alternate Header here -->
<?php include_once "templates/loggedOutHeader.php"; ?>         

<div id="main">

	<?php
	//Include database configuration file
	include('dbConfig.php');

	//Get all country data
	$query = $db->query("SELECT * FROM country ORDER BY CTR_NAME ASC");

	//Count total number of rows
	$rowCount = $query->num_rows;
	if($rowCount > 0)
	{
		$message = "wrong answer";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}	
	?>
	
	<select name="country" id="country">
		<option value="">Select Country</option>
		<?php
			if($rowCount > 0){
				while($row = $query->fetch_assoc()){ 
					echo '<option value="'.$row['CTR_ID'].'">'.$row['CTR_NAME'].'</option>';
				}
			}else{
				echo '<option value="">Country not available</option>';
			}
		?>
	</select>

	<select name="state" id="state">
		<option value="">Select country first</option>
	</select>

	<select name="city" id="city">
		<option value="">Select state first</option>
	</select>

</div>

<?php include_once "templates/subscribePanel.php"; ?>
<?php include_once "templates/footer.php"; ?>
</div>
</body>

</html>