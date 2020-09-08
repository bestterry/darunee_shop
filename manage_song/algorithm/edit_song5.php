<?php 
 require "../../config_database/config.php"; 
 $id_song = $_POST['id_song'];
 $id_artist = $_POST['id_artist'];
 $id_tune = $_POST['id_tune'];
 $name_song = $_POST['name_song'];
 $melodic = $_POST['melodic'];
 $note = $_POST['note'];
 
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

 if(isset($_POST['edit'])){
   $edit = 'Y';
}else {
   $edit = 'N';
}

 if(isset($_FILES['ad_song'])){
   $name_file =  $_FILES['ad_song']['name'];
   $tmp_name =  $_FILES['ad_song']['tmp_name'];
   $locate_img ="../../song/";
   move_uploaded_file($tmp_name,$locate_img.$name_file);
   $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_tune = $id_tune, status = '$status',
            script='$script', melodic='$melodic', ad_song = '$name_file', edit = '$edit', note = '$note'
            WHERE id_song = $id_song";
   if ($conn->query($sql) === TRUE) {
   header('location:../song_setting2.php');
   } else {
   echo "Error updating record: " . $conn->error;
   }
}else{
   $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_tune = $id_tune, status = '$status',
            script='$script', melodic='$melodic', edit = '$edit', note = '$note'
            WHERE id_song = $id_song";
   if ($conn->query($sql) === TRUE) {
   header('location:../song_setting2.php');
   } else {
   echo "Error updating record: " . $conn->error;
   }
}



    $conn->close();
?>