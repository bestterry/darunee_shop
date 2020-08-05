<?php 
  require "../../config_database/config.php";

  $name_artist = $_POST['name_artist'];
  $id_ageartist = $_POST['id_ageartist'];
  $id_sexartist = $_POST['id_sexartist'];

  $insert_artist = "INSERT INTO song_artist (name_artist, id_ageartist, id_sexartist) 
                   VALUE ('$name_artist',$id_ageartist,$id_sexartist)";
      if ($conn->query($insert_artist) === TRUE) {
        header('location:../artist_setting.php');
    } else {
        echo "Error: " . $insert_artist . "<br>" . $conn->error;
    }

    $conn->close();

 
?>