<?php 
 require "../../config_database/config.php";
 require "../../session.php";
 $id_member = $_POST['id_member'];
 $note = $_POST['note'];
 $status = $_POST['status'];
  if($status == 'etc'){
    //----------------------------------mansge num_product = etc ------------------------------------
    for($i=0;$i < count($_POST['id_product']); $i++){
      $id_product = $_POST['id_product'][$i];
      $select_product = "SELECT num FROM num_product WHERE id_product = $id_product AND id_zone = $id_zone";
      $objq_product = mysqli_query($conn,$select_product);
      $objr_product = mysqli_fetch_array($objq_product);
      $num_befor = $objr_product['num'];
      $num_after = $_POST['num'][$i];
      $total_num = $num_after + $num_befor;
       if(!isset($num_befor)){
        $insert_num = "INSERT INTO num_product (num, id_product, id_zone)
        VALUE ($num_after, $id_product, $id_zone)";  
        mysqli_query($conn,$insert_num);
        
       }else{
        $update_num_product = "UPDATE num_product SET num = $total_num WHERE id_product = $id_product AND id_zone = $id_zone";
        mysqli_query($conn,$update_num_product);
       
       }
        
        //-------------------------INSERT add_history---------------------------------------
        $insert_add = "INSERT INTO add_history (num_add, id_product, id_member, note, id_zone)
        VALUE ($num_after, $id_product, $id_member, '$note', $id_zone)";  
        mysqli_query($conn,$insert_add);
        //-------------------------/INSERT add_history---------------------------------------

      //----------------------------------//manage num_product = etc ------------------------------------
    }
  }else{
    for ($i=0; $i < count($_POST['id_product']); $i++) { 
        # code...
        $id_product = $_POST['id_product'][$i];
        $num_befor = $_POST['num_befor'][$i];
        $num_after = $_POST['num_after'][$i];
        $total_num =  $num_befor - $num_after;
    
        //----------------------------------manage num_product = car ------------------------------------
        $select_product = "SELECT num FROM num_product WHERE id_product = $id_product AND id_zone = $id_zone";
        $objq_product = mysqli_query($conn,$select_product);
        $objr_product = mysqli_fetch_array($objq_product);
    
        if(!isset($objr_product['num'])){
          $insert_num_product = "INSERT INTO num_product (num, id_product, id_zone)
                      VALUE ($num_after, $id_product, $id_zone)";  
          mysqli_query($conn,$insert_num_product);
        }else{
          $num = $num_after + $objr_product['num'];
          $update_num_product = "UPDATE num_product SET num = $num WHERE id_product = $id_product AND id_zone = $id_zone";
          mysqli_query($conn,$update_num_product);
        }
        //----------------------------------//mansge num_product------------------------------------
    
        //-------------------------INSERT add_history---------------------------------------
        $insert_add = "INSERT INTO add_history (num_add, id_product, id_member, note, id_zone)
                      VALUE ($num_after, $id_product, $id_member, '$note', $id_zone)";  
        mysqli_query($conn,$insert_add);
        //-------------------------/INSERT add_history---------------------------------------
    
    
    
        //----------------------------update or delete Numpd_car-------------------------------
        if($total_num == 0){
          $delete_nupd = "DELETE FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member";
          mysqli_query($conn,$delete_nupd);
        }else{
          $update_numpd_car = "UPDATE numpd_car SET num = $total_num WHERE id_product = $id_product AND id_member = $id_member";
          mysqli_query($conn,$update_numpd_car);
        }
        //----------------------------/update or delete Numpd_car-------------------------------
      }
    
  }
  header("location:../../product.php");
?>