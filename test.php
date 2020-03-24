<?php
  require('config_database/config.php');

  $sql_store = "SELECT * FROM store";
  $objq_store = mysqli_query($conn,$sql_store);
  foreach ($objq_store as $value_store){
    $id_store = $value_store['id_store'];
    $district_code = $value_store['district_code'];

    $sql_district = "SELECT district_id FROM tbl_districts WHERE district_code = '$district_code'";
    $objq_district = mysqli_query($conn,$sql_district);
    $objr_district = mysqli_fetch_array($objq_district);
    $district_id = $objr_district['district_id'];

    $sql_update = "UPDATE store SET district_id = $district_id WHERE id_store = $id_store";
    if ($conn->query($sql_update) === TRUE) {
      echo "Record updated successfully".'<br>';
  } else {
      echo "Error updating record: " . $conn->error."<br>";
  }
  }
?>