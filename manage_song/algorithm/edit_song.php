<?php 
 require "../../config_database/config.php"; 

 $id_artist = $_GET['id_artist'];
 $id_song = $_POST['id_song'];
 $id_age = $_POST['id_age'];
 $id_artist = $_POST['id_artist'];
 $id_tune = $_POST['id_tune'];
 $name_song = $_POST['name_song'];
 $melodic = $_POST['melodic'];

  if(isset($_POST['status'])){
     $status = 'Y';
  }else {
     $status = 'N';
  }

  if(isset($_POST['script'])){
    $script = 'Y';
 }else {
    $script = 'N';
 }

    $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_age=$id_age, id_tune = $id_tune, status = '$status',
            script='$script', melodic='$melodic'
            WHERE id_song = $id_song";
      if ($conn->query($sql) === TRUE) {

        if ($id_age == 1) {
          header('location:../song_old.php');
        }if ($id_age == 2) {
          header('location:../song_middle.php');
        }if ($id_age == 3) {
          header('location:../song_new.php');
        }
        
      } else {
          echo "Error updating record: " . $conn->error;
      }

    $conn->close();
?>