<?php
  require "../../config_database/config.php"; 

  $value = $_POST['value'];
	$results = "SELECT car_rental FROM rc_practice WHERE id_practice = $value";
  $objq_pd = mysqli_query($conn,$results);
  $objr_pd = mysqli_fetch_array($objq_pd);
	
    echo $objr_pd['car_rental'];

?>