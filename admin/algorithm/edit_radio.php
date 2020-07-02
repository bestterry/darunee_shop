<?php 
 require "../../config_database/config.php";
 require "../../session.php";

    $id_radio = $_POST['id_radio'];
    $wave = $_POST['wave'];
    $name_hire = $_POST['name_hire'];
    $tel_hire = $_POST['tel_hire'];
    $note = $_POST['note'];
    $id_radio_time = $_POST['id_radio_time'];
    $province_id = $_POST['province_name'];
    $amphur_id = $_POST['amphur_name'];

    if (!empty($id_radio_time)) {
      $update_time = "UPDATE radio SET id_radio_time=$id_radio_time WHERE id_radio=$id_radio";
      mysqli_query($conn,$update_time);
    }else{
      
    }

    if (!empty($amphur_id)) {
      $update_amphur = "UPDATE radio SET amphur_id = $amphur_id ,province_id = $province_id WHERE id_radio=$id_radio";
      mysqli_query($conn,$update_amphur);
    }else{
      
    }
    $update_radio = "UPDATE radio SET wave = '$wave',name_hire = '$name_hire',tel_hire = '$tel_hire' ,note = '$note' WHERE id_radio=$id_radio";
    mysqli_query($conn,$update_radio);

      header("location:../radio_edit.php?id_radio=".$id_radio);


?>