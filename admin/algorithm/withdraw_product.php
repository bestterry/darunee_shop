<?php 
 require "../../config_database/config.php"; 
 require "../../session.php";
 $id_zone = $_POST['id_zone'];
 $id_member = $_POST['id_member'];

 for ($i=0; $i < count($_POST['id_numproduct']); $i++) { 
   $id_numproduct = $_POST['id_numproduct'][$i];
   $id_product = $_POST['id_product'][$i];
   $num_befor = $_POST['num_befor'][$i];
   $num_after = $_POST['num_after'][$i];
      //-----------------------------insert draw_history----------------------------------
      $insert_draw = "INSERT INTO draw_history (num_draw, id_product, id_member, id_zone, note)
                      VALUE ($num_after, $id_product, $id_member, $id_zone, '')";
      mysqli_query($conn,$insert_draw);
      //-----------------------------/insert draw_history----------------------------------

      //-----------------------------update num_product------------------------------------
      $total_num = $num_befor - $num_after;
      $update_num_product = "UPDATE num_product SET num = $total_num WHERE id_numproduct = $id_numproduct";
      mysqli_query($conn,$update_num_product);
      //-----------------------------//update num_product------------------------------------

      //-----------------------------manage numpd_car----------------------------------------
      $sql_checkcar = "SELECT * FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member";
      $objq_checkcar = mysqli_query($conn,$sql_checkcar);
      $objr_checkcar = mysqli_fetch_array($objq_checkcar);
      $id_numPD_car = $objr_checkcar['id_numPD_car'];
      if(!isset($id_numPD_car)){
         $insert_numpd = "INSERT INTO numpd_car (num, id_product, id_member)
                          VALUE ($num_after, $id_product, $id_member)";
        mysqli_query($conn,$insert_numpd);
      }else{
        $sql_seach_numcar = "SELECT * FROM numpd_car WHERE id_numPD_car = $id_numPD_car";
        $objq_seach_numcar = mysqli_query($conn,$sql_seach_numcar);
        $objr_seach_numcar = mysqli_fetch_array($objq_seach_numcar);
        $num_productcar = $objr_seach_numcar['num'];
        $total_num_product = $num_productcar + $num_after; 
        
        $update_numpd = "UPDATE numpd_car SET num = $total_num_product WHERE id_numPD_car = $id_numPD_car";
        mysqli_query($conn,$update_numpd);
      }
      //-----------------------------//manage numpd_car----------------------------------------
 }
  header('location:../admin.php');
?>