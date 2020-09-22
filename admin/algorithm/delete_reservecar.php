<?php 
  require "../../config_database/config.php"; 
  $id_reserve_history = $_GET['id'];
  $id_member = $_GET['id_member'];
  $money = $_GET['money'];
  $money_total = $_GET['money_total'];
  $value_money = $money_total+$money;

  $sql_money = "SELECT money FROM reserve_money WHERE id_member = $id_member";
  $objq_money = mysqli_query($conn,$sql_money);
  $objr_money = mysqli_fetch_array($objq_money);
  $money_reserve = $objr_money['money'];
  $money_car = $money_reserve-$money;
  $update_reservecar = "UPDATE reserve_money SET money = $money_car WHERE id_member = $id_member";
  mysqli_query($conn,$update_reservecar);

  $sql = "DELETE FROM reserve_history WHERE id_reserve_history = $id_reserve_history";
  mysqli_query($conn,$sql);
  $update_reserve = "UPDATE reserve_money SET money = $value_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

  header('location:../reserve_car.php');

?>