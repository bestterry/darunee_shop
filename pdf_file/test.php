<?php
require('fpdf.php');
require('../config_database/config.php'); 
  function DateThai($strDate)
      {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMinute= date("i",strtotime($strDate));
      $strSeconds= date("s",strtotime($strDate));
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      return "$strDay $strMonthThai พ.ศ.$strYear";
      }

      $strDate = date('d-m-Y');

class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // Date
        $strDate = date('d-m-Y');
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',20);
        
        //Date
        $this->SetTextColor(255,0,0); 
        $this->Text(80, 9,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ใบสั่งออร์เดอร์') , 0 , 1,'L' ); 
        $this->Ln(5);
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

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(4, 5 ,5);
            $pdf->AddFont('angsana','','angsa.php');

            $pdf->AddPage();
            $pdf->SetFont('angsana','',20);
         
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            
            $col1="PILOT REMARKS\n\n";
            $pdf->MultiCell(80, 10, 'test2', 1, 1);
            
            $pdf->SetXY($x + 80, $y);
            
            $col2="Pilot's Name and Signature\n";
            $pdf->MultiCell(80, 10, 'testsetset', 1);
            $pdf->Ln(0);
                         
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>