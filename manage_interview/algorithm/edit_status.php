<?php 
  require "../../config_database/config.php";
  require "../../config_database/session.php";

   $id_interview = $_GET['id_interview'];

  $sql_interview = "UPDATE interview SET id_member = $id_member WHERE id_interview = $id_interview";
  mysqli_query($conn,$sql_interview);

  if($_GET['status']=='search'){
    header('location:../interview_search.php?&province_name='.$_GET['province_name'].'&amphur_name'.$_GET['amphur_name'].'&id_product='.$_GET['id_product'].'&id_plance='.$_GET['id_plance']);
  }else{
    header('location:../data_interview.php');
  }
  
?>