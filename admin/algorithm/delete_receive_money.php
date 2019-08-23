<?php 
   require "../../config_database/config.php"; 
   $id_receive_money= $_GET['id_receive_money']; 
   $sql = "DELETE FROM rc_receive_money WHERE id_receive_money = $id_receive_money";
 
    if ($conn->query($sql) === TRUE) {
        header('location:../receive_money.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
?>