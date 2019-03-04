<?php
require "../../config_database/config.php";
require "../../session.php";
  $id_price_draw = $_POST["id_price_product"];
  $befor_num = $_POST['befor_num'];
  $after_num = $_POST['after_num'];
  $price = $_POST['price'];
  $money = $_POST['money'];
  $note = $_POST['note'];

    $sql_draw = " SELECT * FROM price_history WHERE id_price_history='$id_price_draw'";
    $objq_draw = mysqli_query($conn,$sql_draw);
    $objr_draw = mysqli_fetch_array($objq_draw);
    $id_product = $objr_draw['id_product'];

    $sql_num = "SELECT * FROM num_product WHERE id_product = '$id_product' AND id_zone = '$id_zone'";
    $objq_num = mysqli_query($conn,$sql_num);
    $objr_num = mysqli_fetch_array($objq_num);
    $num_product = $objr_num['num'];

  if($after_num > $befor_num){
    $total_num = $after_num-$befor_num;
    echo $total_num_product = $num_product-$total_num;
  }
  else {
    $total_num = $befor_num-$after_num;
    echo $total_num_product = $num_product+$total_num;
    }
    
    ///update จำนวนคงเหลือของสินค้า
    $update_product = "UPDATE num_product SET num = $total_num_product WHERE id_product = '$id_product' AND id_zone = '$id_zone'";
    mysqli_query($conn,$update_product);
    // update ประวัติการขาย
    $update_draw = "UPDATE price_history SET num = '$after_num',price= $price,money = '$money', note = '$note' WHERE id_price_history = '$id_price_draw'";
    mysqli_query($conn,$update_draw);

  header('location:../sale_history.php');
?>