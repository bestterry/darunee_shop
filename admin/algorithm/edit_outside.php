<?php 
  require '../../config_database/config.php';
  print_r($_POST);
    $id_outside_buy = $_POST['id_outside_buy'];
    $id_product = $_POST['id_product'];
    $num_pd = $_POST['num_pd'];
    $price_pd = $_POST['price_pd'];
    $purch_money = $_POST['purch_money'];
    $pay_money = $_POST['pay_money'];
    $account_rc = $_POST['account_rc'];
    $date_buy = $_POST['date_buy'];
    
    if($id_product == 35){
      $update_outside_buy1 = "UPDATE outside_buy_htr SET id_product = $id_product, pay_money = $pay_money, account_rc = '$account_rc', date_buy = '$date_buy' 
                             WHERE id_outside_buy = $id_outside_buy";
      mysqli_query($conn,$update_outside_buy1);
    }else{
      $update_outside_buy = "UPDATE outside_buy_htr SET id_product = $id_product, num_pd = $num_pd, price_pd = $price_pd, 
                          purch_money = $purch_money, account_rc = '$account_rc', date_buy = '$date_buy' WHERE id_outside_buy = $id_outside_buy";
      mysqli_query($conn,$update_outside_buy);
    }
    header('location:../outside_list.php?id_outside='.$_POST['id_outside']);
?>