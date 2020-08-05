<?php 
 require "../../config_database/config.php"; 

 $id_song = $_POST['id_song'];
 $id_age = $_POST['id_age'];
 echo $id_artist = $_POST['id_artist'];
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

 if(isset($_FILES['ad_song'])){
   $name_file =  $_FILES['ad_song']['name'];
   $tmp_name =  $_FILES['ad_song']['tmp_name'];
   $locate_img ="../../song/";
   move_uploaded_file($tmp_name,$locate_img.$name_file);
   $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_age=$id_age, id_tune = $id_tune, status = '$status',
            script='$script', melodic='$melodic', ad_song = '$name_file'
            WHERE id_song = $id_song";
   if ($conn->query($sql) === TRUE) {
   header('location:../all_song.php');
   } else {
   echo "Error updating record: " . $conn->error;
   }
}else{
   $sql = "UPDATE song_list SET id_artist=$id_artist, name_song = '$name_song', id_age=$id_age, id_tune = $id_tune, status = '$status',
            script='$script', melodic='$melodic'
            WHERE id_song = $id_song";
   if ($conn->query($sql) === TRUE) {
   header('location:../all_song.php');
   } else {
   echo "Error updating record: " . $conn->error;
   }
}



    $conn->close();
?>