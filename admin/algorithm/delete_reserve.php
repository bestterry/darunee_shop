<?php 
  require "../../config_database/config.php"; 
  $id = $_GET['id'];
  $money = $_GET['money'];
  $money_total = $_GET['money_total'];
  $value_money = $money + $money_total;

  $sql = "DELETE FROM reserve_history WHERE id_reserve_history = $id";
   if ($conn->query($sql) === TRUE) {
      $update_reserve = "UPDATE reserve_money SET money = $value_money WHERE id_member = 33";
      mysqli_query($conn,$update_reserve);
       header('location:../reserve_office.php');
   } else {
       echo "Error deleting record: " . $conn->error;
   }

?>