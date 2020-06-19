<?php 
include("db_connect.php");
$mysqli = connect();
  $id_amphur = $_POST['amphur_name'];

  $sql_product = "SELECT * FROM addorder WHERE amphur_id = $id_amphur AND status = 'pending'";
  $objq_product = mysqli_query($mysqli,$sql_product);
  
  while($value = $objq_product->fetch_assoc()){
    $row[] = $value['id_addorder'];
  }

  echo $sumstr = implode(",",$row);

?>