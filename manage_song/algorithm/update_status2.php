<?php
  require "../../config_database/config.php";
  $grade = $_GET['grade'];

   $sql = "UPDATE song_list SET id_member = 54 WHERE melodic = '$grade' ";
    if ($conn->query($sql) === TRUE) {
      if ($grade == 'A') {
        header('location:../gradea.php');
      }if ($grade == 'B') {
        header('location:../gradeb.php');
      }if ($grade == 'C') {
        header('location:../gradec.php');
      }if ($grade == 'D') {
        header('location:../graded.php');
      }
    }
?>