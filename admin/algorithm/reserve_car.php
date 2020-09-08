<?php 
  require "../../config_database/config.php";
  require "../../session.php";

 // print_r($_POST);
  $money = $_POST['money'];
  $money_befor = $_POST['money_befor'];
  $note = $_POST['note'];
  $total_money = $money_befor - $money;
  $date = $_POST['date'];
  $id_member = $_POST['id_member'];

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

   //-------------------------INSERT outside_buy_htr---------------------------------------
   $insert_reserve = "INSERT INTO reserve_history (money, id_list, id_member, id_member_receive, status, note,  date)
                      VALUE ($money, 2, 33, $id_member, 3, '$note', '$date')";  
    mysqli_query($conn,$insert_reserve);
   //-------------------------/INSERT outside_buy_htr---------------------------------------

    //-------------------------CHECK resere_money member ------------------------------------
    $sql_reserve2 = "SELECT * FROM reserve_money WHERE id_member = $id_member";
    $result = mysqli_query($conn,$sql_reserve2);
    if ($result->num_rows > 0) {
      $objr_result = mysqli_fetch_array($result);
      $result_money = $objr_result['money'];
      $total_money2 = $result_money + $money;
      $update_reserve2 = "UPDATE reserve_money SET money = $total_money2 WHERE id_member = $id_member";
      mysqli_query($conn,$update_reserve2);
    }else{
      $insert_reserve2 = "INSERT INTO reserve_money (money, id_member) VALUE($money, $id_member)";
      mysqli_query($conn,$insert_reserve2);
    }
    //-------------------------- //CHECK resere_money member ------------------------------------
  header('location:../reserve_car.php');
  
?>