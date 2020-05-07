<?php 
  require "../../config_database/config.php";
  $id_addorder = $_GET['id_addorder'];
  $status = $_GET['status'];
  if($status == 'Y'){
    $id_wd = 0;
  }else{
    $id_wd = 33;
  }

  $update_addorder = " UPDATE addorder SET id_wd = $id_wd WHERE id_addorder =  $id_addorder";
  mysqli_query($conn,$update_addorder);

  header('location:../list_order.php');
?>