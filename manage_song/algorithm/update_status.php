<?php
  require "../../config_database/config.php";
   $sql = "UPDATE song_list SET id_member = 54 WHERE id_member != 54 ";
    if ($conn->query($sql) === TRUE) {
    header('location:../song_setting2.php');
    }
?>