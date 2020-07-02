<?php
  require "../../config_database/config.php"; 
  $id_artist = $_GET['id_artist'];
  $sql = "UPDATE song_list SET id_member = 0, status = 'N', datetime = '-'
          WHERE status = 'Y' AND id_artist = $id_artist";
      if ($conn->query($sql) === TRUE) {
        header('location:../song_list2.php?id_artist='.$id_artist);
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   
?>