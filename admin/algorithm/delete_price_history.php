<?php
     require "../../config_database/config.php"; 
     $id_price_history = $_GET['id_price_history']; 
     $sql = "DELETE FROM price_history WHERE id_price_history = $id_price_history";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../sale_history.php');
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>