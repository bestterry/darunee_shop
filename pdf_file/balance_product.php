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
        $this->Text(91, 19,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'รายการสินค้าคงเหลือหน้าร้าน ประจำวันที่') , 0 , 1,'L' );
        
        // Line break
        $this->Ln(2);
    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->SetMargins(25, 15,15);

            $pdf->AddFont('angsana','','angsa.php');

            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
            $pdf->SetFont('angsana','',16);
            

                    $pdf->SetTextColor(255,0,0); 
                    $pdf->Text(87, 19,iconv('UTF-8','cp874',''),1,0,'C');
                    //สร้างตาราง
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Ln(2);
                    $pdf->Cell(70,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
                    $pdf->Cell(27,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
                    $pdf->Cell(27,10,iconv('UTF-8','cp874','หน่วย'),1,0,'C');
                    $pdf->Cell(45,10,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
                    $pdf->Ln(10);
                    $strDate = date('d-m-Y');
                    $date = "SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product WHERE num_product.id_zone = $id_zone";
                    $objq = mysqli_query($conn,$date);
                    while($data = $objq ->fetch_assoc()){
                    $pdf->Cell(70,8,iconv('UTF-8','cp874',$data['name_product']),1,0,'L');
                    $pdf->Cell(27,8,iconv('UTF-8','cp874',$data['num']),1,0,'C');
                    $pdf->Cell(27,8,iconv('UTF-8','cp874',$data['unit']),1,0,'C');
                    $pdf->Cell(45,8,iconv('UTF-8','cp874',''),1,0,'C');
                    $pdf->Ln(8);
                    }                        
    $pdf->Output();
?>