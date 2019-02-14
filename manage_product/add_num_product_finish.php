<?php 
 require "../config_database/config.php"; 
  $id_product = $_POST['id_product'];
  $add_num = $_POST['add_num'];
  $num = $_POST['num'];
  echo $name = $_POST['name'];
  $total=$add_num+$num;
  //add history 
  $sql_insert = "INSERT INTO sale_history (id_product,num_sale,price,name_draw,status_sale) VALUE ($id_product,$add_num,'-','$name','add')";
  mysqli_query($conn,$sql_insert);
  //update num product
    $sql = "UPDATE product SET num_product='$total' WHERE id_product ='$id_product'";
  if ($conn->query($sql) === TRUE) {
    header('Location: ../product.php');;
  } else {
      echo "Error updating record: " . $conn->error;
  }
  $conn->close();
?>