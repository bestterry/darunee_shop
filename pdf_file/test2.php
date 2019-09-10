<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
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
        $this->SetFont('angsana','',16);
        //Date
        $this->SetTextColor(0,0,0); 
        $this->Text(200, 10,iconv('UTF-8','cp874','วันที่  '.DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'เงินขาย สกต.') , 0 , 1,'L' );
        $this->Ln(3);

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
$pdf=new PDF('L','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            // $pdf->AliasNbPages();
            $pdf->SetMargins(5,5,5);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            $pdf->SetFont('angsana','',16);
            $pdf->SetXY(5,10);
            $pdf->Cell(15,14,iconv("UTF-8","TIS-620","ลำดับ"),1,0,'C');
            $pdf->Cell(30,14,iconv("UTF-8","TIS-620","เขตการขาย"),1,0,'C');
            $pdf->Cell(40,14,iconv("UTF-8","TIS-620","ชื่อร้านค้า"),1,0,'C');
            $pdf->Cell(30,14,iconv("UTF-8","TIS-620","จังหวัด"),1,0,'C');
            $pdf->Cell(100,7,iconv("UTF-8","TIS-620","ประจำปี"),1,0,'C');
            $pdf->Cell(40,14,iconv("UTF-8","TIS-620","หมายเหตุ"),1,0,'C');
            $pdf->Ln(7);
            
            $pdf->SetXY(120,17);
            $pdf->Cell(20,7,iconv("UTF-8","TIS-620","2550"),1,0,'C');
            $pdf->Cell(20,7,iconv("UTF-8","TIS-620","2551"),1,0,'C');
            $pdf->Cell(20,7,iconv("UTF-8","TIS-620","2552"),1,0,'C');
            $pdf->Cell(20,7,iconv("UTF-8","TIS-620","2553"),1,0,'C');
            $pdf->Cell(20,7,iconv("UTF-8","TIS-620","2554"),1,0,'C');
            $pdf->Ln();
            
            $pdf->SetXY(5,24); ///ตรงนี้
            
            for($i=1;$i<20;$i++)
            {
              $pdf->Cell(15,7,$i,1,0,'C');
              $pdf->Cell(30,7,iconv("UTF-8","TIS-620","เขตการขาย $i"),1,0,'C');
              $pdf->Cell(40,7,iconv("UTF-8","TIS-620",".co.th"),1,0,'C');
              $pdf->Cell(30,7,iconv("UTF-8","TIS-620","กรุงเทพ"),1,0,'C');
              $pdf->Cell(20,7,iconv("UTF-8","TIS-620","1000"),1,0,'C');
              $pdf->Cell(20,7,iconv("UTF-8","TIS-620","2,000"),1,0,'C');
              $pdf->Cell(20,7,iconv("UTF-8","TIS-620","3000"),1,0,'C');
              $pdf->Cell(20,7,iconv("UTF-8","TIS-620","400"),1,0,'C');
              $pdf->Cell(20,7,iconv("UTF-8","TIS-620","1000"),1,0,'C');
              $pdf->Cell(40,7,"",1,0,'C'); // หมายเหตุ
              $pdf->Ln();
            }
             
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>