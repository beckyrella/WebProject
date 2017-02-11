<?PHP
	require_once("include/DbConfig.php");

	if($_GET['type'] == 'citycomplete')
	{
		//autocomplete
		$city_query = "SELECT DISTINCT CITY.CTY_ID, CITY.CTY_NAME, STATE.STT_ID, STATE.STT_NAME, COUNTRY.CTR_ID, COUNTRY.CTR_NAME FROM CITY, STATE, COUNTRY, PROFILE WHERE CITY.CTY_NAME LIKE '%ike%' AND CITY.STT_ID = STATE.STT_ID AND STATE.CTR_ID = COUNTRY.CTR_ID";

		$result = mysqli_query($DB_con, $city_query);	
		$data = array();
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$name = $row['CTY_ID'].'|'.$row['CTY_NAME'].'|'.$row['STT_ID'].'|'.$row['STT_NAME'].'|'.$row['CTR_ID'].'|'.$row['CTR_NAME'];
			array_push($data, $name);	
		}	
		echo json_encode($data);
	}


	if($_GET['type'] == 'cityselect')
	{
		$stateid="";
		$statedata="";
		$countryid="";
		$countrydata="";


		//fetch state from city
		$id=$_GET['datatext'];

		$city_query = "SELECT DISTINCT CITY.STT_ID, STATE.STT_ID, STATE.STT_NAME FROM CITY, STATE WHERE CITY.CTY_ID='".$id."' AND CITY.STT_ID = STATE.STT_ID";

		$result = mysqli_query($DB_con, $city_query);	
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$stateid=$row['STT_ID'];
			$statedata=$row['STT_NAME'];
		}

		//fetch country
		$country_query = "SELECT DISTINCT STATE.CTR_ID, COUNTRY.CTR_ID, COUNTRY.CTR_NAME FROM STATE, COUNTRY WHERE STATE.STT_ID='".$stateid."' AND STATE.CTR_ID = COUNTRY.CTR_ID";

		$countryresult = mysqli_query($DB_con, $country_query);	
		while ($row = mysqli_fetch_assoc($countryresult)) 
		{
			$countryid=$row['CTR_ID'];
			$countrydata=$row['CTR_NAME'];
		}	

		//send result
		echo json_encode( array("message1" => '<option value="'.$stateid.'">'.$statedata.'</option>', "message2" => '<option value="'.$countryid.'">'.$countrydata.'</option>'));
	}


?>

