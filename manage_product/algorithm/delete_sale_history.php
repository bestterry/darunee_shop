<?php
  require "../../config_database/config.php";
   $id = $_GET['id'];

  $sql = "DELETE FROM price_history WHERE id_price_history = $id";

if ($conn->query($sql) === TRUE) {
    header('location:../sale_history.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>