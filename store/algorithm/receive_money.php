<?php
  require "../../config_database/config.php";

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

  $date_now = date("Y-m-d");
  $th_date = DateThai($date_now);

    $id_member = $_POST['id_member'];
    $id_practice = $_POST['id_practice'];
    $area = $_POST['area'];
    $money = $_POST['money'];
    $id_category = $_POST['id_category'];
    $date = $_POST['date'];
    $note = $_POST['note'];

    $sql = "INSERT INTO rc_receive_money (id_member, id_practice, area, money, id_category, date_buy, date, status_office, status_boss, note)
                                  VALUES ($id_member, $id_practice, '$area', $money, $id_category, '$th_date', '$date', 'N', 'N', '$note')";
             mysqli_query($conn,$sql);

            
 header('location:../receive_money.php');

?>