<?php 
 require "../../config_database/config.php";
 $name_product = $_POST['name_product'];
 $unit = $_POST['unit'];
 $price_num = $_POST['price_num'];

 $sql_insert = "INSERT INTO product (name_product, unit, price_num) VALUE ('$name_product', '$unit', $price_num)";
 if ($conn->query($sql_insert) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$conn->close();

header('location:../admin.php');
?>