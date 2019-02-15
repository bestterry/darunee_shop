<?php
  require "../../config_database/config.php";
  $id_sale = $_GET['id_sale'];
  $sql = "DELETE FROM sale_history WHERE id_sale_history = '$id_sale'";
  mysqli_query($conn,$sql);
  header('location:../sale_history.php');
?>