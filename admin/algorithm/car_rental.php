<?php 
 require "../../config_database/config.php"; 
 $status = $_GET['status'];
 $id_carrental = $_POST['id_carrental'];
 $id_practice = $_POST['id_practice'];
 $member_car = $_POST['member_car'];
 $money = $_POST['money'];
 $date = $_POST['date'];
 $note = $_POST['note'];

    $sql = "UPDATE car_rental SET money = $money, id_practice=$id_practice, date = '$date', note = '$note', member_car = $member_car
            WHERE id_carrental = $id_carrental";
    mysqli_query($conn,$sql);

    if ($status == 'checkday') {
      header('location:../car_rentalday.php?day='.$date);
    }else {
      header('location:../car_rental.php');
    }
    $conn->close();

?>