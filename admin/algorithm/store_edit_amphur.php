<?php 
 require "../../config_database/config.php"; 
  $district_code = $_GET['district_code'];


    $sql = "UPDATE store SET status = 'N' WHERE district_code = '$district_code' AND status = 'Y'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

    header('location:../store_search.php?district_name='.$district_code);
?>