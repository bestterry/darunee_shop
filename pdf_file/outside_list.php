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
        $this->Cell(20,8,iconv('UTF-8','cp874','ข้อมูลการสั่งของและชำระเงิน'),0,1,'L');
        $this->Text(150, 16,iconv('UTF-8','cp874','เขต'),1,0,'C');
    }
    // Page footer
    function Footer()
    {
           
            $this->SetY(-20);
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');//always displayed
        

    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(10,10,10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
// --------------------------------------------------------------------------------------
            $pdf->AddPage();
            $pdf->SetFont('angsana','',15);
            $pdf->SetTextColor(255,0,0); 
            $pdf->Text(87, 19,iconv('UTF-8','cp874',''),1,0,'C');
            //สร้างตาราง
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(50,8,iconv('UTF-8','cp874','สินค้า_หน่วย'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','ราคา/น.'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','เงินซื้อ'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','หนี้คงเหลือ'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','เงินจ่าย'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','บัญชีรับโอน'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
            $pdf->Ln(8);
            $date = "SELECT * FROM add_history 
                     INNER JOIN product ON add_history.id_product = product.id_product 
                     INNER JOIN member ON add_history.id_member = member.id_member
                     INNER JOIN zone ON add_history.id_zone = zone.id_zone
            WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
            $objq = mysqli_query($conn,$date);
            while($value = $objq ->fetch_assoc()){
            $pdf->Cell(10,8,iconv('UTF-8','cp874',$i),1,0,'C');  
            $pdf->Cell(50,8,iconv('UTF-8','cp874',$value['name_product'].'_'.$value['unit']),1,0,'L');
            $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['num_add']),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['name_zone']),1,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$value['note']),1,0,'C');
            $pdf->Ln(8);
            $i++; }                
    $pdf->Output();
?>