<?php 
 require "../../config_database/config.php"; 

 $id_artist = $_POST['id_artist'];
 $name_artist = $_POST['name_artist'];
 $id_ageartist = $_POST['id_ageartist'];
 $id_sexartist = $_POST['id_sexartist'];


    $sql = "UPDATE song_artist SET name_artist = '$name_artist', id_ageartist=$id_ageartist, id_sexartist = $id_sexartist
            WHERE id_artist = $id_artist";
      if ($conn->query($sql) === TRUE) {
        header('location:../artist_setting.php');
      } else {
          echo "Error updating record: " . $conn->error;
      }



    $conn->close();
?>