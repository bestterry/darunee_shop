<?php 
  require "../../config_database/config.php";

  $id_artist = $_POST['id_artist'];
  $name_song = $_POST['name_song'];
  $id_tune = $_POST['id_tune'];
  $script = $_POST['script'];
  $melodic = $_POST['melodic'];
  $note = $_POST['note'];

  $insert_song = "INSERT INTO song_list (id_artist, name_song, id_tune, status, script, melodic, edit, note) 
                                  VALUE ($id_artist,'$name_song',$id_tune, 'N', '$script', '$melodic', 'Y', '$note')";
      if ($conn->query($insert_song) === TRUE) {
        header('location:../song_setting.php');
    } else {
        echo "Error: " . $insert_song . "<br>" . $conn->error;
    }

    $conn->close();

 
?>