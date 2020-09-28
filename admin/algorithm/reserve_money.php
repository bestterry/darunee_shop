<?php 
  require "../../config_database/config.php";
  require "../../session.php";
  $money = $_POST['money'];
  $money_befor = $_POST['money_befor'];
  $note = $_POST['note'];
  $date = $_POST['date'];
  $total_money = $money + $money_befor;

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

   //-------------------------INSERT outside_buy_htr---------------------------------------
   $insert_reserve = "INSERT INTO reserve_history (money, id_list, transfer_office, id_member, status, note, date)
   VALUE ($money, 1, $total_money, 30, 1, '$note', '$date')";  
    
    if ($conn->multi_query($insert_reserve) === TRUE) {
      header('location:../reserve_money.php');
    } else {
      echo "Error: " . $insert_reserve . "<br>" . $conn->error;
    }
    //-------------------------/INSERT outside_buy_htr---------------------------------------

  
  
?>