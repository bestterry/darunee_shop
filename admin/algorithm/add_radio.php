<?php 
  require "../../config_database/config.php";
  require "../../session.php"; 

  $id_radio_time = $_POST['id_radio_time'];
  $wave = $_POST['wave'];
  $province_id = $_POST['province_name'];
  $amphur_id = $_POST['amphur_name'];
  $note = $_POST['note'];

  $insert_song = "INSERT INTO radio (id_radio_time, wave, province_id, amphur_id, note) 
                   VALUE ($id_radio_time,'$wave',$province_id,$amphur_id, '$note')";
      if ($conn->query($insert_song) === TRUE) {
        header('location:../radio_list2.php');
    } else {
        echo "Error: " . $insert_song . "<br>" . $conn->error;
    }

    $conn->close();

 
?>