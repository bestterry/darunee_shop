<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $company = $_POST['company'];
  $name_account = $_POST['name_account'];
  $number_account = $_POST['number_account'];
  $id_bank_list = $_POST['id_bank_list'];

  $insert_bank = "INSERT INTO bank_account (company, name_account, number_account, id_bank_list) 
                   VALUE ('$company', '$name_account', '$number_account', '$id_bank_list')";
      if ($conn->query($insert_bank) === TRUE) {
        header('location:../bank_account.php');
    } else {
        echo "Error: " . $insert_bank . "<br>" . $conn->error;
    }

    $conn->close();

 
?>