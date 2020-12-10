<?php 
  $amphur_id = $_GET['amphur_id'];
  $district_id = $_GET['district_id'];
  $address = $_GET['address'];

    if (!empty($address)) {
      header('location:../data_question_village.php?district_id='.$district_id.'&address='.$address);
    }
    else {
      if (!empty($district_id)) {
        header('location:../data_question_district.php?district_id='.$district_id);
      }else {
        header('location:../data_question_amphur.php?amphur_id='.$amphur_id);
      }
    }
?>