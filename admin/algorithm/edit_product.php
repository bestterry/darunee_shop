<?php 
 require "../../config_database/config.php"; 

   $id_product = $_POST['id_product'];
   $name_product = $_POST['name_product'];
   $full_name = $_POST['full_name'];
   $unit = $_POST['unit'];
   $price_num = $_POST['price_num'];
   $price_outside = $_POST['price_outside'];
  

    $sql = "UPDATE product SET name_product='$name_product', full_name = '$full_name', unit='$unit', price_num = $price_num, price_outside = $price_outside  
            WHERE id_product = $id_product";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('location:../edit_product.php?id_product='.$id_product);
    } else {
        echo "Error updating record: " . $conn->error;
    }

    
?>