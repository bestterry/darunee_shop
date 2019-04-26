<?php 
 require "../../config_database/config.php";
 require "../../session.php";
    $id_numpd_car = $_POST['id_numpd_car'];
    $num = $_POST['num'];

      echo $update_numpd = "UPDATE numpd_car SET num=$num WHERE id_numPD_car=$id_numpd_car";
      mysqli_query($conn,$update_numpd);

      header("location:../add_data.php");


?>