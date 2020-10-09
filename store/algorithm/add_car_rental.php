<?php

  require "../../config_database/config.php";
  $money = $_POST['money'];
  $id_member = $_POST['id_member1'];
  $id_practice = $_POST['id_practice'];
  $date = $_POST['date'];
  $note = $_POST['note'];
  $member_car = $_POST['member_car'];
  
  $insert_carrental = "INSERT INTO car_rental (money, id_member, member_car, id_practice, date, note)
                       VALUE ($money, $id_member, $member_car, $id_practice, '$date', '$note')";  

  if (mysqli_query($conn, $insert_carrental)) {
    header('location:../car_rental.php');
  } else {
    echo "Error: " . $insert_carrental . "<br>" . mysqli_error($conn);
  }

?>