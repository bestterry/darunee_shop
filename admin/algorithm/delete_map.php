<?php
  require "../../config_database/config.php"; 
   $id_map = $_GET['id_map'];
   $name_map = $_GET['name_map'];
  
  unlink( '../../images/map/' .$name_map ); 
  $sql = "DELETE FROM map WHERE id_map = $id_map";

  if ($conn->query($sql) === TRUE) {
      header('location:../map.php');
  } else {
      echo "Error deleting record: " . $conn->error;
  }
?>