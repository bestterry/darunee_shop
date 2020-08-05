<?php
     require "../../config_database/config.php"; 

     $id_artist = $_GET['id_artist']; 
     $sql = "DELETE FROM song_artist WHERE id_artist = $id_artist";
   
      if ($conn->query($sql) === TRUE) {
          header('location:../artist_setting.php');
      } else {
          echo "Error deleting record: " . $conn->error;
      }
?>