<?php 
  require "../../config_database/config.php"; 
  $id_zone = $_POST['id_zone'];
  for ($i=0; $i < count($_POST['id_product']); $i++) { 
    $id_product = $_POST['id_product'][$i];
    $num = $_POST['num'][$i];
   
    $sql_check = "SELECT * FROM num_product WHERE id_product = $id_product AND id_zone = $id_zone";
    $objq_check = mysqli_query($conn,$sql_check);
    $objr_check = mysqli_fetch_array($objq_check);

    $id_numproduct = $objr_check['id_numproduct'];
    $num_befor = $objr_check['num'];
    $total_num = $num_befor + $num;
      if (!isset($id_numproduct)) {
        $insert_num = "INSERT INTO num_product (num, id_product, id_zone) VALUE ($num, $id_product, $id_zone)";
        mysqli_query($conn,$insert_num);
      }else{
        $update_num = "UPDATE num_product SET num = $total_num WHERE id_numproduct = $id_numproduct";
        mysqli_query($conn,$update_num);
      }
  }
  header("location:../admin.php");
?>