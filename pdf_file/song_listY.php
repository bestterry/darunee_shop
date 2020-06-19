<?php
require('fpdf.php');
require('../config_database/config.php');
require('../session.php'); 
class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        $this->AddFont('cordia','','angsa.php');
        $this->SetFont('cordia','',20);
        $this->Cell(200,8,iconv('UTF-8','cp874','ข้อมูลการเปิดเพลง'),0,1,'C');
        $this->Ln(5);
    }
    // Page footer
    function Footer()
    {
           
        $this->SetY(-20);
        $this->AddFont('cordia','','cordia.php');
        $this->SetFont('cordia','',14);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');//always displayed
        

    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(10,10,10);
            $pdf->AddFont('cordia','','cordia.php');
            //สร้างหน้าเอกสาร
// --------------------------------------------------------------------------------------
          $sql_member = "SELECT id_member,name_sub FROM member";
          $objq_member = mysqli_query($conn,$sql_member);
          while($value_member = $objq_member->fetch_assoc()){
            $id_member = $value_member['id_member'];
            $sql_addorder = "SELECT * FROM song_list WHERE status = 'Y' AND id_member = $id_member";
            $objq_addorder = mysqli_query($conn,$sql_addorder);
            $num_row = mysqli_num_rows($objq_addorder);
            if($num_row == 0){

            }else{
              $pdf->AddPage();
              $pdf->SetFont('cordia','',15);
              $pdf->SetTextColor(0,0,0); 
              $pdf->Text(87, 19,iconv('UTF-8','cp874',''),1,0,'C');
              //สร้างตาราง
              $pdf->SetTextColor(0,0,0);
              $pdf->Cell(38,8,iconv('UTF-8','cp874','ศิลปิน'),1,0,'C');
              $pdf->Cell(38,8,iconv('UTF-8','cp874','ชื่อเพลง'),1,0,'C');
              $pdf->Cell(28,8,iconv('UTF-8','cp874','ยุค'),1,0,'C');
              $pdf->Cell(28,8,iconv('UTF-8','cp874','ทำนอง'),1,0,'C');
              $pdf->Cell(28,8,iconv('UTF-8','cp874','ผู้เปิด'),1,0,'C');
              $pdf->Cell(28,8,iconv('UTF-8','cp874','เวลา'),1,0,'C');
              $pdf->Ln(8);

                while($value = $objq_addorder->fetch_assoc()){
                  $id_song = $value['id_song']; 
                  $pdf->SetTextColor(0,0,0);
                  $pdf->Cell(38,8,iconv('UTF-8','cp874',$value['artist']),1,0,'C');
                  $pdf->Cell(38,8,iconv('UTF-8','cp874',$value['name_song']),1,0,'C');
                  $pdf->Cell(28,8,iconv('UTF-8','cp874',$value['age']),1,0,'C');
                  $pdf->Cell(28,8,iconv('UTF-8','cp874',$value['tune']),1,0,'C');
                  $pdf->Cell(28,8,iconv('UTF-8','cp874',$value_member['name_sub']),1,0,'C');
                  $pdf->Cell(28,8,iconv('UTF-8','cp874',$value['datetime']),1,0,'C');
                  $pdf->Ln(8);
                }
            }
          } 
    $pdf->Output();
?>