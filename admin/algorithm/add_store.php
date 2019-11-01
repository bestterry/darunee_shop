<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $name_store = $_POST['name_store'];
  $tel = $_POST['tel'];
  $category = $_POST['category'];
  $status = $_POST['status'];
  $address = $_POST['address'];
  $province_id = $_POST['province_name'];
  $amphur_id = $_POST['amphur_name'];
  $district_code = $_POST['district_name'];

  $insert_store = "INSERT INTO store (name_store, tel, category, status, address, province_id, amphur_id, district_code) 
                   VALUE ('$name_store','$tel','$category','$status','$address',$province_id,$amphur_id,'$district_code')";
      if ($conn->query($insert_store) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $insert_store . "<br>" . $conn->error;
    }

    $conn->close();

  header('location:../store.php');
?>