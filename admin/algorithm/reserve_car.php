<?php 
  require "../../config_database/config.php";
  require "../../session.php";

 // print_r($_POST);
  $money = $_POST['money'];
  $money_befor = $_POST['money_befor'];
  $total_money = $money_befor - $money;
  $date = $_POST['date'];
  $id_member = $_POST['id_member'];

  $sql_member = "SELECT name FROM member WHERE id_member = $id_member";
  $objq_member = mysqli_query($conn,$sql_member);
  $objr_member = mysqli_fetch_array($objq_member);
  $note = $objr_member['name'];

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

    //-------------------------CHECK resere_money member ------------------------------------
    $sql_reserve2 = "SELECT * FROM reserve_money WHERE id_member = $id_member";
    $result = mysqli_query($conn,$sql_reserve2);
    if ($result->num_rows > 0) {

      $objr_result = mysqli_fetch_array($result);
      $result_money = $objr_result['money'];
      $total_money2 = $result_money + $money;
      $update_reserve2 = "UPDATE reserve_money SET money = $total_money2 WHERE id_member = $id_member";
      mysqli_query($conn,$update_reserve2);
      $insert_reserve = "INSERT INTO reserve_history (money, transfer, transfer_office, id_list, id_member, id_member_receive, status, note,  date)
                         VALUE ($money, $total_money2, $total_money, 2, 33, $id_member, 3, '$note', '$date')";  
      mysqli_query($conn,$insert_reserve);

    }else{

      $insert_reserve2 = "INSERT INTO reserve_money (money, id_member) VALUE($money, $id_member)";
      mysqli_query($conn,$insert_reserve2);

      $insert_reserve = "INSERT INTO reserve_history (money, transfer, transfer_office, id_list, id_member, id_member_receive, status, note,  date)
                         VALUE ($money, $money, $total_money, 2, 33, $id_member, 3, '$note', '$date')";  
      mysqli_query($conn,$insert_reserve);
      
    }
    //-------------------------- //CHECK resere_money member ------------------------------------
  header('location:../reserve_car.php');
  
?>