<?php
  require "../../config_database/config.php";

    $id_member = $_POST['id_member'];
    $id_practice = $_POST['id_practice'];
    $money = $_POST['money'];
    $id_category = $_POST['id_category'];
    $date = $_POST['date'];

    $sql = "INSERT INTO rc_receive_money (id_member, id_practice, money, id_category, date, status_office, status_boss)
                                  VALUES ($id_member, $id_practice, $money, $id_category, '$date', 'N', 'N')";
             mysqli_query($conn,$sql);
 header('location:../receive_money.php');

?>