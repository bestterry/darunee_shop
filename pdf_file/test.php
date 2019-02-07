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
        $this->Text(83, 14,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'ตารางบันทึกรายการขายหน้าร้าน ประจำวันที่ ') , 0 , 1,'L' );
        
        // Line break
        $this->Ln(2);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // set front
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        // Page number
        $this->Cell(0,10,iconv( 'UTF-8','cp874' , 'หน้า ').$this->PageNo(),0,0,'C');
    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AddFont('angsana','','angsa.php');

            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            
            $pdf->Addfont('angsa','','angsa.php');
            // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
            $pdf->SetFont('angsana','',16);
            

                    $pdf->SetTextColor(255,0,0); 
                    $pdf->Text(87, 19,iconv('UTF-8','cp874',''),1,0,'C');
                    //สร้างตาราง
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Ln(2);
                    $pdf->Cell(70,8,iconv('UTF-8','cp874','รายการ'),1,0,'C');
                    $pdf->Cell(27,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
                    $pdf->Cell(20,8,iconv('UTF-8','cp874','บ/หน่วย'),1,0,'C');
                    $pdf->Cell(27,8,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
                    $pdf->Cell(40,8,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
                    $pdf->Ln(8);
                    $strDate = date('d-m-Y');
                    $date = "SELECT * FROM sale_history
                            WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND status_sale='sale'";
                    $objq = mysqli_query($conn,$date);
                    foreach($objq as $data){
                        $id_sale = $data['id_sale_history'];
                        $SQL_product = "SELECT * FROM product INNER JOIN sale_history 
                        ON product.id_product = sale_history.id_product 
                        WHERE sale_history.id_sale_history='$id_sale'";
                        $objq_product = mysqli_query($conn,$SQL_product);
                        $objr_product = mysqli_fetch_array($objq_product);
                    $pdf->Cell(70,8,iconv('UTF-8','cp874',$objr_product['name_product']),1,0,'L');
                    $pdf->Cell(27,8,iconv('UTF-8','cp874',$objr_product['num_sale'].' '.'('.$objr_product['unit'].')'),1,0,'L');
                    $pdf->Cell(20,8,iconv('UTF-8','cp874',$objr_product['price']/$objr_product['num_sale']),1,0,'C');
                    $pdf->Cell(27,8,iconv('UTF-8','cp874',$objr_product['price']),1,0,'C');
                    $pdf->Cell(40,8,iconv('UTF-8','cp874',''),1,0,'C');
                    $pdf->Ln(8);
                    }

                    //ยืนยันรับเงิน(ส่วนของการประปา)
    $pdf->Output();
?>