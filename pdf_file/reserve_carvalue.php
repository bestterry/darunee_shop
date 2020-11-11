<?php
  require('fpdf.php');
  require('../config_database/config.php'); 
  require('../session.php');
  require('date/datetime.php');
  $date = $_GET['date'];

  class PDF extends FPDF
    {
    }

  $pdf=new PDF('P','mm','A4');
      // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
      $pdf->AliasNbPages();
      $pdf->SetMargins(14,5,5);
      $pdf->AddFont('angsana','','angsa.php');
      //สร้างหน้าเอกสาร
      $pdf->AddPage();
      $pdf->SetFont('angsana','',18);
      $pdf->SetTextColor(0,0,0); 
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'ค่าใช้จ่ายหน่วยรถ'), 0 , 1,'C');
      $pdf->Ln(3);
      $pdf->Cell(0,5, iconv('UTF-8','cp874' ,'วันที่ : '.Datethai($date)), 0 , 1,'C');
      $pdf->Ln(3);
      $pdf->SetFont('angsana','',15);
      $pdf->Cell(30,8,iconv('UTF-8','cp874','หน่วยรถ'),1,0,'C');
      $pdf->Cell(30,8,iconv('UTF-8','cp874','น้ำมัน'),1,0,'C'); 
      $pdf->Cell(30,8,iconv('UTF-8','cp874','เบี้ยเลี้ยง'),1,0,'C');
      $pdf->Cell(30,8,iconv('UTF-8','cp874','ที่พัก'),1,0,'C');
      $pdf->Cell(30,8,iconv('UTF-8','cp874','จ่ายอื่น'),1,0,'C');
      $pdf->Cell(30,8,iconv('UTF-8','cp874','รวมเงิน'),1,0,'C');
      $pdf->Ln(8);
      

        $sql_member = "SELECT id_member,name FROM member WHERE status_reserve = 1";
        $objq_member = mysqli_query($conn,$sql_member);
        while($value = $objq_member -> fetch_assoc()){
          $id_member = $value['id_member'];
          $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
          $sum_money = 0;
            $sql_resevelist = "SELECT id_list FROM reserve_list WHERE status = 4 ";
            $objq_reservelist = mysqli_query($conn,$sql_resevelist);
            while($value_reservelist = $objq_reservelist->fetch_assoc()){
              $id_list = $value_reservelist['id_list'];
              if ($id_list == 9) {
                $sql_history = "SELECT SUM(money) FROM reserve_history 
                WHERE id_list = $id_list AND id_member_car = $id_member AND DATE_FORMAT(date,'%Y-%m-%d')='$date'";
              }else {
                $sql_history = "SELECT SUM(money) FROM reserve_history 
                WHERE id_list = $id_list AND id_member = $id_member AND DATE_FORMAT(date,'%Y-%m-%d')='$date'";
              }
              $objq_history = mysqli_query($conn,$sql_history);
              while($value_history = $objq_history->fetch_assoc()){
                $sum_money = $sum_money + $value_history['SUM(money)'];
                $pdf->Cell(30,8,iconv('UTF-8','cp874',$value_history['SUM(money)']),1,0,'C');  
                }
              } 
            $pdf->Cell(30,8,iconv('UTF-8','cp874',$sum_money),1,0,'C');  
          $pdf->Ln(8);

    }
  $pdf->Output();
?>