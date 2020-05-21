<?php 
 require "../../config_database/config.php"; 
    $id_price_history = $_POST['id_price_history'];
    $num = $_POST['num'];
    $price = $_POST['price'];
    $money = $_POST['money'];
    $note = $_POST['note'];

    $sql = "UPDATE price_history SET price = $price, num = $num, money = $money, note = '$note' WHERE id_price_history = $id_price_history";

    if ($conn->query($sql) === TRUE) {
        header('location:../edit_sale_shop.php?id_price_history='.$id_price_history);
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   
?>