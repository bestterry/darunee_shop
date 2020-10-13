<?php 
  require "../../config_database/config.php";

  $sql = "UPDATE interview SET status = 'N' WHERE status = 'Y'";
  mysqli_query($conn,$sql);

  header('location:../data_interview.php');

?>