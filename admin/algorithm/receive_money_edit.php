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

    if (empty($_POST['status_office'])) {
      echo $status_office = "N";
    }else{
      echo $status_office = "Y";
    }

    if (empty($_POST['status_boss'])) {
      echo $status_boss = "N";
    }else{
      echo $status_boss = "Y";
    }

      $update_money = "UPDATE rc_receive_money SET id_practice = '$id_practice', area = '$area', money = '$money', id_category = '$id_category', 
                       note = '$note', date = '$date', status_office = '$status_office', status_boss = '$status_boss'
                       WHERE id_receive_money = $id_receive_money";
      mysqli_query($conn,$update_money);

      header('location:../receive_money.php');
?>