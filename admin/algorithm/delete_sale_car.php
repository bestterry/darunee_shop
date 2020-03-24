<?php
  require "../../config_database/config.php"; 
  $id_sale_history = $_GET['id_sale_history'];
  $sql = "DELETE FROM sale_car_history WHERE id_sale_history = $id_sale_history";

   if ($conn->query($sql) === TRUE) {
       header('location:../sale_history.php');
   } else {
       echo "Error deleting record: " . $conn->error;
   }
?>