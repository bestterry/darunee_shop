<?php
  require "../../config_database/config.php";

    $id_member = $_POST['id_member'];
    
    for ($i=0; $i < count($_POST['id_product']); $i++) { 
      $id_product = $_POST['id_product'][$i];

      $sql = "INSERT INTO store_incar (id_product, id_member, bring, input, draw, sale, etc, ret, surplus, count)
              VALUES ($id_product, $id_member, 0,0,0,0,0,0,0,0)";
              mysqli_query($conn,$sql);
    }
  
    header('location:../store.php');

?>