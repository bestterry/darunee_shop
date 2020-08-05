<?php
     require "../../config_database/config.php"; 
     $id_song = $_GET['id_song']; 
     $id_artist = $_GET['id_artist'];
     $sql = "DELETE FROM song_list WHERE id_song = $id_song";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../song_list2.php?id_artist='.$id_artist);
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>