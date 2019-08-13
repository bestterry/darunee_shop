<?php 
  require "../../config_database/config.php";
  require "../../session.php";

    $id_receive_money = $_POST['id_receive_money'];
    $money = $_POST['money'];

      $update_money = "UPDATE rc_receive_money SET money = '$money' WHERE id_receive_money = $id_receive_money";
      mysqli_query($conn,$update_money);

      header('location:../receive_money.php');
?>