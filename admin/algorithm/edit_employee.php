<?php 
 require "../../config_database/config.php"; 
 $id_member = $_POST['id_member'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $full_name = $_POST['full_name'];
 $name =$_POST['name'];
 $name_sub = $_POST['name_sub'];
 $status = $_POST['status'];

 if (isset($_POST['status_car'])) {
     $status_car = 1;
 }else{
     $status_car = 0;
 }


    $sql = "UPDATE member SET username = '$username', password = '$password', full_name = '$full_name', name = '$name', 
            name_sub = '$name_sub', status = '$status', status_car = $status_car WHERE id_member = $id_member";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
       header('location:../edit_employee.php?id_member='.$id_member);
    } else {
        echo "Error updating record: " . $conn->error;
    }
?>