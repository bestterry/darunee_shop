<?php 
 require "../../config_database/config.php";
 $name_product = $_POST['name_product'];
 $full_name = $_POST['full_name'];
 $unit = $_POST['unit'];
 $price_num = $_POST['price_num'];
 $price_outside = $_POST['price_outside'];

 $sql_insert = "INSERT INTO product (name_product, full_name, unit, price_num, price_outside) 
                VALUE ('$name_product', '$full_name', '$unit', $price_num, $price_outside)";
 if ($conn->query($sql_insert) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$conn->close();

header('location:../admin.php');
?>