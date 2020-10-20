<?php
  require "../../config_database/config.php"; 
    $id = $_GET['id'];
    $interview = "DELETE FROM interview WHERE id = $id";
    mysqli_query($conn,$interview);

    $interview_plance = "DELETE FROM interview_plance WHERE id = $id";
    mysqli_query($conn,$interview_plance);

    $interview_product = "DELETE FROM interview_product WHERE id = $id";
    mysqli_query($conn,$interview_product);

    header('location:../data_interview.php');
?>