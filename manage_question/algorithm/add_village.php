<?php 
  require "../../config_database/config.php";
  $name_village = $_POST['name_village'];
  $district_id = $_POST['district_id'];

  $insert_village = "INSERT INTO tbl_village (name_village, district_id) VALUE ('$name_village', $district_id)";
  mysqli_query($conn,$insert_village);

  header('location:../manage_village.php');
?>