<?php
require('fpdf.php');
require('../config_database/config.php');
require('../session.php'); 
$id_outside = $_GET['id_outside'];

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
      return "$strDay $strMonthThai ";
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
            $sql_name = "SELECT * FROM outside WHERE id_outside = $id_outside";
            $objq_name = mysqli_query($conn,$sql_name);
            $objr_name = mysqli_fetch_array($objq_name);
            $pdf->Text(150, 16,iconv('UTF-8','cp874',$objr_name['name'].' '.$objr_name['province']),1,0,'C');
            $pdf->Cell(50,8,iconv('UTF-8','cp874','สินค้า_หน่วย'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','ราคา/น.'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','เงินซื้อ'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','เงินจ่าย'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','หนี้คงเหลือ'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','บัญชีรับโอน'),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
            $pdf->Ln(8);
            $sql_outside = "SELECT * FROM outside_buy_htr 
                            INNER JOIN product ON outside_buy_htr.id_product = product.id_product  
                            WHERE outside_buy_htr.id_outside = $id_outside";
            $objq_outside = mysqli_query($conn,$sql_outside);
            while($value = $objq_outside->fetch_assoc()){
            
            $pdf->Cell(50,8,iconv('UTF-8','cp874',$value['name_product'].' '.$value['unit']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['num_pd']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['price_pd']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['purch_money']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['pay_money']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['balance']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['account_rc']),1,0,'C');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',Datethai($value['date_buy'])),1,0,'C');
            $pdf->Ln(8);
             }                
    $pdf->Output();
?>