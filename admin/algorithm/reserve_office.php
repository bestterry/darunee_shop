<?php 
  require "../../config_database/config.php";

  $status_lavish = $_POST['status_lavish'];
  $note = $_POST['note'];
  $date = $_POST['date'];
  $id_list = $_POST['id_list'];
  $money_befor = $_POST['money_befor'];
  $money = $_POST['money'];
  $total_money = $money_befor - $money;

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

  $insert_reserve = "INSERT INTO reserve_history (money, transfer_office, id_list, id_member, status, note,  date, status_lavish)
                     VALUE ($money, $total_money, $id_list, 33, 2, '$note', ' $date', '$status_lavish')";  
  mysqli_query($conn,$insert_reserve);
  
  header('location:../reserve_office.php');
  
?>