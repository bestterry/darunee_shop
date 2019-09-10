<?php
    require "../../config_database/config.php"; 
    $id_acc_market = $_GET['id_acc_market'];
  
    $sql = "DELETE FROM acc_market WHERE id_acc_market = $id_acc_market";
    mysqli_query($conn,$sql);

    $sql_select = "SELECT * FROM acc_market_list WHERE id_acc_market = $id_acc_market";
    $objq_select = mysqli_query($conn,$sql_select);
    while($value = $objq_select->fetch_assoc()){
      $id_acc_list = $value['id_acc_market_list'];
         $sql_delete_list = "DELETE FROM acc_market_list WHERE id_acc_market_list = $id_acc_list";
         mysqli_query($conn,$sql_delete_list);
    }
   header('location:../acc_market_sale.php');
 
?>