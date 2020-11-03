<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $date = $_POST['date'];
  $name_transfer = $_POST['name_transfer'];
  $account_name = $_POST['account_name'];
  $id_product = $_POST['id_product'];
  $money = $_POST['money'];
  $transferor = $_POST['transferor'];
  $payment_slip = $_POST['payment_slip'];
  $note = $_POST['note'];

  $transfer_list = "INSERT INTO transfer_list (date, name_transfer, account_name, id_product, money, transferor, payment_slip, note) 
                                        VALUE ('$date','$name_transfer','$account_name',$id_product,$money,'$transferor','$payment_slip', '$note')";
      if ($conn->query($transfer_list) === TRUE) {
        header('location:../transfer.php');
    } else {
        echo "Error: " . $transfer_list . "<br>" . $conn->error;
    }

    $conn->close();

?>