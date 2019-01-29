<?php 
   require "../config_database/config.php";
    $id_product = $_POST['id_product'];
    $name_product = $_POST['name_product'];
    $num_product = $_POST['num_product'];
    $unit = $_POST['unit'];

   $update_product = "UPDATE product
   SET name_product = '$name_product', num_product = '$num_product', unit = '$unit'
   WHERE id_product ='$id_product'";
   mysqli_query($conn,$update_product);
   header('Location: ../index.php');
?>