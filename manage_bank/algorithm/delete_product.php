<?php
  require "../../config_database/config.php";
  $id_company = $_GET['id_company'];
  $id_product = $_GET['id_product'];
  $delete_product = "DELETE FROM bank_product WHERE id_product = $id_product";

  if ($conn->query($delete_product) === TRUE) {
    header('location:../edit_bank.php?id_company='.$id_company);
  } else {
    echo "Error deleting record: " . $conn->error;
  }
?>