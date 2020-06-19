<?php 
  require "../config_database/config.php"; 
  require "../session.php";

  $sql_addorder = "SELECT id_song,artist,name_song,age,tune,status FROM song_list";
                            $objq_addorder = mysqli_query($conn,$sql_addorder);
                            while($value =  mysqli_fetch_array($objq_addorder)){
                              echo $value['id_song'].'-'.$value['artist'].'-'.$value['name_song'].'-'.$value['age'].'</br>';
                            }
?>

