<?php 
  require "../../config_database/config.php";

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


  if (empty($_POST['status'])) {
     $status = "pending";
  }else{
     $status = "success";
  }

  if (empty($_POST['status_num'])) {
    $status_num = "N";
  }else{
    $status_num = "Y";
  }

  if(empty($province_id)){
    $sql_Uaddorder = "UPDATE addorder SET name_customer = '$name_customer', tel = '$tel', village = '$village', 
                      note = '$note', request = '$request', status = '$status', status_num = '$status_num'
                      WHERE id_addorder = $id_addorder";
    mysqli_query($conn,$sql_Uaddorder);
  }else{
    $sql_Uaddorder = "UPDATE addorder SET name_customer = '$name_customer', tel = '$tel', village = '$village', 
                      province_id = $province_id, amphur_id = $amphur_id, district_code = $district_code, note = '$note',
                       request = '$request', status = '$status', status_num = '$status_num'
                      WHERE id_addorder = $id_addorder";
    mysqli_query($conn,$sql_Uaddorder);
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

  if (empty($_POST['id_wd'])) {
    $update_wd = "UPDATE addorder SET id_wd = 0 WHERE id_addorder = $id_addorder";
    mysqli_query($conn,$update_wd);
  }else{
    echo '2';
  }
  header('location:../list_order.php');
?>