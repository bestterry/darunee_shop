<?php 
  require "../../config_database/config.php";
  $id_interview = $_POST['id_interview'];
  $id = $_POST['id'];
  $name_file = $_POST['name_file'];
  $name_customer = $_POST['name_customer'];
  $note = $_POST['note'];
  $grade = $_POST['grade'];

    if(isset($_POST['id_member'])){
        $id_member = $_POST['id_member'];
    }else {
        $id_member = 54;
    }

    if (empty($_POST['province_id'])) {
      $provinces_id = $_POST['province_id1'];
      $amphures_id = $_POST['amphur_id1'];
    }else {
      $provinces_id = $_POST['province_id'];
      $amphures_id = $_POST['amphur_id'];
    }

    $sql_interview = "UPDATE interview SET name_file = '$name_file', name_customer = '$name_customer', note = '$note', provinces_id = $provinces_id, amphures_id = $amphures_id, 
                      grade = '$grade', id_member = $id_member
                      WHERE id_interview = $id_interview";
    mysqli_query($conn,$sql_interview);

      if (empty($_POST['id_product'][0])) {

        
      }else{

        for($i=0 ; $i<COUNT($_POST['id_product']); $i++){
          $id_product = $_POST['id_product'][$i];
          $add_interviewpd = "INSERT INTO interview_product (id_product, id) 
                            VALUE ($id_product,$id)";
          mysqli_query($conn,$add_interviewpd);
        }

      }

      if (empty($_POST['id_plance'][0])) {

      }else{

        for($i=0 ; $i<COUNT($_POST['id_plance']); $i++){
          $id_plance = $_POST['id_plance'][$i];
          $add_interviewpl = "INSERT INTO interview_plance (id_plance, id) 
                              VALUE ($id_plance,$id)";
          mysqli_query($conn,$add_interviewpl);
        }

      }

    header('location:../data_interview.php');

?>