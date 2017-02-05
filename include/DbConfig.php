<?php
 
	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "";
	$DB_name = "job_db";
	 
	// try
	// {
	// 	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	// 	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// }
	// catch(PDOException $e)
	// {
	// 	$e->getMessage();
	// }

	$DB_con=mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

?>