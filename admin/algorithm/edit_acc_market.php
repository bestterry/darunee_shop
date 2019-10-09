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

  //edit_id_acc_market_list
  for ($i=0; $i < COUNT($_POST['id_acc_market_list']); $i++) { 
    $id_acc_market_list = $_POST['id_acc_market_list'][$i];
    $num_product = $_POST['num_product'][$i];
    $price = $_POST['price'][$i];
    $total_money =  $_POST['num_product'][$i] * $_POST['price'][$i];
    $acc_money = $_POST['num_product'][$i] * ($_POST['price'][$i]-20);
    $setment = ($_POST['num_product'][$i] * 20);

    $update_list_acc = "UPDATE acc_market_list SET num_product=$num_product, price=$price, total_money = $total_money, acc_money=$acc_money, setment=$setment 
                        WHERE id_acc_market_list = $id_acc_market_list";
    mysqli_query($conn,$update_list_acc);
  }
  //-edit_id_acc_market_list

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