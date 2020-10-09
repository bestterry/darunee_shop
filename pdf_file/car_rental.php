<?php
  require('fpdf.php');
  require('../config_database/config.php'); 
  require('../session.php');
  require('date/datetime.php');

  class PDF extends FPDF
    {
      function Header()
      {
        $date = $_GET['date'];
          $this->AddFont('angsana','','angsa.php');
          $this->SetFont('angsana','',18);
          //Date
          $this->SetTextColor(0,0,0); 
          // Title
          $this->SetTextColor(0,0,0);
          $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ค่าเช่ารถ'), 0 , 1,'C');
          $this->Ln(3);
          $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'วันที่ '.DateThai($date)), 0 , 1,'C');
          $this->Ln(3);
          $this->SetFont('angsana','',16);
          $this->Cell(30,8,iconv('UTF-8','cp874','หน่วยรถ'),1,0,'C');
          $this->Cell(30,8,iconv('UTF-8','cp874','ปฏิบัติงาน'),1,0,'C');
          $this->Cell(30,8,iconv('UTF-8','cp874','รถ'),1,0,'C');
          $this->Cell(30,8,iconv('UTF-8','cp874','ค่าเช่ารถ'),1,0,'C');
          $this->Cell(70,8,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
          $this->Ln(8);
      }
    }

  // Instanciation of inherited class
  $pdf=new PDF('P','mm','A4');
      // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
      $pdf->AliasNbPages();
      $pdf->SetMargins(14,5,5);
      $pdf->AddFont('angsana','','angsa.php');
      //สร้างหน้าเอกสาร
      $pdf->AddPage();
      $pdf->SetFont('angsana','',16);
      $date = $_GET['date'];
      $sql_member = "SELECT id_member,name FROM member WHERE status_car = 1";
      $objq_member = mysqli_query($conn,$sql_member);
      while($value = $objq_member -> fetch_assoc()){
        $id_member = $value['id_member'];
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
          $sum_money = 0;
          $sql_carrental = "SELECT * FROM car_rental 
                            INNER JOIN rc_practice ON rc_practice.id_practice = car_rental.id_practice 
                            WHERE id_member = $id_member AND date = '$date'";
          $objq_carrental = mysqli_query($conn,$sql_carrental);
          if ($objq_carrental->num_rows > 0 ) {
          $objr_carental = mysqli_fetch_array($objq_carrental);
          $member_car = $objr_carental['member_car'];
          $sql_member = "SELECT name FROM member WHERE id_member = $member_car";
          $objq_car = mysqli_query($conn,$sql_member);
          $objr_member = mysqli_fetch_array($objq_car);
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$objr_carental['name_practice']),1,0,'C');
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$objr_member['name']),1,0,'C');
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$objr_carental['money']),1,0,'C');
        $pdf->Cell(70,8,iconv('UTF-8','cp874',$objr_carental['note']),1,0,'C');
          }else{
            $pdf->Cell(30,8,iconv('UTF-8','cp874','-'),1,0,'C');
            $pdf->Cell(30,8,iconv('UTF-8','cp874','-'),1,0,'C');
            $pdf->Cell(30,8,iconv('UTF-8','cp874','-'),1,0,'C');
            $pdf->Cell(70,8,iconv('UTF-8','cp874','-'),1,0,'C');
          }
        $pdf->Ln(8);
      }
  $pdf->Output();
?>