<?php 
require "../../config_database/config.php";
require "../../session.php";

 $id_member_send = $id_member;
 $id_member_receive = $_POST['id_member'];


  for ($i=0; $i < count($_POST['id_product']); $i++) { 
    $id_product = $_POST['id_product'][$i];
    $id_numPD_car = $_POST['id_numPD_car'][$i];
    $num_befor = $_POST['num_befor'][$i];
    $num_after = $_POST['num_after'][$i];
    $total_num = $num_befor-$num_after;

    //---------------------insert change_bwt_car --------------------------------------     
    $insert_change = "INSERT INTO change_bwt_car (num, id_product, id_member_send, id_member_receive, note)
                      VALUES ($num_after, $id_product, $id_member_send, $id_member_receive, '-')";
                      mysqli_query($conn,$insert_change);
    //---------------------//insert change_bwt_car --------------------------------------  

    //---------------------update numpd_car--------------------------------------                  
    if($total_num == 0){
      $delete_numpd_car = "DELETE FROM numpd_car WHERE id_numPD_car = $id_numPD_car";
      mysqli_query($conn,$delete_numpd_car);
    }else{
      $update_numpd_car = "UPDATE numpd_car SET num = $total_num WHERE id_numPD_car = $id_numPD_car";
      mysqli_query($conn,$update_numpd_car);
     }
    //--------------------- //update numpd_car----------------------------------- 

    //-----------------------manage numpd_car------------------------------------
    $seach_num = "SELECT * FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member_receive";
    $objq_seach_num = mysqli_query($conn,$seach_num);
    $objr_seach_num = mysqli_fetch_array($objq_seach_num);
    $num = $objr_seach_num['num'];
    $id_num = $objr_seach_num['id_numPD_car'];
      $total = $num + $num_after;
    if(!isset($num)){
        $insert_numpd_car = "INSERT INTO numpd_car (num, id_product, id_member)
                          VALUES ($num_after, $id_product, $id_member_receive)";
        mysqli_query($conn,$insert_numpd_car);
    }else{
        $update_numpd_car2 = "UPDATE numpd_car SET num = $total WHERE id_numPD_car = $id_num";
      mysqli_query($conn,$update_numpd_car2);
    }
    //-----------------------//manage numpd_car//------------------------------------
  }
  header("location:../store.php");
?>