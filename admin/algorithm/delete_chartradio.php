<?php
  require "../../config_database/config.php"; 
   $id_chart = $_GET['id_chart'];
   $name_chart = $_GET['name_chart'];
  
  unlink( '../../images/radio_chart/' .$name_chart ); 
  $sql = "DELETE FROM radio_chart WHERE id_chart = $id_chart";

  if ($conn->query($sql) === TRUE) {
      header('location:../radio_chart.php');
  } else {
      echo "Error deleting record: " . $conn->error;
  }
?>