<?php 
 require "../../config_database/config.php";
 $name_product = $_POST['name_product'];
 $unit = $_POST['unit'];
 $price = $_POST['price'];

 $sql_insert = "INSERT INTO product (name_product, unit, price) VALUE ('$name_product', '$unit', $price)";
 if ($conn->query($sql_insert) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$conn->close();

header('location:../admin.php');
?>