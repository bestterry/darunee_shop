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
        $this->SetTextColor(0,0,0); 
        $this->Text(200, 15,iconv('UTF-8','cp874','วันที่  '.DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'สต๊อก    รวมทั้งหมด') , 0 , 1,'L' );
        $this->Ln(3);
            $this->Cell(15,10,iconv('UTF-8','cp874','ที่'),1,0,'C');
            $this->Cell(60,10,iconv('UTF-8','cp874','ชื่อสินค้า'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','หน่วย'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','วปป.'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','ดคต.'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','จุน'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','พาน'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','มจน'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','ลำปาง'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','ฮอด'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','รวมรถ'),1,0,'C');
            $this->Cell(25,10,iconv('UTF-8','cp874','รวมทั้งหมด'),1,0,'C');
            $this->Ln(10);
        
    }

    // Page footer
    function Footer()
    {
          
            $this->SetY(-20);
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }
  }

// Instanciation of inherited class
$pdf=new PDF('L','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(10,10,10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            
            $pdf->SetFont('angsana','',16);
           
          $list_product = "SELECT * FROM product";
          $query_product = mysqli_query($conn,$list_product);
          $query_product2 = mysqli_query($conn,$list_product);
          $a=1;
            while($product = $query_product ->fetch_assoc()){
              $pdf->Cell(15,8,iconv('UTF-8','cp874',$a),1,0,'C');
              $pdf->Cell(60,8,iconv('UTF-8','cp874',$product['name_product']),1,0,'C');
              $pdf->Cell(20,8,iconv('UTF-8','cp874',$product['unit']),1,0,'C');

              // -----------------------พื้นที่----------------------------------
              for ($i=1; $i < 8; $i++) { 
              $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = $i";
              $objq_num = mysqli_query($conn,$SQL_num);
              $objr_num = mysqli_fetch_array($objq_num);
              if(!isset($objr_num['num'])){
                $pdf->Cell(20,8,iconv('UTF-8','cp874',''),1,0,'C');
              }else{
                $pdf->Cell(20,8,iconv('UTF-8','cp874',$objr_num['num']),1,0,'C');
              }
            }
              // -----------------------//พื้นที่----------------------------------

              //-------------------------รวมรถ----------------------------------
              $SQL_num_car = "SELECT SUM(num) FROM numpd_car WHERE id_product = $product[id_product]";
              $objq_num_car = mysqli_query($conn,$SQL_num_car);
              $objr_num_car = mysqli_fetch_array($objq_num_car);
              $total_numcar = $objr_num_car['SUM(num)'];
              if(!isset($total_numcar)){
                $pdf->Cell(20,8,iconv('UTF-8','cp874',''),1,0,'C');
              }else{
                $pdf->Cell(20,8,iconv('UTF-8','cp874',$objr_num_car['SUM(num)']),1,0,'C');
              }
              //-------------------------//รวมรถ----------------------------------
           
              $SQL_num = "SELECT SUM(num) FROM num_product WHERE id_product = $product[id_product]";
              $objq_num = mysqli_query($conn,$SQL_num);
              $objr_num = mysqli_fetch_array($objq_num);

              $total_num = $objr_num['SUM(num)'];
              $total_numstore = $total_numcar+$total_num;
              if(!isset($total_num)){
                $pdf->Cell(25,8,iconv('UTF-8','cp874',''),1,0,'C');
              }else{
                $pdf->Cell(25,8,iconv('UTF-8','cp874',$total_numstore),1,0,'C');
              }
            // $pdf->Cell(20,8,iconv('UTF-8','cp874','รวมรถ'),1,0,'C');
            // $pdf->Cell(25,8,iconv('UTF-8','cp874','รวมทั้งหมด'),1,0,'C');
            $pdf->Ln(8);   
            $a++;
          }   
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>