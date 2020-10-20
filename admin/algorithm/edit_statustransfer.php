<?php 
 require "../../config_database/config.php"; 
 require "../../session.php"; 

    $id_transfer_list = $_GET['id_transfer_list'];
    $status_pay = $_GET['status_pay'];

    $sql = "UPDATE transfer_list SET status_pay = '$status_pay' WHERE id_transfer_list = $id_transfer_list";

    if ($conn->query($sql) === TRUE) {
      header('location:../transfer.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   
?>