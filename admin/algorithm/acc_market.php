<?php 
    require "../../config_database/config.php";


    $date_now = date("Y-m-d H:i:s");
      
   $name_customer = $_POST['name_customer'];
   $village = $_POST['village'];
   $province_id = $_POST['province_name'];
   $amphur_id = $_POST['amphur_name'];
   $district_id = $_POST['district_name'];
   $note = $_POST['note'];
   $tel = $_POST['tel'];
   $count = COUNT($_POST['id_product']);

    $sql = "INSERT INTO acc_market (name_customer, village, district_id, amphur_id, province_id, date_acc, note, tel )
            VALUES ('$name_customer', '$village', $district_id, $amphur_id, $province_id, '$date_now', '$note', '$tel')";
            if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
            // mysqli_query($conn,$sql);

    $sql_maxid = "SELECT MAX(id_acc_market) FROM acc_market";
    $objq_maxid = mysqli_query($conn,$sql_maxid);
    $objr_maxid = mysqli_fetch_array($objq_maxid);
    $max_id_acc = $objr_maxid['MAX(id_acc_market)'];
  
  
    for ($i=0; $i < $count; $i++) { 
      $id_product = $_POST['id_product'][$i];
      $num = $_POST['num'][$i];
      $price = $_POST['price'][$i];
      $total_money = $_POST['num'][$i] * $_POST['price'][$i];
      $acc_money =  $_POST['num'][$i] * ($_POST['price'][$i]-20);
      $setment = $total_money - $acc_money;

      $sql_list = "INSERT INTO acc_market_list (id_acc_market, id_product, num_product, price, total_money, acc_money, setment)
      VALUES ($max_id_acc, $id_product, $num, $price, $total_money, $acc_money, $setment)";
      mysqli_query($conn,$sql_list);
    }


    header('location:../acc_market_sale.php');
// ?>