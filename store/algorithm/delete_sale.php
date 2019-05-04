<?php 
  require "../../config_database/config.php";
  require "../../session.php";
  $id_sale = $_GET['id_sale'];

  $check_sale = "SELECT * FROM sale_car_history WHERE id_sale_history = $id_sale";
  $objq_sale_history = mysqli_query($conn,$check_sale);
  $objr_sale_history = mysqli_fetch_array($objq_sale_history);

    $num1 = $objr_sale_history['num'];
    $id_product = $objr_sale_history['id_product'];
    $id_member = $objr_sale_history['id_member'];

    $check_numpd = "SELECT * FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member";
    $objq_numpd = mysqli_query($conn,$check_numpd);
    $objr_numpd = mysqli_fetch_array($objq_numpd);
    $num2 = $objr_numpd['num'];

    if(!isset($num2)){
        $insert_numpd = "INSERT INTO numpd_car (num, id_product, id_member) VALUES ($num1, $id_product, $id_member)";
        mysqli_query($conn,$insert_numpd);
    }else{
      $total_num = $num1 +$num2;
      //update numpd_car
        $update_numpd = "UPDATE numpd_car SET num = $total_num WHERE id_product = $id_product AND id_member = $id_member";
        mysqli_query($conn,$update_numpd);
    }
  //
    $delete_salecar = "DELETE FROM sale_car_history WHERE id_sale_history = $id_sale";
    mysqli_query($conn,$delete_salecar);  

    header('location:../sale_product_history.php');
  
?>