<?php
  require "../../config_database/config.php";
  $id_company = $_GET['id_company'];
  $id_bank_list = $_GET['id_bank_list'];
  $delete_bank_list = "DELETE FROM bank_list WHERE id_bank_list = $id_bank_list";

  if ($conn->query($delete_bank_list) === TRUE) {
    header('location:../edit_bank.php?id_company='.$id_company);
  } else {
    echo "Error deleting record: " . $conn->error;
  }
?>