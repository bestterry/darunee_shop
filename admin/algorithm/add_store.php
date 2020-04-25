<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $name_store = $_POST['name_store'];
  $tel = $_POST['tel'];
  $id_category = $_POST['id_category'];
  $id_product_category = $_POST['id_product_category'];
  $status = $_POST['status'];
  $address = $_POST['address'];
  $province_id = $_POST['province_name'];
  $amphur_id = $_POST['amphur_name'];
  $district_code = $_POST['district_name'];
  $latitude = $_POST['latitude'];
  $longtitude = $_POST['longtitude'];

  $insert_store = "INSERT INTO store (name_store, tel, status, address, province_id, amphur_id, district_code, latitude, longtitude, id_category, id_product_category) 
                   VALUE ('$name_store','$tel','$status','$address',$province_id,$amphur_id,'$district_code', $latitude, $longtitude, $id_category, $id_product_category)";
      if ($conn->query($insert_store) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insert_store . "<br>" . $conn->error;
    }

    $conn->close();

 header('location:../store.php');
?>