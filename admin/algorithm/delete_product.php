<?php
  require "../../config_database/config.php"; 
      $id_product = $_GET['id_product'];
      // $sql_product = "DELETE FROM product WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_product);
      // $sql_add_history = "DELETE FROM add_history WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_add_history);
      // $sql_change_bwt_car = "DELETE FROM change_bwt_car WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_change_bwt_car);
      // $sql_draw_history = "DELETE FROM draw_history WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_draw_history);
      // $sql_numpd_car = "DELETE FROM numpd_car WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_numpd_car);
      // $sql_num_product = "DELETE FROM num_product WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_num_product);
      // $sql_price_history = "DELETE FROM price_history WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_price_history);
      // $sql_price_history = "DELETE FROM price_history WHERE id_product = $id_product";
      // mysqli_query($conn,$sql_price_history);

      $conn->close();
      header('location:../add_data.php');
?>