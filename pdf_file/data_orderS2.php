<?php
require('fpdf.php');
require('../config_database/config.php'); 

class PDF extends FPDF
  {
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(27, 20 ,20);
            $pdf->AddFont('cordia','','cordia.php');
            
              //สร้างหน้าเอกสาร
              $pdf->AddPage();

              $pdf->SetFont('cordia','',26);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'หลังใบสั่ง') , 0 , 1,'C' );
              $pdf->Ln(20);

              $pdf->SetFont('cordia','',18);
              $pdf->Text(105, 37,iconv('UTF-8','cp874','1'),1,0,'C');
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'วันที่สินค้ามาถึง  :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'31 ธ.ค. 63') , 0 , 1,'L');
              $pdf->Ln(10);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'จำนวน :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'325') , 0 , 1,'L');
              $pdf->Ln(5);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ราคาต่อหน่วย :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'180') , 0 , 1,'L');
              $pdf->Ln(5);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'เงินซื้อ :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'58500') , 0 , 1,'L');
              $pdf->Ln(5);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ค่าขนส่ง :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'15000') , 0 , 1,'L');
              $pdf->Ln(10);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ใบจ่าย :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'') , 0 , 1,'L');
              $pdf->Ln(10);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ผู้ตรวจสอบ :' ),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'') , 0 , 1,'L');
              $pdf->Ln(12);
              //$pdf->Text(91, 274,iconv('UTF-8','cp874',''),1,0,'L');
              
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>