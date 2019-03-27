<?php
  require "../../config_database/config.php";
  $id = $_GET['id'];

  $sql = "DELETE FROM add_history WHERE id_add_history = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('location:../add_history.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
$conn->close();
?>