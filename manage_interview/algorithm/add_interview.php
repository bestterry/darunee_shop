<?php 
  require "../../config_database/config.php";

  $name_file = $_POST['name_file'];
  $name = $_POST['name'];
  $province_id = $_POST['province_name'];
  $amphur_id = $_POST['amphur_name'];
  $note = $_POST['note'];
  $id = (rand(1,10000));

  $add_interview = "INSERT INTO interview (name_file, name, amphures_id, provinces_id, note, id) 
                    VALUE ('$name_file','$name',$amphur_id, $province_id, '$note', $id)";
  mysqli_query($conn,$add_interview);


  for($i=0 ; $i<COUNT($_POST['id_product']); $i++){
    $id_product = $_POST['id_product'][$i];
    $add_interviewpd = "INSERT INTO interview_product (id_product, id) 
                      VALUE ($id_product,$id)";
    mysqli_query($conn,$add_interviewpd);
  }

  for($i=0 ; $i<COUNT($_POST['id_plance']); $i++){
    $id_plance = $_POST['id_plance'][$i];
    $add_interviewpl = "INSERT INTO interview_plance (id_plance, id) 
                        VALUE ($id_plance,$id)";
    mysqli_query($conn,$add_interviewpl);
  }

?>