<?php 
  require "../../config_database/config.php";
  
  $id_addorder = $_GET['id_addorder'];
          
  $sql_update = "UPDATE addorder SET status = 'success' WHERE id_addorder = $id_addorder";
  mysqli_query($conn,$sql_update);


    header('location:../sent_order.php');
?>