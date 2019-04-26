<?php 
require "../../config_database/config.php";
require "../../session.php";

$total_pd = 0;
$total_pd2 = 0;
$id_numproduct = $_POST['id_numproduct'];
$id_product = $_POST['id_product'];
$id_product2 = $_POST['id_product2'];
$num_befor = $_POST['num_befor'];
$num_after = $_POST['num_after'];

  $num_balance = $num_befor - $num_after;
  
  $update_pd = "UPDATE num_product SET num=$num_balance WHERE id_numproduct = $id_numproduct";
  mysqli_query($conn,$update_pd);

  if ($id_product==1) {
    $total_pd = $num_after * 48;
  }elseif ($id_product==3) {
    $total_pd = $num_after * 48;
  }elseif ($id_product==5) {
    $total_pd = $num_after * 120;
  }elseif ($id_product==9) {
    $total_pd = $num_after * 24;
  }

    $check_num = "SELECT num FROM num_product WHERE id_product = $id_product2 AND id_zone = $id_zone";
    $objq_check_num = mysqli_query($conn,$check_num);
    $objr_check_num = mysqli_fetch_array($objq_check_num);
    echo $num = $objr_check_num['num'];
    
    if (!isset($num)) {
        $insert_numpd = "INSERT INTO num_product (num, id_product, id_zone)
                          VALUE ($total_pd, $id_product2, $id_zone)";
        mysqli_query($conn,$insert_numpd);  
    }else {
        $total_pd2 = $num + $total_pd;
        $update_numpd = "UPDATE num_product SET num = $total_pd2 WHERE id_product = $id_product2 AND id_zone = $id_zone";
        mysqli_query($conn,$update_numpd);
    }

    header("location:../../product.php");



?>