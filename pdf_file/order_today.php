<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');
require('../config_database/config.php'); 
require('date/datetime.php');


class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // Date
        $strDate = date('Y-m-d');
        // Arial bold 15
        $this->AddFont('cordia','','cordia.php');
        $this->SetFont('cordia','',20);
        
        //Date
        $this->SetTextColor(255,0,0); 
        $this->Text(95, 9,iconv('UTF-8','cp874','1 มิ.ย. 63'),1,0,'C');
        
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ORDER วันนี้') , 0 , 1,'L' ); 
        $this->Ln(2);
    }
    // Page footer
    function Footer()
    {
          
            $this->SetY(-20);
            $this->SetFont('cordia','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(10, 5 ,3);
            $pdf->AddFont('cordia','','cordia.php');
            $pdf->SetFont('cordia','',16);
            //วนลูปหาอำเภอที่มีใน addorder
            $pdf->AddPage();
            $pdf->Text(190, 9,iconv('UTF-8','cp874','555555'),1,0,'C');

                  $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'_______________________________________________________________________________________________________') , 0 , 1,'L' );
                  $pdf->Ln(4); 
                  
                  $x = $pdf->GetX();
                  $y = $pdf->GetY();
                  //รายการสินค้า
                 
                   
                    $pdf->Cell(20,7, iconv( 'UTF-8','cp874' ,'sHD'.'_'.'ลัง'),0,0,'R');
                    $pdf->SetTextColor(255,0,0); 
                    $pdf->Cell(15,7, iconv( 'UTF-8','cp874' ,'20'),0,0,'R');
                    $pdf->SetTextColor(0,0,0); 
                    $pdf->Cell(16,7, iconv( 'UTF-8','cp874' ,'576'),0,0,'R');
                    $pdf->Cell(20,7, iconv( 'UTF-8','cp874','2500'),0,0,'R');
                    $pdf->Ln(7);
                   
                  $pdf->Cell(51,7, iconv( 'UTF-8','cp874' ,''),0,0,'L');
                  $pdf->Cell(20,7, iconv( 'UTF-8','cp874' ,'[ '. '2500' .' ]'),0,0,'R');
                  
                  $pdf->SetXY($x + 85, $y);
                  //ที่อยู่ลูกค้า 
                  $pdf->MultiCell( 140  , 7 , iconv( 'UTF-8','cp874' ,'001'.' '.'ร้านแม่คำ'.' 
บ.'.'สบก๊อ'. '
ต.'.'ท่าก๊อ'.' อ.'.'แม่สรวย'.' จ.'.'เชียงราย'.'
'.'1 มิ.ย.'.' '.'สนง.'  .' '. '10.25 น.'.' '.'085-858-5555' .'
# '.'มินโทร/ขอด่วน') );

                  $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'_______________________________________________________________________________________________________') , 0 , 1,'L' );
                  $pdf->Ln(4); 

                  $x = $pdf->GetX();
                  $y = $pdf->GetY();

                  $pdf->Cell(20,7, iconv( 'UTF-8','cp874' ,'sHD'.'_'.'ลัง'),0,0,'R');
                  $pdf->SetTextColor(255,0,0); 
                  $pdf->Cell(15,7, iconv( 'UTF-8','cp874' ,'20'),0,0,'R');
                  $pdf->SetTextColor(0,0,0); 
                  $pdf->Cell(16,7, iconv( 'UTF-8','cp874' ,'576'),0,0,'R');
                  $pdf->Cell(20,7, iconv( 'UTF-8','cp874','2500'),0,0,'R');
                  $pdf->Ln(7);

                  $pdf->Cell(51,7, iconv( 'UTF-8','cp874' ,''),0,0,'L');
                  $pdf->Cell(20,7, iconv( 'UTF-8','cp874' ,'[ '. '2500' .' ]'),0,0,'R');

$pdf->SetXY($x + 85, $y);
//ที่อยู่ลูกค้า 
$pdf->MultiCell( 140  , 7 , iconv( 'UTF-8','cp874' ,'001'.' '.'ร้านแม่คำ'.' 
บ.'.'สบก๊อ'. '
ต.'.'ท่าก๊อ'.' อ.'.'แม่สรวย'.' จ.'.'เชียงราย'.'
'.'1 มิ.ย.'.' '.'สนง.'  .' '. '10.25 น.'.' '.'085-858-5555' .'
# '.'มินโทร/ขอด่วน') );
              
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>