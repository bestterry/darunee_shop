<?php
  require "../../config_database/config.php"; 
    $id_iv_plance = $_GET['id_iv_plance'];
    $id_interview = $_GET['id_interview'];
    $sql = "DELETE FROM interview_plance WHERE id_iv_plance = $id_iv_plance";

   if ($conn->query($sql) === TRUE) {
       header('location:../edit_interview.php?id_interview='.$id_interview);
   } else {
       echo "Error deleting record: " . $conn->error;
   }
?>