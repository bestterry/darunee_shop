<?php 
 require "../../config_database/config.php"; 
 require "../../session.php";
 $id_zone = $_POST['id_zone'];
 $id_member = $_POST['id_member'];
 $note = $_POST['note'];

 for ($i = 0; $i < count($_POST['id_numproduct']); $i++) { 
   $id_numproduct = $_POST['id_numproduct'][$i];
   $id_product = $_POST['id_product'][$i];
   $num_befor = $_POST['num_befor'][$i];
   $num_after = $_POST['num_after'][$i];
   $total_num = $num_befor-$num_after;

      //-----------------------------insert draw_history----------------------------------
      $insert_draw = "INSERT INTO draw_history (num_draw,id_product,id_member,id_zone,note)
                      VALUE ($num_after,$id_product,$id_member,$id_zone,'$note')";
      mysqli_query($conn,$insert_draw);
      //-----------------------------/insert draw_history----------------------------------

      //-----------------------------update num_product------------------------------------
      if($total_num == 0){
        $delete_list = "DELETE FROM num_product WHERE id_numproduct = $id_numproduct";
        mysqli_query($conn,$delete_list);
      }else {
        $update_list = "UPDATE num_product SET num = $total_num WHERE id_numproduct = $id_numproduct";
        mysqli_query($conn,$update_list);
      }
      
      //-----------------------------//update num_product------------------------------------

      //-----------------------------manage numpd_car----------------------------------------
    if($id_member == 19){
      continue;
    }else{
        $sql_checkcar = "SELECT id_numPD_car FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member";
        $objq_checkcar = mysqli_query($conn,$sql_checkcar);
        $objr_checkcar = mysqli_fetch_array($objq_checkcar);
        $id_num = $objr_checkcar['id_numPD_car'];
        if(!isset($id_num)){
          $insert_numpd = "INSERT INTO numpd_car (num,id_product,id_member)
                            VALUE ($num_after,$id_product,$id_member)";
          mysqli_query($conn,$insert_numpd);
        
        }else{
          $sql_numcar = "SELECT num FROM numpd_car WHERE id_numPD_car = $id_num";
          $objq_num = mysqli_query($conn,$sql_numcar);
          $objr_num = mysqli_fetch_array($objq_num);
          $num_productcar = $objr_num['num'];
          $num = $num_productcar+$num_after; 
          
          $update_numpd = "UPDATE numpd_car SET num = $num WHERE id_numPD_car = $id_num";
          mysqli_query($conn,$update_numpd);
        }
    }
      //-----------------------------//manage numpd_car----------------------------------------
 }
  header('location:../total_stock.php');
?>