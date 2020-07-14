<?php
require('fpdf.php');

class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // angsana
        $this->AddFont('cordia','','cordia.php');
        $this->SetFont('cordia','',16);
        $this->SetTextColor(0,0,0);

        $this->Cell(0,8, iconv( 'UTF-8','cp874' ,'Boss') , 0 , 1,'L' );
        $this->Cell(15,8,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
        $this->Cell(35,8,iconv('UTF-8','cp874','เงิน'),1,0,'C');
        $this->Cell(15,8,iconv('UTF-8','cp874','วันที่ขาย'),1,0,'C');
        $this->Cell(15,8,iconv('UTF-8','cp874','วันรับ'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
        $this->Ln(8);  
    }
    function Footer()
    {
        $this->SetY(-20);
        $this->AddFont('cordia','','cordia.php');
        $this->SetFont('cordia','',14);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }
  }
$pdf=new PDF('L','mm','A4');
        // ตั้งค่าขอบกระดาษทุกด้าน 15 มิลลิเมตร
        $pdf->SetMargins(8, 10, 10);
        $pdf->AddFont('cordia','','cordia.php');
        //สร้างหน้าเอกสาร
        $pdf->AddPage();
        // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
        $pdf->SetFont('cordia','',16);
        $pdf->SetTextColor(0,0,0);

          $pdf->Cell(15,8,iconv('UTF-8','cp874',''),1,0,'C');
          $pdf->Cell(20,8,iconv('UTF-8','cp874',''),1,0,'C');
          $pdf->Cell(35,8,iconv('UTF-8','cp874',''),1,0,'C');
          $pdf->Cell(15,8,iconv('UTF-8','cp874',''),1,0,'C');
          $pdf->Cell(15,8,iconv('UTF-8','cp874',''),1,0,'C');
          $pdf->Cell(20,8,iconv('UTF-8','cp874',''),1,0,'C');               
$pdf->Output();
?>