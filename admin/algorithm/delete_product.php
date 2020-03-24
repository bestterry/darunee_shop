<?php
     require "../../config_database/config.php"; 
     $id_product = $_GET['id_product']; 
     $sql = "DELETE FROM product WHERE id_product = $id_product";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../add_data.php');
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>