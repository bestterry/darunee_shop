<?php 
 require "../../config_database/config.php"; 

 $id_artist = $_GET['id_artist'];
 $id_song = $_POST['id_song'];
 $id_age = $_POST['id_age'];
 $id_artist = $_POST['id_artist'];
 $id_tune = $_POST['id_tune'];
 $name_song = $_POST['name_song'];

  if(isset($_POST['status'])){
     $status = 'Y';
  }else {
     $status = 'N';
  }

    $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_age=$id_age, id_tune = $id_tune, status = '$status'
            WHERE id_song = $id_song";
      if ($conn->query($sql) === TRUE) {
        header('location:../song_list2.php?id_artist='.$_GET['id_artist']);
      } else {
          echo "Error updating record: " . $conn->error;
      }



    $conn->close();
?>