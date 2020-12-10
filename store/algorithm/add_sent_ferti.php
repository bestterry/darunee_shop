<?php
  require "../../config_database/config.php";
  $id_member = $_POST['id_member'];
  $id_car = $_POST['id_car'];
  $id_type_lift = $_POST['id_type_lift'];
  $num_cus = $_POST['num_cus'];
  $num_ferti = $_POST['num_ferti'];
  $money = $_POST['money'];
  $note = $_POST['note'];
      $sql = "INSERT INTO sent_ferti (id_member, id_car, id_type_lift, num_cus, num_ferti, money, note)
              VALUES ($id_member, $id_car, $id_type_lift, $num_cus, $num_ferti, $money, '$note')";
            
              if ($conn->query($sql) === TRUE) {
                header('location:../sent_fertilizer.php');
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
  

?>