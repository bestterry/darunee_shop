<?php

  require "../../config_database/config.php";
  $money = $_POST['money'];
  $id_member = $_POST['id_member'];
  $id_practice = $_POST['id_practice'];
  $date = $_POST['date'];
  $note = $_POST['note'];
  
  $insert_carrental = "INSERT INTO car_rental (money, id_member, id_practice, date, note)
                       VALUE ($money, $id_member, $id_practice, '$date', '$note')";  
   mysqli_query($conn,$insert_carrental);

   header('location:../car_rental.php');

?>