<?php 
  require "../../config_database/config.php";
  $name_company = $_POST['name_company'];
  $a = count($_POST['number_bank_list']);
  $b = count($_POST['name_product']);

  $sql_maxid = "SELECT MAX(id_company) FROM bank_company";
  $objq_maxid = mysqli_query($conn,$sql_maxid);
  if ($objq_maxid->num_rows > 0) {
    $objr_maxid = mysqli_fetch_array($objq_maxid);
    $id_company = $objr_maxid['MAX(id_company)']+1;
  } else {
    $id_company = 1;
  }

  $insert_company = "INSERT INTO bank_company (name_company) VALUE ('$name_company')";
  mysqli_query($conn,$insert_company);

  for ($i=0; $i < $a; $i++) { 
    $name_bank_list = $_POST['name_bank_list'][$i];
    $number_bank_list = $_POST['number_bank_list'][$i];
    $name_bank = $_POST['name_bank'][$i];

    $insert_banklist = "INSERT INTO bank_list (name_bank_list, number_bank_list, name_bank, id_company)
                        VALUE ('$name_bank_list', '$number_bank_list', '$name_bank', $id_company)";
    mysqli_query($conn,$insert_banklist);

  }

  for ($i=0; $i < $b; $i++) { 
    $name_product = $_POST['name_product'][$i];

    $insert_bankproduct = "INSERT INTO bank_product (name_product, id_company)
                           VALUE ('$name_product', $id_company)";
    mysqli_query($conn,$insert_bankproduct);

  }

  header('location:../list_bank.php');
?>