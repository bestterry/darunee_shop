<?php
require('fpdf.php');

class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        
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
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddFont('cordia','','cordia.php');
        //สร้างหน้าเอกสาร
        $pdf->AddPage();
        // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
        $pdf->SetFont('cordia','',18);
        $pdf->Cell(100,8, iconv( 'UTF-8','cp874' , 'เงินขายรายวัน') , 0 , 1,'L' );
        $pdf->Ln(3); 
        $pdf->SetFont('cordia','',14);
        $pdf->Cell(25,7,iconv('UTF-8','cp874','Boss'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','สนง'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','เงิน'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','วันที่ขาย'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','วันรับ'),1,0,'C');
        $pdf->Cell(100,7,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
        $pdf->Ln(7); 
        $pdf->Cell(25,7,iconv('UTF-8','cp874',''),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','เอ'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','รับ'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','50,000'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','สด'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','18 ก.ค. 63'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','17 ก.ค. 63'),1,0,'C');
        $pdf->Cell(100,7,iconv('UTF-8','cp874','ฝากขาย ร้าน ช.มั่งมีศรีสูขการเกษตร อ.สอง'),1,0,'C');
        $pdf->Ln(7);  
        $pdf->Cell(25,7,iconv('UTF-8','cp874',''),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','เอ'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874',''),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','20,000'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','เช็ค'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','18 ก.ค. 63'),1,0,'C');
        $pdf->Cell(25,7,iconv('UTF-8','cp874','20 ก.ค. 63'),1,0,'C');
        $pdf->Cell(100,7,iconv('UTF-8','cp874','ร้าน ช.มั่งมีศรีสูขการเกษตร อ.สอง'),1,0,'C');
        $pdf->Ln(7); 

        $pdf->AddPage();
        // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
        $pdf->SetFont('cordia','',18);
        $pdf->Cell(100,8, iconv( 'UTF-8','cp874' , 'เงินขายอยู่กับ') , 0 , 1,'L' );
        $pdf->Ln(3); 
        $pdf->SetFont('cordia','',14);
        $pdf->Cell(40,7,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','สด'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','เช็ค'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','สกต'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','เชื่อ'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','ฝาก'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','รวม'),1,0,'C');
        $pdf->Ln(7); 
        $pdf->Cell(40,7,iconv('UTF-8','cp874','เอ'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','50,000'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','20,000'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','-'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','-'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','-'),1,0,'C');
        $pdf->Cell(40,7,iconv('UTF-8','cp874','70,000'),1,0,'C');
        $pdf->Ln(7); 
              
$pdf->Output();
?>