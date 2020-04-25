<?php
 
 include("db_connect.php");
 $mysqli = connect();

  $value = $_POST['value'];
	$results = "SELECT price_num FROM product WHERE id_product = $value";
  $objq_pd = mysqli_query($mysqli,$results);
  $objr_pd = mysqli_fetch_array($objq_pd);
	
    echo $objr_pd['price_num'];

?>