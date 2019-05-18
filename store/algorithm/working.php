<?php 
require "../../config_database/config.php";
require "../../session.php";

$name_area = $_POST['name_area'];
$id_working = $_POST['id_working'];

    $sql = "INSERT INTO area (name_area, id_working, id_member)
            VALUES ('$name_area', $id_working, $id_member)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

header("location:../store.php");

?>