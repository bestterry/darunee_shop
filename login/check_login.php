<?php
  session_start();
  require('../config_database/config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_user = "SELECT * FROM member 
    WHERE username='$username' AND password='$password'";
    $objQuery = mysqli_query($conn,$sql_user);
    $objResult = mysqli_fetch_array($objQuery);
    $id_member = $objResult['id_member'];
        if(!$objResult){
          header('location:../index.html');
        }
        else{
          $_SESSION['id_member'] = $id_member;
          session_write_close();
          header('location:../product.php');
        }
?>