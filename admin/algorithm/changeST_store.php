<?php
  require "../../config_database/config.php"; 
  echo $status = $_GET['status'];
  echo $amphur_id = $_GET['amphur_name'];

  if ($status == 'N') {
     $status_change = 'Y';
  }else {
    $status_change = 'N';
  }

  $sql_update = "UPDATE store SET status = '$status_change' WHERE amphur_id = $amphur_id";
  mysqli_query($conn,$sql_update);

  header('location:../store.php');
?>