<?php 
  require "../../config_database/config.php";
  print_r($_POST);
  $id_interview = $_POST['id_interview'];
  $id = $_POST['id'];
  $name_file = $_POST['name_file'];
  $name = $_POST['name'];
  $note = $_POST['note'];

    if (empty($_POST['province_id'])) {
      $provinces_id = $_POST['province_id1'];
      $amphures_id = $_POST['amphur_id1'];
    }else {
      $provinces_id = $_POST['province_id'];
      $amphures_id = $_POST['amphur_id'];
    }

    $sql_interview = "UPDATE interview SET name_file = '$name_file', name = '$name', note = '$note', provinces_id = $provinces_id, amphures_id = $amphures_id
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

    header('location:../edit_interview.php?id_interview='.$id_interview);

?>