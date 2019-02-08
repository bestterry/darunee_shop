<?php 
 require "../config_database/config.php"; 
  $id_product = $_POST['id_product'];
  $add_num = $_POST['add_num'];
  $num = $_POST['num'];

  $total=$add_num+$num;

  $sql = "UPDATE product SET num_product='$total' WHERE id_product ='$id_product'";

if ($conn->query($sql) === TRUE) {
  header('Location: ../product.php');;
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>