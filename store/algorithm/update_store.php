<?php
 require "../../config_database/config.php";
 $id_member = $_GET['id_member'];
 
 $sql_store = "SELECT * FROM store_incar WHERE id_member = $id_member";
 $objq_store = mysqli_query($conn,$sql_store);

  while($store = $objq_store -> fetch_assoc()){
    $id_store_incar = $store['id_store_incar'];
    $surplus = $store['surplus'];

    if($surplus == 0){
      $delete_store = "DELETE FROM store_incar WHERE id_store_incar =  $id_store_incar";
      mysqli_query($conn,$delete_store);
    }
    else
    {
        $update_store = " UPDATE store_incar
                          SET bring = $surplus, input = 0, draw = 0, sale = 0, etc=0, ret=0, surplus=0, count = 0 
                          WHERE id_store_incar =  $id_store_incar";
        mysqli_query($conn,$update_store);
    }   
  }
  header('location:../store.php');
?>