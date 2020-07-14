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
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'สต๊อก    รถทั้งหมด') , 0 , 1,'L' );
        $this->Ln(3);
        $this->SetFont('angsana','',14);
        $this->Cell(10,10,iconv('UTF-8','cp874','ที่'),1,0,'C');
        $this->Cell(50,10,iconv('UTF-8','cp874','สินค้า_หน่วย'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','ยุทธ'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','นลิน'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เอ'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','รงค์'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เอ๋'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เกียรติ'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เดี่ยว'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','อั๋น'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เบส'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','หนึ่ง'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','บอย'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เอี่ยว'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เค'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','เอ็กซ์'),1,0,'C');
        $this->Cell(14,10,iconv('UTF-8','cp874','รอน'),1,0,'C');
        $this->Cell(18,10,iconv('UTF-8','cp874','รวม'),1,0,'C');
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
    $pdf->AliasNbPages();
    $pdf->SetMargins(5,10,10);
    $pdf->AddFont('angsana','','angsa.php');
    $pdf->AddPage();
    $pdf->SetFont('angsana','',14);

    $pdf->Cell(10,10,iconv('UTF-8','cp874','ที่'),1,0,'C');
    $pdf->Cell(50,10,iconv('UTF-8','cp874','sHD_ลัง'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(14,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Cell(18,10,iconv('UTF-8','cp874','10'),1,0,'C');
    $pdf->Ln(10);
                       
    $pdf->Output();
?>