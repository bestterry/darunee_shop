<?php
  require "../../config_database/config.php"; 
  require "../../session.php";
  $id_zone = $_POST['id_zone'];
  $status = $_POST['status'];

  for ($i=0; $i < count($_POST['id_numproduct']); $i++) { 
    $id_numproduct = $_POST['id_numproduct'][$i];
    $id_product = $_POST['id_product'][$i];
    $num_befor = $_POST['num_befor'][$i];
    $num_after = $_POST['num_after'][$i];
    $value_num = $num_befor - $num_after;
    // -----------------update & delete data num_product ORIGIN
    if ($status == 'normal') {
      if ($value_num == 0) {
       $delete_list = "DELETE FROM num_product WHERE id_numproduct = $id_numproduct";
       mysqli_query($conn,$delete_list);
      }else {
        $update_list = "UPDATE num_product SET num = $value_num WHERE id_numproduct = $id_numproduct";
        mysqli_query($conn,$update_list);
      }
    }else {
      if ($value_num == 0) {
        $delete_list = "DELETE FROM num_productwaste WHERE id_numproductwaste = $id_numproduct";
        mysqli_query($conn,$delete_list);
      }else {
          $update_list = "UPDATE num_productwaste SET num = $value_num WHERE id_numproductwaste = $id_numproduct";
          mysqli_query($conn,$update_list);
      }
    }
    // -----------------update & delete data num_product ORIGIN


    // -----------------update & delete data num_product Destination
    if ($status == 'normal') {
      $select_productwaste = "SELECT id_numproductwaste,num FROM num_productwaste WHERE id_zone = $id_zone AND id_product = $id_product";
      $objq_productwaste = mysqli_query($conn,$select_productwaste);
        if ($objq_productwaste->num_rows > 0) {
          while($row = $objq_productwaste->fetch_assoc()) {
           $id_numproductwaste = $row['id_numproductwaste'];
           $num_value = $row['num'] + $num_after;
           $update_productwaste = "UPDATE num_productwaste SET num = $num_value WHERE id_numproductwaste = $id_numproductwaste";
           mysqli_query($conn,$update_productwaste);
          }
        } else {
          $insert_list = "INSERT INTO num_productwaste (num, id_product, id_zone)
                          VALUE ($num_after, $id_product, $id_zone)";
          mysqli_query($conn,$insert_list);
        }
      }else {
        $select_product = "SELECT id_numproduct,num FROM num_product WHERE id_zone = $id_zone AND id_product = $id_product";
        $objq_product = mysqli_query($conn,$select_product);
          if ($objq_product->num_rows > 0) {
            while($row = $objq_product->fetch_assoc()) {
             $id_numproduct = $row['id_numproduct'];
             $num_value = $row['num'] + $num_after;
             $update_product = "UPDATE num_product SET num = $num_value WHERE id_numproduct = $id_numproduct";
             mysqli_query($conn,$update_product);
            }
          } else {
            $insert_list = "INSERT INTO num_product (num, id_product, id_zone)
                            VALUE ($num_after, $id_product, $id_zone)";
            mysqli_query($conn,$insert_list);
          }
      }
    // -----------------update & delete data num_product Destination

  }

  header('location:../total_stock.php');

?>