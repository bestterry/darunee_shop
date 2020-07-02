<?php
  require "../../config_database/config.php"; 

  $id_age = $_GET['id_age'];
  $id_tune = $_GET['id_tune'];
  $id_sexartist = $_GET['id_sexartist'];


  $sql = "UPDATE song_list SET id_member = 0, status = 'N', datetime = '-'
          WHERE status = 'Y' AND id_age = $id_age AND id_tune = $id_tune";
      if ($conn->query($sql) === TRUE) {
        header('location:../song_list.php?id_age='.$_GET['id_age'].'&&id_sexartist='.$_GET['id_sexartist'].'&&id_tune='.$_GET['id_tune']);
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   
?>