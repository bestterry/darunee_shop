<?php 
 require "../../config_database/config.php"; 
    $id_sale_history = $_POST['id_sale_history'];
    $price = $_POST['price'];
    $money = $_POST['money'];
    $note = $_POST['note'];

    $sql = "UPDATE sale_car_history SET price = '$price', money = '$money', note = '$note' WHERE id_sale_history = $id_sale_history";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

    header('location:../edit_sale_car.php?id_sale_history='.$id_sale_history);
?>