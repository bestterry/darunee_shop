<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $id_artist = $_POST['id_artist'];
  $name_song = $_POST['name_song'];
  $id_age = $_POST['id_age'];
  $id_tune = $_POST['id_tune'];
  $script = $_POST['script'];
  $melodic = $_POST['melodic'];

  $insert_song = "INSERT INTO song_list (id_artist, name_song, id_age, id_tune, id_member, status, datetime, script, melodic) 
                   VALUE ($id_artist,'$name_song',$id_age,$id_tune, 0, 'N', '-', '$script', '$melodic')";
      if ($conn->query($insert_song) === TRUE) {
        header('location:../song_list2.php?id_artist='.$id_artist);
    } else {
        echo "Error: " . $insert_song . "<br>" . $conn->error;
    }

    $conn->close();

 
?>