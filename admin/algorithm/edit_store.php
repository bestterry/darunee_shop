<?php 
  require "../../config_database/config.php";
  require "../../session.php";
    print_r($_POST);
    $id_store = $_POST['id_store'];
    $name_store = $_POST['name_store'];
    $tel = $_POST['tel'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $district_code = $_POST['district_name'];
    $amphur_id = $_POST['amphur_name'];
    $province_id = $_POST['province_name'];
    $latitude = $_POST['latitude'];
    $longtitude = $_POST['longtitude'];
    $id_category = $_POST['id_category'];
    $id_product_category = $_POST['id_product_category'];
      
      if (empty($district_code)) {
          $update_store = "UPDATE store SET name_store = '$name_store', tel = '$tel', status = '$status', address = '$address', 
                           latitude = $latitude, longtitude = $longtitude, id_category = '$id_category', id_product_category = '$id_product_category'
                           WHERE id_store = $id_store";
          mysqli_query($conn,$update_store);
      }else {
          $update_store = "UPDATE store SET name_store = '$name_store', tel = '$tel', status = '$status', address = '$address',
                           latitude = $latitude, longtitude = $longtitude, id_category = '$id_category', id_product_category = '$id_product_category'
                           district_code='$district_code',amphur_id = $amphur_id, province_id = $province_id
                           WHERE id_store = $id_store";
          mysqli_query($conn,$update_store);
      }
      
      header('location:../store_edit.php?id_store='.$id_store);

?>