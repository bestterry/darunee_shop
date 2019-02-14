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

// Instanciation of inherited class
$pdf=new FPDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->SetMargins(15, 15,15);

            $pdf->AddFont('angsana','','angsa.php');

            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
            $pdf->SetFont('angsana','',16);
            $pdf->SetTextColor(0,0,0); 
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ใบเบิกสินค้า') , 0 , 1,'C' );
            $pdf->Ln(2);
            $pdf->SetFont('angsana','',20);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'ทีมงานคุณดารุณี') , 0 , 1,'C' );
            $pdf->Ln(8);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'เลขที่31/1 หมู่ 12 ตําบลสันสลีอําเภอเวียงป่าเป้า จังหวัดเชียงราย 57170 โทร 081-916-9852') , 0 , 1,'C' );
            $pdf->Ln(8);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,DateThai($strDate).'                         ') , 0 , 1,'R' );
            $pdf->Ln(8);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'ชื่อผู้เบิก : '.$_POST['name']) , 0 , 1,'L' );
            $pdf->Ln(4);

            $pdf->Cell(15,12,iconv('UTF-8','cp874','ลำดับ'),1,0,'C');
            $pdf->Cell(100,12,iconv('UTF-8','cp874','รายการสินค้า'),1,0,'C');
            $pdf->Cell(30,12,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(30,12,iconv('UTF-8','cp874','หน่วย'),1,0,'C');
            $pdf->Ln(12);
            for ($i=0; $i < count($_POST['name_product']) ; $i++) { $pdf->Cell(15,8,iconv('UTF-8','cp874',$i+1),1,0,'C');
            $pdf->Cell(100,8,iconv('UTF-8','cp874',$_POST['name_product'][$i]),1,0,'C');
            $pdf->Cell(30,8,iconv('UTF-8','cp874',$_POST['num_product'][$i]),1,0,'C');
            $pdf->Cell(30,8,iconv('UTF-8','cp874',$_POST['unit'][$i]),1,0,'C');
            $pdf->Ln(8);
            }
            $pdf->Ln(10);
            $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'ลงชื่อ ................................................................ผู้ยืนยัน') , 0 , 1,'R' );
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'( ..................................................................... )         ') , 0 , 1,'R' );
            $pdf->Ln(8);               
    $pdf->Output();
?>