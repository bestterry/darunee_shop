<?php 
 require "../../config_database/config.php"; 
  $name_product = $_POST['name_product'];
  $id_product = $_POST['id_product'];
  $unit = $_POST['unit'];
  $price_num = $_POST['price_num'];
  

    $sql = "UPDATE product SET name_product='$name_product',unit='$unit', price_num = $price_num WHERE id_product = $id_product";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

    header('location:../add_data.php');
?>