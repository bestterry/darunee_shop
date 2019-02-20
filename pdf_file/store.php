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
        $this->Text(150, 20,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Text(3,20, iconv( 'UTF-8','cp874' , 'รถ (เจ้าของรถ) : ___________________') , 0 , 1,'L' );
        $this->Text(140, 20,iconv('UTF-8','cp874','วันที่'),1,0,'C');

        $this->SetFont('angsana','',20);
        $this->SetTextColor(0,0,0);
        $this->Text(95,10, iconv( 'UTF-8','cp874' , 'สต๊อกรถ') , 0 , 1,'L' );
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
            $pdf->SetMargins(3, 15,10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            $pdf->SetTextColor(255,0,0); 
            $pdf->SetFont('angsana','',15);
            $pdf->Ln(8);
            $pdf->Cell(8,10,iconv('UTF-8','cp874','ที่'),1,0,'C');
            $pdf->Cell(50,10,iconv('UTF-8','cp874','สินค้า'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','หน่วย'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','ยกมา(+)'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','รับเข้า(+)'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','เบิกออก(-)'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','ขาย(-)'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','อื่นๆ(-)'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','คืนร้าน'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','เหลือ'),1,0,'C');
            $pdf->Cell(16,10,iconv('UTF-8','cp874','นับจริง'),1,0,'C');

            $pdf->Ln(10);
  $store = "SELECT * FROM store_incar INNER JOIN product 
            ON store_incar.id_product = product.id_product WHERE store_incar.id_member = $id_member";
  $query_store = mysqli_query($conn,$store);
  $i = 1;
  while($list = $query_store -> fetch_assoc()){
    $pdf->SetTextColor(0,0,0); 
            $pdf->Cell(8,8,iconv('UTF-8','cp874',$i),1,0,'C');
            $pdf->Cell(50,8,iconv('UTF-8','cp874',$list['name_product']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['unit']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['bring']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['input']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['draw']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['sale']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['etc']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['ret']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['surplus']),1,0,'C');
            $pdf->Cell(16,8,iconv('UTF-8','cp874',$list['count']),1,0,'C');

            $pdf->Ln(8);
  $i++;}
  $pdf->SetFont('angsana','',17);
  $pdf->Text(35,20, iconv( 'UTF-8','cp874' , $username) , 0 , 1,'L' );
// --------------------------------------------------------------------------------------              
    $pdf->Output();
?>