<?php 
 require "../../config_database/config.php"; 

  echo $id_song = $_POST['id_song'];
  echo $artist = $_POST['artist'];
  echo $name_song = $_POST['name_song'];
  echo $age = $_POST['age'];
  echo $tune = $_POST['tune'];

    $sql = "UPDATE song_list SET artist='$artist', name_song = '$name_song', age='$age', tune = '$tune'
            WHERE id_song = $id_song";

    if ($conn->query($sql) === TRUE) {
      header('location:../song_list.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
?>