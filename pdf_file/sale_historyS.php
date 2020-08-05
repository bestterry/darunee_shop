<?php
    require('fpdf.php');

    class PDF extends FPDF
      {
        // Page header
        function Header()
        {
            // Date
            $strDate = date('d-m-Y');
            // Arial bold 15
            $this->AddFont('cordia','','cordia.php');
            $this->SetFont('cordia','',16);
            
            //Date
            $this->SetTextColor(255,0,0); 
            $this->Text(67, 19,iconv('UTF-8','cp874','18 กรกฎาคม พ.ศ.2563'),1,0,'C');
            // Title
            $this->SetTextColor(0,0,0);
            $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'รายการขายหน้าร้าน ประจำวันที่ ') , 0 , 1,'L' );
        }

        // Page footer
        function Footer()
        {
              
        }
      }

      $pdf=new PDF('P','mm','A4');
            $pdf->AliasNbPages();
            $pdf->SetMargins(15,15,15);
            $pdf->AddFont('cordia','','angsa.php');
            // ----------------------------------------สรุปยอดเงินหน่วยรถและหน้าร้าน----------------------------------------------
            $pdf->AddPage();
            $pdf->SetFont('cordia','',18);
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขายสินค้า ') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('cordia','',16);
            $pdf->Cell(90,10,iconv('UTF-8','cp874','หน่วยขาย'),1,0,'R');
            $pdf->Cell(90,10,iconv('UTF-8','cp874','เงินขาย'),1,0,'L');
            $pdf->Ln(10);
                
            $pdf->Cell(90,8,iconv('UTF-8','cp874','เบส'),1,0,'R');
            $pdf->Cell(90,8,iconv('UTF-8','cp874','12000'),1,0,'L');
            $pdf->Ln(8);

            $pdf->Cell(90,8,iconv('UTF-8','cp874','รวมเป็นเงิน'),1,0,'R');
            $pdf->Cell(90,8,iconv('UTF-8','cp874','12000'),1,0,'L');  
            // --------------------------------------------------------------------------------------

            $pdf->AddPage();
            // -------------------------------------หน้าร้านและหน่วยรถ---------------------------------------------    
            $pdf->SetFont('cordia','',18);
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'เบส') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('cordia','',16);
            $pdf->Cell(40,8,iconv('UTF-8','cp874','สินค้า_หน่วย'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','บ/หน่วย'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
            $pdf->Cell(60,8,iconv('UTF-8','cp874','รายละเอียด'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','เวลา'),1,0,'C');
            $pdf->Ln(8);
            $pdf->Cell(40,8,iconv('UTF-8','cp874','SOLE_กส'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','300'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','340'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','120000'),1,0,'C');
            $pdf->Cell(60,8,iconv('UTF-8','cp874','ร้านพ่อสมควร มสร.'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','11.30'),1,0,'C');
            $pdf->Ln(8);
                          
           $pdf->Output();
?>