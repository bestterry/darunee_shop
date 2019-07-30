<?php
  require "../../config_database/config.php";
  $id_addorder = $_GET['id_addorder'];

  $delete_addorder = "DELETE FROM addorder WHERE id_addorder = $id_addorder";
  mysqli_query($conn,$delete_addorder);

  $select_list = "SELECT * FROM listorder WHERE id_addorder = $id_addorder";
  $objq_list = mysqli_query($conn,$select_list);
  while($value = $objq_list->fetch_assoc())
  {
    $delete_listorder = "DELETE FROM addorder WHERE id_addorder = $id_addorder";
    mysqli_query($conn,$delete_listorder);
  }

  header('location:../sent_order.php');
?>