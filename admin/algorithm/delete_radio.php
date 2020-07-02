<?php
  require "../../config_database/config.php"; 
  $id_radio = $_GET['id_radio'];
  $sql = "DELETE FROM radio WHERE id_radio = $id_radio";

  if ($conn->query($sql) === TRUE) {
      header('location:../radio_list2.php');
  } else {
      echo "Error deleting record: " . $conn->error;
  }
?>