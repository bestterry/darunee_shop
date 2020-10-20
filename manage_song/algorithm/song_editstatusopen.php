<?php 
 require "../../config_database/config.php"; 

 $id_song = $_GET['id_song'];
 $status = $_GET['status'];
 $id_member = $_GET['id_member'];

    $sql = "UPDATE song_list SET id_member = $id_member WHERE id_song = $id_song";
    mysqli_query($conn,$sql);

      if ($status == 'old') {
        header('location:../song_old.php');
      }
      if ($status == 'middle') {
        header('location:../song_middle.php');
      }
      if ($status == 'new') {
        header('location:../song_new.php');
      }    
?>