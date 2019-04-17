<?php 
 require "../../config_database/config.php";
 require "../../session.php";
  print_r($_POST);
   $id_product = $_POST["id_product"];
   $num_befor = $_POST['num_befor'];
   $num_after = $_POST['num_after'];
   $price = $_POST['price'];
   $money = $_POST['money'];
   $note = $_POST['note'];
   $total_num = 0;
   
   $sql_numpd_car = "SELECT * FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member";
   $objq_numpd_car = mysqli_query($conn,$sql_numpd_car);
   $objr_numpd_car = mysqli_fetch_array($objq_numpd_car);
   $num_pd = $objr_numpd_car['num'];
   $total_num = $num_pd + ($num_befor - $num_after);
    
  $sql_update_h = "UPDATE sale_car_history SET num=$num_after, price=$price, money=$money, note='$note' 
                    WHERE id_product = $id_product AND id_member = $id_member";
                    mysqli_query($conn,$sql_update_h);
  $sql_update_c = "UPDATE numpd_car SET num = $total_num
                    WHERE id_product = $id_product AND id_member = $id_member";
                    mysqli_query($conn,$sql_update_c);
   header('location:../sale_product_history.php');
 ?>