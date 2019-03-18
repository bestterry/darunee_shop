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
        $this->SetFont('angsana','',18);
        
        //Date
        $this->SetTextColor(255,0,0); 
        $this->Text(78, 19,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'รายการเบิกสินค้า ประจำวันที่ ') , 0 , 1,'L' );
        
        // Line break
        $this->Ln(2);
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
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดรวมเบิกสินค้า ') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(90,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(60,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Ln(10);
            $i=1;    
            $sql_history = "SELECT * FROM product";
            $objq_history = mysqli_query($conn,$sql_history);
            while($history = $objq_history ->fetch_assoc()){
              $id_product = $history['id_product'];
              $total_sale = "SELECT SUM(draw_history.num_draw) FROM draw_history 
                              INNER JOIN product ON draw_history.id_product=product.id_product
                              WHERE draw_history.id_product = '$id_product' AND DATE_FORMAT(draw_history.datetime,'%d-%m-%Y')='$strDate'";
              $objq_sale = mysqli_query($conn,$total_sale);
              $objr_sale = mysqli_fetch_array($objq_sale);
              $num_product = $objr_sale['SUM(draw_history.num_draw)'];
              if(isset($num_product)){ 
            
            $pdf->Cell(90,8,iconv('UTF-8','cp874',$history['name_product']),1,0,'');
            $pdf->Cell(60,8,iconv('UTF-8','cp874',$num_product.' '.$history['unit']),1,0,'');
            
            $pdf->Ln(8);
                      }
                    } 
// --------------------------------------------------------------------------------------
            $pdf->AddPage();
            $pdf->SetFont('angsana','',16);
            $pdf->SetTextColor(255,0,0); 
            $pdf->Text(87, 19,iconv('UTF-8','cp874',''),1,0,'C');
            //สร้างตาราง
            $pdf->SetTextColor(0,0,0);
            $pdf->Ln(2);
            $pdf->Cell(10,10,iconv('UTF-8','cp874','ลำดับ'),1,0,'C');
            $pdf->Cell(70,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(30,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(30,10,iconv('UTF-8','cp874','ชื่อผู้เบิก'),1,0,'C');
            $pdf->Cell(30,10,iconv('UTF-8','cp874','เบิกจาก'),1,0,'C');
            $pdf->Ln(10);
            $date = "SELECT * FROM draw_history 
                     INNER JOIN product ON draw_history.id_product = product.id_product 
                     INNER JOIN member ON draw_history.id_member = member.id_member
                     INNER JOIN zone ON draw_history.id_zone = zone.id_zone
            WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
            $objq = mysqli_query($conn,$date);
            while($value = $objq ->fetch_assoc()){
            $pdf->Cell(10,8,iconv('UTF-8','cp874',$i),1,0,'C');  
            $pdf->Cell(70,8,iconv('UTF-8','cp874',$value['name_product']),1,0,'L');
            $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['num_draw'].' '.$value['unit']),1,0,'L');
            $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
            $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['name_zone']),1,0,'C');
            $pdf->Ln(8);
            $i++; }                
    $pdf->Output();
?>