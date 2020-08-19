<?php
    require "../../config_database/config.php"; 
    $id_map = $_POST['id_map'];
    $name_map = $_POST['name_map'];
   
   unlink( '../../images/map/' .$name_map);

   if(isset($_FILES['upload'])){
    $namemap_new =  $_FILES['upload']['name'];
    $tmp_name =  $_FILES['upload']['tmp_name'];
    $locate_img ="../../images/map/";
    move_uploaded_file($tmp_name,$locate_img.$namemap_new);

    $sql_updateamp ="UPDATE map SET name_map = '$namemap_new' WHERE id_map = $id_map";
    mysqli_query($conn,$sql_updateamp);
  }

  header('location:../map.php');

?>