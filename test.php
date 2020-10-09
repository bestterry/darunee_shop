<?php
  require('config_database/config.php');
  $sql = "DELETE FROM store WHERE latitude = 0.000000";
  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
?>