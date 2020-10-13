<?php 
  require "../../config_database/config.php";
  $name_plance = $_POST['name_plance'];

  $add_plance = "INSERT INTO plance (name_plance) 
                    VALUE ('$name_plance')";
  mysqli_query($conn,$add_plance);

  header('location:../add_interview.php');

?>