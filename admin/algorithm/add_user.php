<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];

  $insert_user = "INSERT INTO member (username, password, name, status, id_zone) VALUE ('$username','$password','$name','$status',3)";
  if ($conn->query($insert_user) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insert_user . "<br>" . $conn->error;
}

$conn->close();

header('location:admin.php');
?>