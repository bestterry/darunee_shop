<?php 
require "../../config_database/config.php";
require "../../session.php";
$id_addorder = $_POST['id_addorder'];
$name_customer = $_POST['name_customer'];
$village = $_POST['village'];
$tel = $_POST['tel'];
$note = $_POST['note']; 
$id_product2 = $_POST['id_product2'][0];
$province_id = $_POST['province_name'];
$amphur_id = $_POST['amphur_name'];
$district_code = $_POST['district_name'];


  if (empty($_POST['request'])) {
    $request = "N";
  }else{
    $request = "Y";
  }

  if (empty($_POST['id_wd'])) {
    $id_wd = 0;
  }else{
    $id_wd  =  $id_member;
  }

  if (empty($_POST['status'])) {
    echo $status = "pending";
  }else{
    echo $status = "success";
  }

if(empty($province_id)){
   //update addorder
   $sql_Uaddorder = "UPDATE addorder SET name_customer = '$name_customer', tel = '$tel', village = '$village', note = '$note', request = '$request',
                     id_wd = $id_wd, status = '$status' 
                     WHERE id_addorder = $id_addorder";
   mysqli_query($conn,$sql_Uaddorder);
 //-update addorder
}else{
   //update addorder
   $sql_Uaddorder = "UPDATE addorder SET name_customer = '$name_customer', tel = '$tel', village = '$village', 
                     province_id = '$province_id', amphur_id = '$amphur_id', district_code = '$district_code', note = '$note', request = '$request' 
                     id_wd = $id_wd, status = '$status'
                     WHERE id_addorder = $id_addorder";
   mysqli_query($conn,$sql_Uaddorder);
 //-update addorder
} 

  //update listorder
  for ($i=0; $i < count($_POST['id_listorder']); $i++) { 
      $id_listorder = $_POST['id_listorder'][$i];
      $price = $_POST['price'][$i];
      $num = $_POST['num'][$i];
      $money = $_POST['money'][$i];

      $sql_Ulistorder = "UPDATE listorder SET num = $num, price = $price, money = $money WHERE id_listorder = $id_listorder";
      mysqli_query($conn,$sql_Ulistorder);
  }
  //-update listorder

  //add listorder
  if ($id_product2 == "list") {
  }else {
    for ($i=0; $i < count($_POST['id_product2']); $i++) { 
      $id_product2 = $_POST['id_product2'][$i];
      $price2 = $_POST['price2'][$i];
      $num2 = $_POST['num2'][$i];
      $money2 = $_POST['money2'][$i];
      $sql_Ilistorder = "INSERT INTO listorder (id_product, num, price, money, id_addorder)
                         VALUES ($id_product2, $num2, $price2, $money2, $id_addorder);";
      mysqli_query($conn,$sql_Ilistorder);
    }
  }
  //-addorder

  header('location:../list_order_des.php?id_addorder='.$id_addorder);
?>