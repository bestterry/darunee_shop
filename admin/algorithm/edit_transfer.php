<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 
  $id_transfer_list = $_POST['id_transfer_list'];
  $date = $_POST['date'];
  $name_transfer = $_POST['name_transfer'];
  $account_name = $_POST['account_name'];
  $id_transfer_pd = $_POST['id_transfer_pd'];
  $money = $_POST['money'];
  $transferor = $_POST['transferor'];
  $payment_slip = $_POST['payment_slip'];
  $note = $_POST['note'];

  $update_transfer = "UPDATE transfer_list SET date = '$date', name_transfer = '$name_transfer', account_name = '$account_name', id_transfer_pd = $id_transfer_pd, 
                          money = $money, transferor = '$transferor', payment_slip = '$payment_slip', note = '$note'
                          WHERE id_transfer_list = $id_transfer_list";
      if ($conn->query($update_transfer) === TRUE) {
        header('location:../transfer.php');
    } else {
        echo "Error: " . $update_transfer . "<br>" . $conn->error;
    }

    $conn->close();

?>