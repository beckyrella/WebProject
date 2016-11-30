<?php
//Include database configuration file
include('dbConfig.php');

// if(!isset($_POST["selectedCountryId"]) || !empty($_POST["selectedCountryId"]))
// {
//     echo "<script type='text/javascript'>alert('efsdssd');</script>";
// }


if(isset($_POST["selectedCountryId"]) && !empty($_POST["selectedCountryId"])){

    //echo "<script type='text/javascript'>alert('efsdssd');</script>";
    //Get all state data
    $query = $db->query("SELECT * FROM state WHERE CTR_ID = ".$_POST['selectedCountryId']." ORDER BY STT_NAME ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['STT_ID'].'">'.$row['STT_NAME'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["selectedStateId"]) && !empty($_POST["selectedStateId"])){
    //Get all city data
    $query = $db->query("SELECT * FROM city WHERE STT_ID = ".$_POST['selectedStateId']." ORDER BY CTY_NAME ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['CTY_ID'].'">'.$row['CTY_NAME'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>