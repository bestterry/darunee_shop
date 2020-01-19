<?php 
  require "../../config_database/config.php";
  require "../../session.php";

  $id_member = $_POST['id_member'];
  $id_rs_list = $_POST['id_rs_list'];
  $date = $_POST['date'];
  $money = $_POST['money'];
  $note = $_POST['note'];

  $insert_rc_history = "INSERT INTO rs_history (id_member, id_rs_list, money_rs, status, note) 
                        VALUE ($id_member, $id_rs_list,$money,'withdraw','$note')";
                  if ($conn->query($insert_rc_history) === TRUE) {
                  echo "New record created successfully";
                  } else {
                  echo "Error: " . $insert_rc_history . "<br>" . $conn->error;
                  }

  $conn->close();

  header('location:../reserve_money.php');

?>