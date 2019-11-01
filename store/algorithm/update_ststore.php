<?php
  require '../../config_database/config.php';
  $status = $_GET['status'];
  $id_store = $_GET['id_store'];
  $district_code = $_GET['district_code'];

    if ($status == "Y") {
      $update_status = "UPDATE store SET status = 'N' WHERE id_store = $id_store";
      mysqli_query($conn,$update_status);
    }else {
      $update_status = "UPDATE store SET status = 'Y' WHERE id_store = $id_store";
      mysqli_query($conn,$update_status);
    }

    header('location:../visit_shop2.php?district_name='.$district_code);
?>