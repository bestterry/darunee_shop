<?php 
 require "../../config_database/config.php"; 
 require "../../session.php";

   $age = $_POST['age'];
   $id_song = $_POST['id_song'];
   $id_artist = $_POST['id_artist'];
   $id_tune = $_POST['id_tune'];
   $name_song = $_POST['name_song'];
   $melodic = $_POST['melodic'];
   $note = $_POST['note'];
 
  if(isset($_POST['id_member'])){
    $value_member = $_POST['id_member'];
  }else {
     $value_member = 54;
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

   if(isset($_POST['check_edit'])){
      $check_edit = 'Y';
   }else {
      $check_edit = 'N';
   }

 if(isset($_FILES['ad_song'])){
   $name_file =  $_FILES['ad_song']['name'];
   $tmp_name =  $_FILES['ad_song']['tmp_name'];
   $locate_img ="../../song/";
   move_uploaded_file($tmp_name,$locate_img.$name_file);
   $sql = "UPDATE song_list SET id_artist = $id_artist, name_song = '$name_song', id_tune = $id_tune, id_member = '$value_member',
            script='$script', melodic='$melodic', ad_song = '$name_file', edit = '$edit', note = '$note', check_edit = '$check_edit'
            WHERE id_song = $id_song";
   if ($conn->query($sql) === TRUE) {

     if ($age == 'old') {
       header('location:../song_old.php');
     }if ($age == 'middle') {
       header('location:../song_middle.php');
     }if ($age == 'new') {
       header('location:../song_new.php');
     }if ($age == 'a') {
      header('location:../gradea.php');
     }if ($age == 'b') {
      header('location:../gradeb.php');
     }if ($age == 'c') {
      header('location:../gradec.php');
     }if ($age == 'd') {
      header('location:../graded.php');
     }if ($age == 'original') {
      header('location:../song_original.php');
     }if ($age == 'coeval') {
      header('location:../song_coeval.php');
     }

   } else {
   echo "Error updating record: " . $conn->error;
   }
}else{
   $sql = "UPDATE song_list SET id_artist = $id_artist, name_song = '$name_song', id_tune = $id_tune, id_member = '$value_member',
            script = '$script', melodic = '$melodic', edit = '$edit', note = '$note', check_edit = '$check_edit'
            WHERE id_song = $id_song";
   if ($conn->query($sql) === TRUE) {

    if($age == 'old') {
      header('location:../song_old.php');
    }if ($age == 'middle') {
      header('location:../song_middle.php');
    }if ($age == 'new') {
      header('location:../song_new.php');
    }if ($age == 'a') {
     header('location:../gradea.php');
    }if ($age == 'b') {
     header('location:../gradeb.php');
    }if ($age == 'c') {
     header('location:../gradec.php');
    }if ($age == 'd') {
     header('location:../graded.php');
    }if ($age == 'original') {
      header('location:../song_original.php');
    }if ($age == 'coeval') {
      header('location:../song_coeval.php');
     }

   } else {
   echo "Error updating record: " . $conn->error;
   }
}
    $conn->close();
?>