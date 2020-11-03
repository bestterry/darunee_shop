<?php 
  require "../../config_database/config.php"; 
  $id_product = $_POST['value'];

  $sql = "SELECT name_user FROM transfer_product
          INNER JOIN product ON product.id_transfer_pd = transfer_product.id_transfer_pd
          INNER JOIN transfer_account ON transfer_account.id_transfer_pd = transfer_product.id_transfer_pd
          WHERE product.id_product = $id_product";

  $objq_sql = mysqli_query($conn,$sql);
  $obje_sql = mysqli_fetch_array($objq_sql);
   echo $obje_sql["name_user"];
  
  
?>