<?php
require('fpdf.php');
require('../config_database/config.php');
require('../session.php'); 
$month = $_GET['month'];
$year = $_GET['year'];

  function DateThai($strDate)
      {
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$month];
      return "$strMonthThai ";
      }

      $strDate = date('d-m-Y');

class PDF extends FPDF
  {
  // Page header
    function Header()
    {
      $month = $_GET['month'];
      $year = $_GET['year'];
        // Date
        $strDate = date('d-m-Y');
        // Arial bold 15

        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        $this->Cell(20,8,iconv('UTF-8','cp874','ข้อมูลการสั่งของประจำเดือน '.$month .'-'.$year),0,1,'L');

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

            $pdf->Cell(55,8,iconv('UTF-8','cp874','สินค้า_หน่วย'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','เขตแพร่'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','เขตน่าน'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','เขตเชียงใหม่'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','เขตลำพูน'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874','เขตเชียงราย'),1,0,'C');
            $pdf->Ln(8);

        $sql_product = "SELECT * FROM product WHERE NOT id_product = 35";
        $objq_product = mysqli_query($conn,$sql_product);
          while($value = $objq_product->fetch_assoc()){
            $id_product = $value['id_product'];
            $pdf->Cell(55,8,iconv('UTF-8','cp874',$value['name_product'].'_'.$value['unit']),1,0,'C');
            for ($i=1; $i <=5 ; $i++) { 
              $sql_num = "SELECT SUM(num_pd) FROM outside_buy_htr WHERE id_outside = $i AND id_product = $id_product AND (date_buy between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59')";
              $objq_num = mysqli_query($conn,$sql_num);
              $objr_num = mysqli_fetch_array($objq_num);
              $pdf->Cell(25,8,iconv('UTF-8','cp874',$objr_num['SUM(num_pd)']),1,0,'C');
            }
            $pdf->Ln(8);
          }             
    $pdf->Output();
?>