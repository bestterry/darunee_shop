<?php 
require '../../config_database/config.php';
  $id_member = $_POST['id_member'];
  $id_zone = $_POST['id_zone'];
  $note = $_POST['note'];

    for ($i=0; $i < count($_POST['id_product']); $i++) { 
      $id_product = $_POST['id_product'][$i];
      $num_after = $_POST['num_after'][$i];

      $sql_addhistory = "INSERT INTO add_history (num_add, id_product,id_member, note, id_zone)
                          VALUES ($num_after, $id_product,$id_member,'$note', $id_zone)";
        mysqli_query($conn,$sql_addhistory); 
      
      $sql_numproduct = "SELECT * FROM num_product WHERE id_product = $id_product AND id_zone = $id_zone";
      $objq_numproduct = mysqli_query($conn,$sql_numproduct);
      $objr_numproduct = mysqli_fetch_array($objq_numproduct);
      $id_numproduct = $objr_numproduct['id_numproduct'];
      $num = $objr_numproduct['num'];
      $total_numproduct = $num_after + $num;
      if(!isset($id_numproduct)){
        $sql_insertnum = "INSERT INTO num_product (num, id_product, id_zone)
                          VALUES ($num_after, $id_product, $id_zone)";
        mysqli_query($conn,$sql_insertnum);                  
      }else {
        $sql_updatenum = "UPDATE num_product SET num = $total_numproduct WHERE id_numproduct = $id_numproduct";
        mysqli_query($conn,$sql_updatenum);
      }
        if($id_member == 19){
          continue;
        }else {
          $id_numpd_car = $_POST['id_numpd_car'][$i];
          $num_befor = $_POST['num_befor'][$i];
          $total = $num_befor - $num_after;
          if($total == 0){
              $delete_numpd = "DELETE FROM numpd_car WHERE id_numPD_car = $id_numpd_car";
              mysqli_query($conn,$delete_numpd);
            
          }else{
              $update_numpd = "UPDATE numpd_car SET num = $total WHERE id_numPD_car = $id_numpd_car ";
              mysqli_query($conn,$update_numpd);
          }
        }       
    }
  

  header('location:../add_history.php');
?>