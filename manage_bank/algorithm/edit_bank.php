<?php 
  require "../../config_database/config.php";
  $name_company = $_POST['name_company'];
  $id_company = $_GET['id_company'];

    if(!empty($_POST['name_product'][0])){
      for ($i=0; $i < COUNT($_POST['name_product']); $i++) { 
        $name_product = $_POST['name_product'][$i];
        $insert_product = "INSERT INTO bank_product (name_product, id_company) VALUE ('$name_product', $id_company)";
        mysqli_query($conn,$insert_product);
      }
    }

    if(!empty($_POST['number_bank_list'][0])) {
      for ($i=0; $i < COUNT($_POST['number_bank_list']); $i++) { 
        $name_bank_list = $_POST['name_bank_list'][$i];
        $number_bank_list = $_POST['number_bank_list'][$i];
        $name_bank = $_POST['name_bank'][$i];
        $insert_bank_list = "INSERT INTO bank_list (name_bank_list, number_bank_list, name_bank, id_company)
                            VALUE ('$name_bank_list', '$number_bank_list', '$name_bank', $id_company)";
        mysqli_query($conn,$insert_bank_list);
      }
    }

  $update_company = "UPDATE bank_company SET name_company = '$name_company' WHERE id_company = $id_company";
  mysqli_query($conn,$update_company);


  header('location:../edit_bank.php?id_company='.$id_company);
?>