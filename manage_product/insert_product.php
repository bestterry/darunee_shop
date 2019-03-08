<?php  
  require('../config_database/config.php');
  require('../session.php');
  
   $id_product = $_POST['id_product'];
   $num = $_POST['num'];
  
    $insert_product = "INSERT INTO num_product (num, id_product, id_zone)
    VALUES ('$num','$id_product','$id_zone')";
    mysqli_query($conn,$insert_product);
    header("location:../product.php");
?>