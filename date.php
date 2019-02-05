<?php
  require('config_database/config.php');
   $strDate = date('d-m-Y');

  $date = "SELECT * FROM sale_history
  WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
  $objq = mysqli_query($conn,$date);

  foreach($objq as $data){
    echo $data['id_sale_history'].'<br>';
  }
?>