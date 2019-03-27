<?php
  require "../../config_database/config.php";
  $id = $_GET['id'];

  $sql = "DELETE FROM draw_history WHERE id_draw_history = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header('location:../draw_history.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();


?>