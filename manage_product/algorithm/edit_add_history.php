<?php
require "../../config_database/config.php";
require "../../session.php";

$id_add_history = $_POST["id_add_history"];
$befor_num = $_POST['befor_num'];
$after_num = $_POST['after_num'];

$sql_add = " SELECT * FROM add_history WHERE id_add_history = $id_add_history"; 
$objq_add = mysqli_query($conn,$sql_add);
$objr_add = mysqli_fetch_array($objq_add);
$id_product = $objr_add['id_product'];

$sql_num = "SELECT * FROM num_product WHERE id_product = '$id_product' AND id_zone = '$id_zone'";
$objq_num = mysqli_query($conn,$sql_num);
$objr_num = mysqli_fetch_array($objq_num);
$id_numproduct = $objr_num['id_numproduct'];
$num_product = $objr_num['num'];

  if($after_num > $befor_num){
    $total_num = $after_num-$befor_num;
    $total_num_product = $num_product+$total_num;
  }
  else {
    $total_num = $befor_num-$after_num;
   $total_num_product = $num_product-$total_num;
  }

$update_product = "UPDATE num_product SET num = '$total_num_product' WHERE id_numproduct = '$id_numproduct'";
mysqli_query($conn,$update_product);

$update_add = "UPDATE add_history SET num_add = '$after_num' WHERE id_add_history = '$id_add_history'";
mysqli_query($conn,$update_add);

header('location:../add_history.php');
?>