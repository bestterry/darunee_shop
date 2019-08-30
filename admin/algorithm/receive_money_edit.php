<?php 
  require "../../config_database/config.php";
  require "../../session.php";

    $id_receive_money = $_POST['id_receive_money'];
    $id_practice = $_POST['id_practice'];
    $area = $_POST['area'];
    $money = $_POST['money'];
    $id_category = $_POST['id_category'];
    $note = $_POST['note'];
    $date = $_POST['date'];

      $update_money = "UPDATE rc_receive_money SET id_practice = '$id_practice', area = '$area', money = '$money', id_category = '$id_category', note = '$note', date = '$date' WHERE id_receive_money = $id_receive_money";
      mysqli_query($conn,$update_money);

      header('location:../receive_money.php');
?>