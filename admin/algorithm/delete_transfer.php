<?php
     require "../../config_database/config.php"; 
     $id_transfer_list = $_GET['id_transfer_list'];
     $sql = "DELETE FROM transfer_list WHERE id_transfer_list = $id_transfer_list";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../transfer.php');
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>