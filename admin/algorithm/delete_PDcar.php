<?php
  require "../../config_database/config.php"; 
  $id_numPD_car = $_GET['id_numpd_car'];

  $sql = "DELETE FROM numpd_car WHERE id_numPD_car = $id_numPD_car";

  if ($conn->query($sql) === TRUE) {
      header('location:../add_data.php');
  } else {
      echo "Error deleting record: " . $conn->error;
  }
?>