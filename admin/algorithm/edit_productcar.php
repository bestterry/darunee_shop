<?php 
 require "../../config_database/config.php";
 require "../../session.php";
    $id_membercar = $_GET['id_membercar'];
    $id_numpd_car = $_GET['id_numpd_car'];
    $num = $_GET['num'];

      echo $update_numpd = "UPDATE numpd_car SET num=$num WHERE id_numPD_car=$id_numpd_car";
      mysqli_query($conn,$update_numpd);

      header("location:../edit_productcar.php?id_membercar=".$id_membercar);


?>