<?php 
   require "../../config_database/config.php";
    echo $id_numproduct = $_POST['id_numproduct'].'<br>';
    echo $num = $_POST['num'];
        

        $update_product = "UPDATE num_product
        SET num = '$num'
        WHERE id_numproduct ='$id_numproduct'";
        mysqli_query($conn,$update_product);
        header('Location: ../../product.php');
?>