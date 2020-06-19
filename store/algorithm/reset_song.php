<?php
  require "../../config_database/config.php"; 

  $sql = "UPDATE song_list SET id_member = 0, status = 'N', datetime = '-'
          WHERE status = 'Y'";
      if ($conn->query($sql) === TRUE) {
        header('location:../song_list.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   
?>