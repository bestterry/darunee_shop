<?php 
  require "../../config_database/config.php";
  $id_company = $_GET['id_company'];
  $delete_company = "DELETE FROM bank_company WHERE id_company = $id_company";
    if($conn->query($delete_company) === true){
      $delete_bank_list = "DELETE FROM bank_list WHERE id_company = $id_company";
        if($conn->query($delete_bank_list) === true){
          $delete_bank_product = "DELETE FROM bank_product WHERE id_company = $id_company";
            if($conn->query($delete_bank_product) === true){
              header('location:../list_bank.php');
            }else{
              echo "Error การลบผิดพลาด :".$conn -> error;
            }
        }else{
          echo "Error การลบผิดพลาด :".$conn -> error;
        }
    }else{
      echo "Error การลบผิดพลาด :".$conn -> error;
    }
?>