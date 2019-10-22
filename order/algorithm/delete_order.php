<?php
    require "../../config_database/config.php"; 
    $id_order_list = $_GET['id_order_list'];
  
         $order_list = "DELETE FROM order_list WHERE id_order_list = $id_order_list";
         mysqli_query($conn,$order_list);
   header('location:../list_order.php');
 
?>