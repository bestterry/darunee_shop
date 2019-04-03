<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
$day = $_GET['day'];
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
        $day1 = $_GET['day'];
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        
        //Date
        $this->SetTextColor(255,0,0); 
        $this->Text(70, 19,iconv('UTF-8','cp874',DateThai($day1)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'รายการขายทั้งหมด ประจำวันที่ ') , 0 , 1,'L' ); 
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
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(20, 15,15);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร

            // ยอดขายรวม.
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขายรวม') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(90,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','เงินขาย(บาท)'),1,0,'C');
            
            $pdf->Ln(10);$total_money = 0;
            $total_all_money = 0;
            $date = "SELECT * FROM product ";
            $objq = mysqli_query($conn,$date);
            while($value = $objq ->fetch_assoc()){ 
              $id_product = $value['id_product'];
              $sql_num = "SELECT SUM(num),SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day' AND id_product = $id_product AND status = 'sale'";
              $objq_num = mysqli_query($conn,$sql_num);
              $objr_num = mysqli_fetch_array($objq_num);
              $num = $objr_num['SUM(num)'];
              $num_money = $objr_num['SUM(money)'];

              $sql_num_car = "SELECT SUM(num),SUM(money) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day' AND id_product = $id_product AND status = 'sale'";
              $objq_num_car = mysqli_query($conn,$sql_num_car);
              $objr_num_car = mysqli_fetch_array($objq_num_car);
              $num_car = $objr_num_car['SUM(num)'];
              $num_money_car = $objr_num_car['SUM(money)'];

              $total_num = $num + $num_car;
              $total_money = $num_money + $num_money_car;

              if($total_num==0) {

              }else{
            $pdf->Cell(90,8,iconv('UTF-8','cp874',$value['name_product']),1,0,'');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_num.' '.$value['unit']),1,0,'');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
            $pdf->Ln(8);
            $total_all_money = $total_all_money + $total_money;
              }
            }     
            $pdf->Cell(90,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874','รวมเป็นเงินทั้งหมด'),1,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_all_money),1,0,'C');
            $pdf->Ln(10);
             // ยอดขายรวม.

            // หน้าร้าน วปป.
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ร้านเวียงป่าเป้า ') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(60,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(20,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(20,10,iconv('UTF-8','cp874','บ/หน่วย'),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874','เงินขาย(บาท)'),1,0,'C');
            $pdf->Cell(50,10,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
            $pdf->Ln(10);
            $total_money = 0;
              $date = "SELECT * FROM product INNER JOIN price_history 
                        ON product.id_product = price_history.id_product 
                        WHERE DATE_FORMAT(price_history.datetime,'%Y-%m-%d')='$day'";
              $objq = mysqli_query($conn,$date);
              while($value = $objq ->fetch_assoc()){ 
            $pdf->Cell(60,8,iconv('UTF-8','cp874',$value['name_product']),1,0,'');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['num'].' '.$value['unit']),1,0,'');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['price']),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['money']),1,0,'C');
            $pdf->Cell(50,8,iconv('UTF-8','cp874',$value['note']),1,0,'C');
            $pdf->Ln(8);
            $total_money = $total_money + $value['money'];
            }       
            $pdf->Cell(60,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874','รวมเป็นเงินทั้งหมด'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
            $pdf->Ln(10);
             // หน้าร้าน วปป.

             // รถ.
          for ($i=4; $i < 15; $i++){
            $sql_member = "SELECT * FROM member WHERE id_member = $i";
            $objq_member = mysqli_query($conn,$sql_member);
            $objr_member = mysqli_fetch_array($objq_member);

            $check = "SELECT * FROM product INNER JOIN sale_car_history
                            ON product.id_product = sale_car_history.id_product 
                            WHERE sale_car_history.id_member = $i AND DATE_FORMAT(sale_car_history.datetime,'%Y-%m-%d')='$day'";
            $objq_check = mysqli_query($conn,$check);
            $objr_check = mysqli_fetch_array($objq_check);
            if(!isset($objr_check['num'])){

            }else{
              $pdf->AddPage();
              $pdf->SetFont('angsana','',18);
              $pdf->Ln(5);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874',$objr_member['name']) , 0 , 1,'' );
              $pdf->Ln(2);
              $pdf->SetFont('angsana','',16);
              $pdf->Cell(60,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
              $pdf->Cell(20,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
              $pdf->Cell(20,10,iconv('UTF-8','cp874','บ/หน่วย'),1,0,'C');
              $pdf->Cell(25,10,iconv('UTF-8','cp874','เงินขาย(บาท)'),1,0,'C');
              $pdf->Cell(50,10,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
              $pdf->Ln(10);
              $total_money = 0;
              $SQL_product = "SELECT * FROM product INNER JOIN sale_car_history
                              ON product.id_product = sale_car_history.id_product 
                              WHERE sale_car_history.id_member = $i AND DATE_FORMAT(sale_car_history.datetime,'%Y-%m-%d')='$day'";
              $objq_product = mysqli_query($conn,$SQL_product);
                  while($product = $objq_product -> fetch_assoc()){
              $pdf->Cell(60,8,iconv('UTF-8','cp874',$product['name_product']),1,0,'');
              $pdf->Cell(20,8,iconv('UTF-8','cp874',$product['num'].' '.$product['unit']),1,0,'');
              $pdf->Cell(20,8,iconv('UTF-8','cp874',$product['price']),1,0,'C');
              $pdf->Cell(25,8,iconv('UTF-8','cp874',$product['money']),1,0,'C');
              $pdf->Cell(50,8,iconv('UTF-8','cp874',$product['note']),1,0,'C');
              $pdf->Ln(8);
              $total_money = $total_money + $product['money'];
                }
                $pdf->Cell(60,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874','รวมเป็นเงินทั้งหมด'),1,0,'C');
            $pdf->Cell(25,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
            $pdf->Ln(10);
              }
          } 
          // รถ.      
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>