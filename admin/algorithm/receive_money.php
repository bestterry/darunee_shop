<?php
  require "../../config_database/config.php";
  require "../../session.php";

  function DateThai($strDate)
 {
   $strYear = date("Y",strtotime($strDate))+543-2500;
   $strMonth= date("n",strtotime($strDate));
   $strDay= date("j",strtotime($strDate));
   $strHour= date("H",strtotime($strDate));
   $strMinute= date("i",strtotime($strDate));
   $strSeconds= date("s",strtotime($strDate));
   $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
   $strMonthThai=$strMonthCut[$strMonth];
   return "$strDay $strMonthThai $strYear";
 }

  $id_receive_money = $_GET['id_receive_money'];
  echo $status = $_GET['status'];
  $statusb = $_GET['statusb']; 
  $date = date("Y-m-d");
  $th_date = DateThai($date);

    if($status == 'Y'){
        if ($statusb == "office") {
          $update_rc_office = "UPDATE rc_receive_money SET status_office = '$status', date_office = '$th_date' WHERE id_receive_money = $id_receive_money";
          mysqli_query($conn,$update_rc_office);
        }
        elseif ($statusb == "boss") {
          $update_rc_boss = "UPDATE rc_receive_money SET status_office = '$status', status_boss = '$status', date_boss = '$th_date' WHERE id_receive_money = $id_receive_money";
          mysqli_query($conn,$update_rc_boss);
        }
    }else{
      if ($statusb == "office") {
        $update_rc_office = "UPDATE rc_receive_money SET status_office = '$status', date_office = '' WHERE id_receive_money = $id_receive_money";
        mysqli_query($conn,$update_rc_office);
      } 
      elseif ($statusb == "boss") {
        $update_rc_boss = "UPDATE rc_receive_money SET status_boss = '$status', date_boss = '' WHERE id_receive_money = $id_receive_money";
        mysqli_query($conn,$update_rc_boss);
      }
    }

  header('location:../receive_money.php');
?>