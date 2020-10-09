<?php
  require "../../config_database/config.php"; 

  $value = $_POST['value'];
  $id_member1 = $_POST['id_member1'];
  $id_practice = $_POST['id_practice'];

	$results = "SELECT car_rental FROM rc_practice WHERE id_practice = $id_practice";
  $objq_pd = mysqli_query($conn,$results);
  $objr_pd = mysqli_fetch_array($objq_pd);
  
    if($value == $id_member1){
      echo $objr_pd['car_rental'];
    }else{
      echo 0;
    }

?>