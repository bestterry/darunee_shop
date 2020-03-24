<?php 
 require "../../config_database/config.php"; 

  echo $id_product = $_POST['id_product'];
  echo $name_product = $_POST['name_product'];
  echo $full_name = $_POST['full_name'];
  echo $unit = $_POST['unit'];
  echo $price_num = $_POST['price_num'];
  echo $price_outside = $_POST['price_outside'];
  

    $sql = "UPDATE product SET name_product='$name_product', full_name = '$full_name', unit='$unit', price_num = $price_num, price_outside = $price_outside  
            WHERE id_product = $id_product";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   header('location:../add_data.php');
?>