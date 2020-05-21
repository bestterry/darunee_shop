<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  print_r($_POST);
  $name = $_POST['name'];
  $name_sub = $_POST['sub_name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];

  if(empty($_POST['status_car'])){
    $status_car = "0";
  }else{
    $status_car = "1";
  }

  $insert_user = "INSERT INTO member (username, password, name, name_sub, status, id_zone, status_car) 
                  VALUE ('$username','$password','$name', '$name_sub','$status', 8, $status_car)";
  if ($conn->query($insert_user) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insert_user . "<br>" . $conn->error;
}

$conn->close();

header('location:../add_data.php');
?>