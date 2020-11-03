<?php 
require "../../config_database/config.php";
require "../../session.php";

$total_pd = 0;
$total_pd2 = 0;
$id_numPD_Car = $_POST['id_numPD_car'];
$id_product = $_POST['id_product'];
$id_product2 = $_POST['id_product2'];
$num_befor = $_POST['num_befor'];
$num_after = $_POST['num_after'];

  $num_balance = $num_befor - $num_after;
  $update_pdcar = "UPDATE numpd_car SET num=$num_balance WHERE id_numPD_car = $id_numPD_Car";
  mysqli_query($conn,$update_pdcar);

  if ($id_product==1) {
    $total_pd = $num_after * 48;
  }elseif ($id_product==3) {
    $total_pd = $num_after * 48;
  }elseif ($id_product==5) {
    $total_pd = $num_after * 120;
  }elseif ($id_product==9) {
    $total_pd = $num_after * 24;
  }elseif ($id_product==32) {
    $total_pd = $num_after * 24;
  }elseif ($id_product==37) {
    $total_pd = $num_after * 48;
  }elseif ($id_product==39) {
    $total_pd = $num_after * 10;
  }elseif ($id_product==57) {
    $total_pd = $num_after * 120;
  }

    $check_num = "SELECT num FROM numpd_car WHERE id_product = $id_product2 AND id_member = $id_member";
    $objq_check_num = mysqli_query($conn,$check_num);
    $objr_check_num = mysqli_fetch_array($objq_check_num);
    $num = $objr_check_num['num'];

    if (!isset($num)) {
        $insert_numpd = "INSERT INTO numpd_car (num, id_product, id_member)
                          VALUE ($total_pd, $id_product2, $id_member)";
        mysqli_query($conn,$insert_numpd);  
    }else {
        $total_pd2 = $num + $total_pd;
        $update_numpd = "UPDATE numpd_car SET num = $total_pd2 WHERE id_product = $id_product2 AND id_member = $id_member";
        mysqli_query($conn,$update_numpd);
    }

    header("location:../store.php");



?>