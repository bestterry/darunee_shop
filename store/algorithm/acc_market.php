<?php 
// print_r($_POST);
  $name_customer = $_POST['name_customer'];
  $village = $_POST['village'];
  $id_province = $_POST['province_name'];
  $id_amphur = $_POST['amphur_name'];
  $id_district = $_POST['district_name'];

  $count = COUNT($_POST['id_product']);
  
    for ($i=0; $i < $count; $i++) { 
      $id_product = $_POST['id_product'][$i];
      $num = $_POST['num'][$i];
      $price = $_POST['price'][$i];
     echo $total_money = $_POST['num'][$i] * $_POST['price'][$i].'<br>';
     echo $acc_money =  $_POST['num'][$i] * ($_POST['price'][$i]-20).'<br>';
    }
  

?>