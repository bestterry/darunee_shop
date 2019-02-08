<?php  
  require('../config_database/config.php');
  $name_product = $_POST['name_product'];
  $num_product = $_POST['num_product'];
  $unit_product = $_POST['unit'];
  $status = $_POST['status'];
    $insert_product = "INSERT INTO product (name_product, num_product, unit, status)
    VALUES ('$name_product', '$num_product', '$unit_product', '$status')";
    mysqli_query($conn,$insert_product);
    header("location:../product.php");
// ?>