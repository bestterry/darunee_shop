<?php 
require "../../config_database/config.php";
require "../../session.php";
print_r($_POST);
$id_addorder = $_POST['id_addorder'];
$name_customer = $_POST['name_customer'];
$village = $_POST['village'];
$tel = $_POST['tel'];
$note = $_POST['note']; 
$id_product2 = $_POST['id_product2'][0];

  //update addorder
    // $sql_Uaddorder = "UPDATE addorder SET name_customer = '$name_customer', tel = '$tel', village = '$village', note = '$note' WHERE id_addorder = $id_addorder";
    // mysqli_query($conn,$sql_Uaddorder);
  //-update addorder

  //update listorder
  for ($i=0; $i < count($_POST['id_product']); $i++) { 
      $id_product = $_POST['id_product'][$i];
      $num_a = $_POST['num'][$i];
      $sql_numcar = "SELECT * FROM numpd_car WHERE id_member = $id_member AND id_product = $id_product";
      $objq_numcar = mysqli_query($conn,$sql_numcar);
      $objr_numcar = mysqli_fetch_array($objq_numcar);
      $num_b = $objr_numcar['num'];
      echo '<br>'.$id_product.' : '.$num_a.'-'.$num_b;
  }
  //-update listorder

  //add listorder
  if ($id_product2 == "list") {
  }else {
    for ($i=0; $i < count($_POST['id_product2']); $i++) { 
      $id_product2 = $_POST['id_product2'][$i];
      $num2 = $_POST['num2'][$i];
      
    //   $sql_Ilistorder = "INSERT INTO listorder (id_product, num, id_addorder)
    //                      VALUES ($id_product2, $num2, $id_addorder);";
    //   mysqli_query($conn,$sql_Ilistorder);
     }
  }
  //-addorder

  //header('location:../edit_list_order.php?id_addorder='.$id_addorder);
?>