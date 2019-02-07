<?php 
require('config_database/config.php'); 
$strDate = date('d-m-Y');
  $date = "SELECT * FROM sale_history
  WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND status_sale='sale'";
  $objq = mysqli_query($conn,$date);

  print_r($objq);
?>