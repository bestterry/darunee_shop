<?php 
  require "../../config_database/config.php";
  $id_member = $_GET['id_member'];
  $id_addorder = $_GET['id_addorder'];

  $update_addorder = " UPDATE addorder SET id_wd = $id_member WHERE id_addorder =  $id_addorder";
  mysqli_query($conn,$update_addorder);

  header('location:../sent_order.php');
?>