<?php 
 require "../../config_database/config.php"; 
 require "../../session.php";

   $id_artist = $_POST['id_artist'];
   $id_song = $_POST['id_song'];
   $id_artist = $_POST['id_artist'];
   $id_tune = $_POST['id_tune'];
   $name_song = $_POST['name_song'];
   $melodic = $_POST['melodic'];
 
  if(isset($_POST['id_member'])){
    $value_member = $id_member;
  }else {
    $value_member = 54;
  }

  if(isset($_POST['script'])){
    $script = 'Y';
   }else {
    $script = 'N';
   }

    $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_tune = $id_tune, id_member = $value_member,
            script='$script', melodic='$melodic'
            WHERE id_song = $id_song";
      if ($conn->query($sql) === TRUE) {
          header('location:../song_setting.php');
      } else {
          echo "Error updating record: " . $conn->error;
      }

    $conn->close();
?>