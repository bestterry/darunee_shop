<?php 
  require "../../config_database/config.php";

          $status = $_GET['status'];
          $id_addorder = $_GET['id_addorder'];
          
          $sql_update = "UPDATE addorder SET status = 'success' WHERE id_addorder = $id_addorder";
          mysqli_query($conn,$sql_update);
    
  if($status = 1){
    header('location:../sent_order.php');
  }else{
    header('location:../list_order.php');
  }
    
?>