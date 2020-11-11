<?php
  require "../../config_database/config.php";
  $sql = "UPDATE rc_receive_money SET status_office = 'Y',status_boss = 'Y' WHERE status_boss = 'N' AND status_office = 'N' AND money = 0";
  if ($conn->query($sql) === TRUE) {
    header('location:../receive_money.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>