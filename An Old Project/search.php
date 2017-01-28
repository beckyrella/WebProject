<?php 

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'job_db';

//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//get search term
$searchTerm = $_GET['term'];

//sanitize search term
//$searchTerm = Sanitize($searchTerm);

//get matched data from skills table
$datas=array();
$query = $db->query("SELECT cty_id, cty_name FROM city WHERE cty_name LIKE '%".$searchTerm."%' ORDER BY cty_name ASC");
while ($row = $query->fetch_assoc())
 {
    //$data[] = $row['cty_name'];

    $data=array();

    $data['id'] = $row['cty_id'];
    $data['label'] = $row['cty_name'];
    $data['value'] = $row['cty_name'];

    $datas[]=$data;
}

//return json data
echo json_encode($datas);

?> 