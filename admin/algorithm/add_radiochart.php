<?php
    require "../../config_database/config.php";
    
    if(isset($_FILES['upload'])){
      $name_file =  $_FILES['upload']['name'];
      $tmp_name =  $_FILES['upload']['tmp_name'];
      $locate_img ="../../images/radio_chart/";
      move_uploaded_file($tmp_name,$locate_img.$name_file);

      $sql = "INSERT INTO radio_chart (name_chart)
              VALUES ('$name_file')";
      mysqli_query($conn,$sql);

      header('location:../radio_chart.php');
    }else{
      echo "error";
    }
?>