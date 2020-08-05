<?php
     require "../../config_database/config.php"; 
     $id_addorder = $_GET['id_addorder']; 
     $delete_order = "DELETE FROM addorder WHERE id_addorder = $id_addorder";
     mysqli_query($conn,$delete_order);
     $delete_list = "DELETE FROM listorder WHERE id_addorder = $id_addorder";
     mysqli_query($conn,$delete_list);
    
     header('location:../list_order.php');
     
?>