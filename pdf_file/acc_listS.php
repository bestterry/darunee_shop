<?php
require('fpdf.php');

class PDF extends FPDF
  {
   
  // Page header
    function Header()
    {
        // Date
        global $headerVisible;
          if($headerVisible=="true")
          {
            // Arial bold 15
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',20);
            //Date
            $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขาย'.'   '.'1 ก.ค. 63'.' - '.'10 ก.ค. 63'), 0 , 1,'C' );
            $this->Ln(12);
            $this->SetFont('angsana','',16);
            $this->SetXY(15,25);
            $this->Cell(30,14,iconv("UTF-8","TIS-620","วันที่"),1,0,'C');
            $this->Cell(50,14,iconv("UTF-8","TIS-620","ชื่อ - สกุล"),1,0,'C');
            $this->Cell(45,14,iconv("UTF-8","TIS-620","พื้นที่"),1,0,'C');
            $this->Cell(40,7,iconv("UTF-8","TIS-620","ปุ๋ยเคมีกวางฯ"),1,0,'C');
            $this->Cell(40,7,iconv("UTF-8","TIS-620","สารปรับปรุงดินโซเล่"),1,0,'C');
            $this->Cell(40,7,iconv("UTF-8","TIS-620","ปุ๋ยอินทรีย์กวางฯ"),1,0,'C');
            $this->Cell(25,14,iconv("UTF-8","TIS-620","รวมเงิน"),1,0,'C');
            $this->Ln(17);
      
            $this->SetXY(140,32);
            $this->Cell(15,7,iconv("UTF-8","TIS-620","กส."),1,0,'C');
            $this->Cell(25,7,iconv("UTF-8","TIS-620","บาท"),1,0,'C');
            $this->Cell(15,7,iconv("UTF-8","TIS-620","กส."),1,0,'C');
            $this->Cell(25,7,iconv("UTF-8","TIS-620","บาท"),1,0,'C');
            $this->Cell(15,7,iconv("UTF-8","TIS-620","กส."),1,0,'C');
            $this->Cell(25,7,iconv("UTF-8","TIS-620","บาท"),1,0,'C');
            $this->Ln(7);
          }

    }

    // Page footer
    function Footer()
    {
          
        $this->SetY(-15);
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
      $pdf->SetMargins(15,15,15);
      $headerVisible="true";
      $pdf->AddPage();
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('angsana','',16);

      $pdf->Cell(30,10,iconv('UTF-8','cp874','1 ก.ค. 63'),1,0,'C');
      $pdf->Cell(50,10,iconv('UTF-8','cp874','นาย แดง อินต๊ะชัย'),1,0,'C');
      $pdf->Cell(45,10,iconv('UTF-8','cp874','อ.'.'อ.แม่จัน จ.เชียงราย '),1,0,'C');

      $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874','' ),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(30,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(50,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(45,10,iconv('UTF-8','cp874','รวมทั้งสิ้น'),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874','' ),1,0,'C');

// รวมยอด สกต
      $headerVisible="false";
      $pdf->AddPage('P','A4');
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('angsana','',20);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ทีมงานคุณดารุณี') , 0 , 1,'C' );
      $pdf->Ln(5);
      $pdf->SetFont('angsana','',16);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'เลขที่ 379/5 หมู่ที่ 1 ต.แม่เจดีย์ อ.เวียงป่าเป้า จ.เชียงราย โทร. 081-916-9852') , 0 , 1,'C' );
      $pdf->Ln(3);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'รวม ยอดสินค้าส่ง สกต.') , 0 , 1,'C' );
      $pdf->Ln(5);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','สินค้า'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน(กส.)'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','บาท/กส.'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','เป็นเงิน'),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','ปุ๋ยเคมีกวางฯ'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',790),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','สารปรับปรุงดินโซเล่'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',350),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','ปุ๋ยอินทรีย์กวางฯ'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',430),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(110,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','รวมเงิน'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',''),1,0,'C');
      
      
      $pdf->Output();
?>