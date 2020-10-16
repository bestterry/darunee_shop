<?php 
    require "../../config_database/config.php";

    $id_practice = $_POST['id_practice'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $note = $_POST['note'];
    $id = $_POST['id'];
  
    $sql = "UPDATE report_office SET id_practice = $id_practice, check_in = '$check_in', check_out = '$check_out', note = '$note' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      header('location:../report_work.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
  
?>