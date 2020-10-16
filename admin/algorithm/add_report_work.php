<?php 
  require "../../config_database/config.php";

  $id_practice = $_POST['id_practice'];
  $check_in = $_POST['check_in'];

  for ($i=0; $i < COUNT($_POST['id_member']); $i++) { 
    $id_member = $_POST['id_member'][$i];

    $sql = "INSERT INTO report_office (id_member, id_practice, check_in) VALUE ($id_member, $id_practice, '$check_in')";
    mysqli_query($conn,$sql);
  }

  header('location:../report_work.php');
?>