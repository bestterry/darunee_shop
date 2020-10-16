<?php
  require "../../config_database/config.php"; 
   $id = $_GET['id'];
  
  
  $sql = "DELETE FROM report_office WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
      header('location:../report_work.php');
  } else {
      echo "Error deleting record: " . $conn->error;
  }
?>