<?php 
 require "../../config_database/config.php"; 
 $id_acc_market_list = $_GET['id_acc_market_list'];
 $id_acc_market = $_GET['id_acc_market'];

 $sql = "DELETE FROM acc_market_list WHERE id_acc_market_list = $id_acc_market_list";
 
 if ($conn->query($sql) === TRUE) {
     header('location:../acc_market_edit.php?id_acc_market='.$id_acc_market);
 } else {
     echo "Error deleting record: " . $conn->error;
 }
?>