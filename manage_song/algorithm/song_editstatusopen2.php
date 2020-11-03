<?php 
 require "../../config_database/config.php"; 

 $id_song = $_GET['id_song'];
 $id_artist = $_GET['id_artist'];
 $id_member = $_GET['id_member'];

    $sql = "UPDATE song_list SET id_member = $id_member WHERE id_song = $id_song";
    mysqli_query($conn,$sql);

   header('location:../song_list.php?id_artist='.$id_artist);
  
?>