<?php 
  require "../../config_database/config.php"; 
  $id_product = $_POST['value'];

  $sql = "SELECT name_account FROM transfer_product
          INNER JOIN product ON product.id_transfer_pd = transfer_product.id_transfer_pd
          INNER JOIN transfer_account ON transfer_account.id_transfer_pd = transfer_product.id_transfer_pd
          WHERE product.id_product = $id_product";

  $objq_sql = mysqli_query($conn,$sql);

  foreach ($objq_sql as $value) :
    echo "<option value=\"" . $value['name_account'] . "\">" . $value['name_account'] . "</option>";
  endforeach;
  
?>