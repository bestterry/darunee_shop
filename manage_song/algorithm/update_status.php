<?php
  require "../../config_database/config.php";
   $sql = "UPDATE song_list SET status = 'N' WHERE status = 'Y' ";
    if ($conn->query($sql) === TRUE) {
    header('location:../song_setting2.php');
    }
?>