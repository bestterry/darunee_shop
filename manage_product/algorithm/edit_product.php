<?php 
   require "../../config_database/config.php";
     $id_numproduct = $_POST['id_numproduct'];
     $num = $_POST['num'];
        
        $update_product = "UPDATE num_product SET num = '$num' WHERE id_numproduct ='$id_numproduct'";
        if ($conn->query($update_product) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
        $conn->close();
        header('Location: ../../product.php');
?>