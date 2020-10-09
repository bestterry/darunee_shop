<?php
    require "../../config_database/config.php";
    
    if(isset($_FILES['upload'])){
      $name_file =  $_FILES['upload']['name'];
      $tmp_name =  $_FILES['upload']['tmp_name'];
      $locate_img ="../../images/product/";
      move_uploaded_file($tmp_name,$locate_img.$name_file);

      $sql = "INSERT INTO present_product (name_product)
              VALUES ('$name_file')";
      mysqli_query($conn,$sql);

      header('location:../present_product.php');
    }else{
      echo "error";
    }
?>