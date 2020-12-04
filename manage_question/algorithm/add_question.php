<?php 
  require "../../config_database/config.php";
  require "../../session.php";
  $address = $_POST['address'];
  $district_id = $_POST['district_id'];
  $id_sex = $_POST['id_sex'];
  $id_age = $_POST['id_age'];
  $id_career = $_POST['id_career'];
  $id_status = $_POST['id_status'];
  $know_team = $_POST['know_team'];
  $use_product = $_POST['use_product'];
  $radio_team = $_POST['radio_team'];



  $add_question = "INSERT INTO question (address, district_id,id_sex, id_age, id_career, id_status, know_team, use_product, radio_team, status_num, id_member)
                   VALUE ($address, $district_id, $id_sex, $id_age, $id_career, $id_status, '$know_team', '$use_product', '$radio_team','N', $id_member)";
  mysqli_query($conn,$add_question);

  header('location:../question.php');
?>