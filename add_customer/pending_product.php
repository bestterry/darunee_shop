<?php
  print_r($_POST);
  include("db_connect.php");
  $mysqli = connect();
  $sql_addorder = "SELECT * FROM addorder WHERE status = 'pending'";
  $objq_addorder = mysqli_query($mysqli,$sql_addorder);
   while($value = $objq_addorder->fetch_assoc()){
     $id_addorder = $value['id_addorder'];
    $update_status = "UPDATE addorder SET status = 'success' WHERE id_addorder = $id_addorder";
    mysqli_query($mysqli,$update_status);
  }

  for ($i=0; $i < count($_POST['id_addorder']); $i++) { 
    $id_addorder = $_POST['id_addorder'][$i];
    $update_status = "UPDATE addorder SET status = 'pending' WHERE id_addorder = $id_addorder";
    mysqli_query($mysqli,$update_status);
  }

  header('location:list_order.php');
?>