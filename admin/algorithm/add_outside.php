<?php 
  //print_r($_POST);
  require "../../config_database/config.php";
  $id_outside = $_POST['id_outside'];
  $id_zone = $_POST['id_zone'];
  $account_rc = $_POST['name_zone'];
  $total_money = 0;
  $date_data = date("Y-m-d");;
  $date_buy = $_POST['date_buy'];
  $sql_outside = "SELECT * FROM outside WHERE id_outside = $id_outside";
  $objq_outside = mysqli_query($conn,$sql_outside);
  $objr_outside = mysqli_fetch_array($objq_outside);
  $data_outside = $objr_outside['name'].' '.$objr_outside['province'];
  
    for ($i=0; $i < COUNT($_POST['id_product']); $i++) { 
      $money = 0;
      $total_num = 0;
      $id_product = $_POST['id_product'][$i];
      $id_numpd = $_POST['id_numproduct'][$i];
      $num_pd = $_POST['num_pd'][$i];
      $price_pd = $_POST['price_pd'][$i];
      $money = $_POST['num_pd'][$i] * $_POST['price_pd'][$i];

      $sql_maxid = "SELECT MAX(id_outside_buy) FROM outside_buy_htr WHERE id_outside = $id_outside";
      $objq_maxid = mysqli_query($conn,$sql_maxid);
      $objr_maxid = mysqli_fetch_array($objq_maxid);
      $max_id = $objr_maxid['MAX(id_outside_buy)'];

      if(!isset($max_id)){
      //-------------------------INSERT outside_buy_htr if-have't data---------------------------------------
        $insert_outside_htr = "INSERT INTO outside_buy_htr (id_outside, id_product, id_zone, num_pd, price_pd, purch_money, balance, account_rc, date_buy, date_data)
                               VALUE ($id_outside, $id_product, $id_zone, $num_pd, $price_pd, $money, $money, '$account_rc', '$date_buy', '$date_data')";  
       mysqli_query($conn,$insert_outside_htr);
      //-------------------------/INSERT outside_buy_htr---------------------------------------
      }else {
       //-------------------------INSERT outside_buy_htr if-have Data---------------------------------------
        $sql_balance = "SELECT balance FROM outside_buy_htr WHERE id_outside_buy = $max_id";
        $objq_balance = mysqli_query($conn,$sql_balance);
        $objr_balance = mysqli_fetch_array($objq_balance);
        $balance = $objr_balance['balance'];
        
          $t_balance = $money + $balance;
          $insert_outside_htr = "INSERT INTO outside_buy_htr (id_outside, id_product, id_zone, num_pd, price_pd, purch_money, balance, account_rc, date_buy, date_data)
                                VALUE ($id_outside, $id_product, $id_zone, $num_pd, $price_pd, $money, $t_balance, '$account_rc', '$date_buy', '$date_data')";  
         mysqli_query($conn,$insert_outside_htr);
        //-------------------------/INSERT outside_buy_htr---------------------------------------
      }

      //   //-------------------------INSERT price_history---------------------------------------
        $insert_price_history = "INSERT INTO price_history (num, price, money, id_product, status, id_zone, note)
                               VALUE ($num_pd, $price_pd, $money, $id_product, 'sale', $id_zone, '$data_outside')";  
        mysqli_query($conn,$insert_price_history);
      //   //-------------------------/INSERT price_history---------------------------------------

      //   //-------------------------UPDATE update_numpd---------------------------------------
        $sql_numpd = "SELECT num FROM num_product WHERE id_numproduct = $id_numpd";
        $objq_numpd = mysqli_query($conn,$sql_numpd);
        $objr_numpd = mysqli_fetch_array($objq_numpd);
        $numpd = $objr_numpd['num'];
        $total_num = $numpd - $num_pd;

        $update_numpd = "UPDATE num_product SET num = '$total_num' WHERE id_numproduct ='$id_numpd'";
        mysqli_query($conn,$update_numpd);
      // //   //-------------------------/INSERT price_history---------------------------------------
      
      $total_money = $total_money + $money;
    }
        $outside_indebt= "INSERT INTO outside_indebt(money, id_outside, status)
                          VALUE ($total_money, $id_outside, 'add')";  
        mysqli_query($conn,$outside_indebt);

    header('location:../outside.php');
?>