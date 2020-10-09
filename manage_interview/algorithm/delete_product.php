<?php
  require "../../config_database/config.php"; 
    $id_iv_product = $_GET['id_iv_product'];
    $id_interview = $_GET['id_interview'];
    $sql = "DELETE FROM interview_product WHERE id_iv_product = $id_iv_product";

   if ($conn->query($sql) === TRUE) {
       header('location:../edit_interview.php?id_interview='.$id_interview);
   } else {
       echo "Error deleting record: " . $conn->error;
   }
?>