<?php 
  require "../../config_database/config.php";
  require "../../session.php";

  print_r($_POST);
  $money = $_POST['money'];
  $money_befor = $_POST['money_befor'];
  $note = $_POST['note'];
  $total_money = $money_befor - $money;
  $date = $_POST['date'];
  $id_list = $_POST['id_list'];

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

   //-------------------------INSERT outside_buy_htr---------------------------------------
   $insert_reserve = "INSERT INTO reserve_history (money, id_list, id_member, status, note,  date)
   VALUE ($money, $id_list, 33, 2, '$note', ' $date')";  
    mysqli_query($conn,$insert_reserve);
    //-------------------------/INSERT outside_buy_htr---------------------------------------

  header('location:../reserve_office.php');
  
?>