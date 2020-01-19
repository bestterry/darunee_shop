<?php 
 require "../../config_database/config.php"; 
 $id_member = $_POST['id_member'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $name =$_POST['name'];
 $name_sub = $_POST['name_sub'];
 $status = $_POST['status'];

    $sql = "UPDATE member SET username = '$username', password = '$password', name = '$name', name_sub = '$name_sub', status = '$status' WHERE id_member = $id_member";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

    header('location:../add_data.php');
?>