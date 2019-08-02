<?php
  require "../../config_database/config.php";
  require "../../session.php";

  $id_receive_money = $_GET['id_receive_money'];
  $status = $_GET['status'];
  $statusb = $_GET['statusb']; 

    if ($statusb == "office") {
      $update_rc_office = "UPDATE rc_receive_money SET status_office = '$status' WHERE id_receive_money = $id_receive_money";
      mysqli_query($conn,$update_rc_office);
      echo "a";
    }
    elseif ($statusb == "boss") {
      $update_rc_boss = "UPDATE rc_receive_money SET status_boss = '$status' WHERE id_receive_money = $id_receive_money";
      mysqli_query($conn,$update_rc_boss);
    }
  

  header('location:../receive_money.php');
?>