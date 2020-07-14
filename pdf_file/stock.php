<?php
require('fpdf.php');


class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        //Date
        $this->SetTextColor(0,0,0); 
        $this->Text(200, 15,iconv('UTF-8','cp874','วันที่  '.'9 กรกฎาคม พ.ศ.2563'),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'สต๊อก รวมทั้งหมด') , 0 , 1,'L' );
        $this->Ln(3);
            $this->Cell(15,10,iconv('UTF-8','cp874','ที่'),1,0,'C');
            $this->Cell(50,10,iconv('UTF-8','cp874','ชื่อสินค้า'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','หน่วย'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','จุน'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','พาน'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','ดคต.'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','วปป.'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','เกาะคา'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','ลำพูน'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','ขายส่ง'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','แม่จัน'),1,0,'C');
            $this->Cell(17,10,iconv('UTF-8','cp874','แจ้ห่ม'),1,0,'C');
            $this->Cell(18,10,iconv('UTF-8','cp874','รถ'),1,0,'C');
            $this->Cell(23,10,iconv('UTF-8','cp874','ทั้งหมด'),1,0,'C');
            $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
            $this->SetY(-20);
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }
  }

  $pdf=new PDF('L','mm','A4');
    // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
    $pdf->AliasNbPages();
    $pdf->SetMargins(10,10,10);
    $pdf->AddFont('angsana','','angsa.php');
    //สร้างหน้าเอกสาร
    $pdf->AddPage();
    $pdf->SetFont('angsana','',16);
    $pdf->Cell(15,10,iconv('UTF-8','cp874','ที่'),1,0,'C');
    $pdf->Cell(50,10,iconv('UTF-8','cp874','sHD'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(17,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(18,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Cell(23,10,iconv('UTF-8','cp874','100'),1,0,'C');
    $pdf->Ln(10);
            
                            
    $pdf->Output();