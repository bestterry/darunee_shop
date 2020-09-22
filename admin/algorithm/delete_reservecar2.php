<?php 
  require "../../config_database/config.php"; 
  $id_reserve_history = $_GET['id'];
  $id_member = $_GET['id_member'];
  $money = $_GET['money'];
  $money_total = $_GET['money_total'];
  $value_money = $money_total+$money;

  $sql = "DELETE FROM reserve_history WHERE id_reserve_history = $id_reserve_history";
  mysqli_query($conn,$sql);
  $update_reserve = "UPDATE reserve_money SET money = $value_money WHERE id_member = $id_member";
  mysqli_query($conn,$update_reserve);

  header('location:../reserve_datacar2.php?id_member='.$id_member);

?>