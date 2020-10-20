<?php 
  require "../../config_database/config.php";
  require "../../session.php";

    $id_receive_money = $_POST['id_receive_money'];
    $id_practice = $_POST['id_practice'];
    // $area = $_POST['area'];
    $money = $_POST['money'];
    $id_category = $_POST['id_category'];
    $customer = $_POST['customer'];
    $note = $_POST['note'];
    $date = $_POST['date'];
    $date_buy = $_POST['date_buy'];

    if (empty($_POST['status_office'])) {
       $status_office = "N";
    }else{
       $status_office = "Y";
    }

    if (empty($_POST['status_boss'])) {
       $status_boss = "N";
    }else{
       $status_boss = "Y";
       $status_office = "Y";
    }

      $update_money = "UPDATE rc_receive_money SET id_practice = '$id_practice',  money = '$money', id_category = '$id_category', 
                             customer = '$customer', note = '$note', date = '$date', date_buy = '$date_buy',status_office = '$status_office', status_boss = '$status_boss'
                       WHERE id_receive_money = $id_receive_money";
      mysqli_query($conn,$update_money);

      header('location:../receive_money.php');
?>