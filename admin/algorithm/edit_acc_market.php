<?php 
  //print_r($_POST);
  require "../../config_database/config.php"; 
  $id_acc_market = $_POST['id_acc_market'];
  $name_customer = $_POST['name_customer'];
  $village = $_POST['village'];
  $tel = $_POST['tel'];
  $note = $_POST['note'];

  //edit address
  $sql_update = "UPDATE acc_market SET name_customer='$name_customer', village='$village', note = '$note', tel='$tel' WHERE id_acc_market = $id_acc_market";
  $objq_update = mysqli_query($conn,$sql_update);
  //edit address

  //edit_product
  $id_acc_market_list = $_POST['id_acc_market_list'];
  $num_product = $_POST['num_product'];
  //-edit_product

  //add_product
  for ($i=0; $i < COUNT($_POST['id_product2']); $i++) { 
    $id_product2 = $_POST['id_product2'][$i];
    $num_product2 = $_POST['num_product2'][$i];
    $price2 = $_POST['price2'][$i];
    $total_money2 =  $_POST['num_product2'][$i] * $_POST['price2'][$i];
    $acc_money2 = $_POST['num_product2'][$i] * ($_POST['price2'][$i]-20);
    $setment2 = ($_POST['num_product2'][$i] * 20);

    $insert_list_acc = "INSERT INTO acc_market_list (id_acc_market, id_product, num_product, price, total_money, acc_money, setment) 
                        VALUE ($id_acc_market, $id_product2, $num_product2, $price2, $total_money2, $acc_money2, $setment2)";
    mysqli_query($conn,$insert_list_acc);
  }
  
 header('location:../acc_market_edit.php?id_acc_market='.$id_acc_market);
?>