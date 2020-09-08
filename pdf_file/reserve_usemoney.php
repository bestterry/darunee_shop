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
        $this->SetTextColor(255,0,0); 
        $this->Text(75, 19,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'รายการขายหน้าร้าน ประจำวันที่ ') , 0 , 1,'L' );
        if($this->PageNo()>1){
            $this->Ln(2);
            $this->Cell(60,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $this->Cell(24,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','บ/หน่วย'),1,0,'C');
            $this->Cell(24,10,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
            $this->Cell(40,10,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
            $this->Ln(10);
        }
    }

    // Page footer
    function Footer()
    {
            if($this->PageNo() == 1) {
          
        }
        else {
            $this->SetY(-20);
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()-1),0,1,'C');//always displayed
        }

    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(25, 15,15);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขายสินค้า ') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(70,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวนเงิน(บาท)'),1,0,'C');
            $pdf->Ln(10);
                 
               
    $pdf->Output();
?>