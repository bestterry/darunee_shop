<?php 
  require "../../config_database/config.php";
  $know_product = $_POST['know_product'];
  $know_team = $_POST['know_team'];
  $join_discourse = $_POST['join_discourse'];
  $price_product = $_POST['price_product'];

  $add_question = "INSERT INTO question (know_team, know_product, join_discourse, price_product, status)
                    VALUE ('$know_team', '$know_product','$join_discourse', '$price_product', 'N')";
  mysqli_query($conn,$add_question);

  header('location:../question.php');
?>