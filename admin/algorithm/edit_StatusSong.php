<?php 
 require "../../config_database/config.php"; 
 require "../../session.php"; 

    $id_song = $_GET['id_song'];
    $status = $_GET['status'];
    if ($status == "N") {
      $status = "Y";
    }else {
      $status = "N";
    }
    function DateThai($strDate)
    {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMinute= date("i",strtotime($strDate));
      $strSeconds= date("s",strtotime($strDate));
      $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
      $strMonthThai=$strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strHour:$strMinute น.";
    }
    $datetime = DateThai(date('Y-m-d H:i:s'));
  

    $sql = "UPDATE song_list SET id_member = '$id_member', status = '$status', datetime = '$datetime' WHERE id_song = $id_song";

    if ($conn->query($sql) === TRUE) {
      header('location:../song_list.php?id_age='.$_GET['id_age'].'&&id_sexartist='.$_GET['id_sexartist'].'&&id_tune='.$_GET['id_tune']);
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

   
?>