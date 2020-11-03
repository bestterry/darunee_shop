<?php 
  require "../../config_database/config.php"; 

  $id_member = $_POST['id_member'];
  for ($i=0; $i < count($_POST['id_product']) ; $i++) { 
      $id_product = $_POST['id_product'][$i];
      $num = $_POST['num'][$i];

      $sql = "INSERT INTO numpd_car (num, id_product, id_member)
              VALUES ($num, $id_product, $id_member)";
      mysqli_query($conn,$sql);

      header('location:../add_data.php');

  }
?>