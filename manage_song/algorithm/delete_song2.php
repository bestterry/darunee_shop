<?php
     require "../../config_database/config.php"; 
     $id_song = $_GET['id_song']; 
     $sql = "DELETE FROM song_list WHERE id_song = $id_song";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../song_setting2.php');
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>