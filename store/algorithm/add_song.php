<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $artist = $_POST['artist'];
  $name_song = $_POST['name_song'];
  $age = $_POST['age'];
  $tune = $_POST['tune'];

  $insert_song = "INSERT INTO song_list (artist, name_song, age, tune, id_member, status, datetime) 
                   VALUE ('$artist','$name_song','$age','$tune', 0, 'N', '-')";
      if ($conn->query($insert_song) === TRUE) {
        header('location:../store.php');
    } else {
        echo "Error: " . $insert_song . "<br>" . $conn->error;
    }

    $conn->close();

 
?>