<?php
  require "../../config_database/config.php";
  $id_addorder = $_GET['id_addorder'];
  $id_listorder = $_GET['id_listorder'];

  $delete_listorder = "DELETE FROM listorder WHERE id_listorder = $id_listorder";
  mysqli_query($conn,$delete_listorder);

  header('location:../edit_list_order.php?id_addorder='.$id_addorder);
?>