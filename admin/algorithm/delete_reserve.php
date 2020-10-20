<?php 
  require "../../config_database/config.php"; 
  $id = $_GET['id'];
  $money = $_GET['money'];
  $money_total = $_GET['money_total'];
  $value_money = $money + $money_total;
  $date = date("Y-m-d");

  $insert_reserve = "INSERT INTO reserve_history (money, transfer_office, id_list, id_member, status, note,  date)
                         VALUE ($money ,$value_money, 18, 33, 2, 'รับเข้าจากลบรายการ', '$date')";  
      mysqli_query($conn,$insert_reserve);

  $sql = "UPDATE reserve_history SET status_cancen = 'N' WHERE id_reserve_history = $id";
   if ($conn->query($sql) === TRUE) {
      $update_reserve = "UPDATE reserve_money SET money = $value_money WHERE id_member = 33";
      mysqli_query($conn,$update_reserve);
       header('location:../reserve_office.php');
   } else {
       echo "Error deleting record: " . $conn->error;
   }

?>