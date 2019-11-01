<?php
     require "../../config_database/config.php"; 
     $id_store = $_GET['id_store']; 
     $district_name = $_GET['district_name'];
     $sql = "DELETE FROM store WHERE id_store = $id_store";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../visit_shop2.php?district_name='.$district_name);
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>