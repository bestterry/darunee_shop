<?php

require "../../config_database/config.php"; 

$id_sent_ferti = $_GET['id_sent_ferti']; 

$sql = "DELETE FROM sent_ferti WHERE id_sent_ferti = $id_sent_ferti";

 if ($conn->query($sql) === TRUE) {
     header('location:../sent_fertilizer.php');
 } else {
     echo "Error deleting record: " . $conn->error;
 }

?>