<?php
require "../../config_database/config.php";
require "../../session.php";

  $id_draw_history = $_POST["id_draw_history"];
  $befor_num = $_POST['befor_num'];
  $after_num = $_POST['after_num'];

  $sql_draw = " SELECT * FROM draw_history WHERE id_draw_history = $id_draw_history"; 
  $objq_draw = mysqli_query($conn,$sql_draw);
  $objr_draw = mysqli_fetch_array($objq_draw);
  $id_product = $objr_draw['id_product'];

  $sql_num = "SELECT * FROM num_product WHERE id_product = '$id_product' AND id_zone = '$id_zone'";
  $objq_num = mysqli_query($conn,$sql_num);
  $objr_num = mysqli_fetch_array($objq_num);
  $id_numproduct = $objr_num['id_numproduct'];
  $num_product = $objr_num['num'];

    if($after_num > $befor_num){
      $total_num = $after_num-$befor_num;
      echo $total_num_product = $num_product-$total_num;
    }
    else {
      $total_num = $befor_num-$after_num;
     echo $total_num_product = $num_product+$total_num;
    }

  $update_product = "UPDATE num_product SET num = '$total_num_product' WHERE id_numproduct = '$id_numproduct'";
  mysqli_query($conn,$update_product);

  $update_draw = "UPDATE draw_history SET num_draw = '$after_num' WHERE id_draw_history = '$id_draw_history'";
  mysqli_query($conn,$update_draw);

  header('location:../draw_history.php');
?>