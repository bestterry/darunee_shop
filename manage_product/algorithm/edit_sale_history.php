<?php
require "../../config_database/config.php";
  echo $id_draw = $_POST["id_draw"];
  $befor_num = $_POST['befor_num'];
  $after_num = $_POST['after_num'];
  $pricepernum = $_POST['pricepernum'];
  $price = $_POST['price'];
  $note = $_POST['note'];

  if($after_num > $befor_num){
    $total_num = $after_num-$befor_num;
    $sql_draw = " SELECT * FROM sale_history INNER JOIN product
                  ON product.id_product = sale_history.id_product 
                  WHERE sale_history.id_sale_history='$id_draw'";
    $objq_draw = mysqli_query($conn,$sql_draw);
    $objr_draw = mysqli_fetch_array($objq_draw);
    $id_product = $objr_draw['id_product'];
    $num_product = $objr_draw['num_product'];
    $total_num_product = $num_product-$total_num;

    $update_product = "UPDATE product SET num_product = '$total_num_product' WHERE id_product = '$id_product'";
    mysqli_query($conn,$update_product);

    $update_draw = "UPDATE sale_history SET num_sale = '$after_num',pricepernum = $pricepernum,price = '$price', note = '$note' WHERE id_sale_history = '$id_draw'";
    mysqli_query($conn,$update_draw);
  }
  else {
    $total_num = $befor_num-$after_num;
    $sql_draw = " SELECT * FROM sale_history INNER JOIN product
                  ON product.id_product = sale_history.id_product 
                  WHERE sale_history.id_sale_history='$id_draw'";
    $objq_draw = mysqli_query($conn,$sql_draw);
    $objr_draw = mysqli_fetch_array($objq_draw);
    $id_product = $objr_draw['id_product'];
    $num_product = $objr_draw['num_product'];
    $total_num_product = $num_product+$total_num;

    $update_product = "UPDATE product SET num_product = '$total_num_product' WHERE id_product = '$id_product'";
    mysqli_query($conn,$update_product);

    $update_draw = "UPDATE sale_history SET num_sale = '$after_num',pricepernum = $pricepernum ,price = '$price', note = '$note' WHERE id_sale_history = '$id_draw'";
    mysqli_query($conn,$update_draw);
  }
  header('location:../sale_history.php');
?>