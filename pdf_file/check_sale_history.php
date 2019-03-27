<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
$aday = $_GET['aday'];
$bday = $_GET['bday'];
  function DateThai($strDate)
      {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth = date("n",strtotime($strDate));
      $strDay = date("j",strtotime($strDate));
      $strHour = date("H",strtotime($strDate));
      $strMinute = date("i",strtotime($strDate));
      $strSeconds = date("s",strtotime($strDate));
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai = $strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strYear";
      }

      $strDate = date('d-m-Y');

class PDF extends FPDF
  {
  
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(15,15,15);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Ln(5);
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขายสินค้าวันที่ '.DateThai($aday).' ถึง '.DateThai($bday)) , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(70,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวนเงิน(บาท)'),1,0,'C');
            $pdf->Ln(10);
            
            $total_money = 0;
            $total_all_money = 0;
            $date = "SELECT * FROM product ";
            $objq = mysqli_query($conn,$date);
            while($value = $objq ->fetch_assoc()){ 
              $id_product = $value['id_product'];
              $sql_num = "SELECT SUM(num),SUM(money) FROM price_history WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') AND id_product = $id_product";
              $objq_num = mysqli_query($conn,$sql_num);
              $objr_num = mysqli_fetch_array($objq_num);
              $num = $objr_num['SUM(num)'];
              $num_money = $objr_num['SUM(money)'];

              $sql_num_car = "SELECT SUM(num),SUM(money) FROM sale_car_history WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') AND id_product = $id_product";
              $objq_num_car = mysqli_query($conn,$sql_num_car);
              $objr_num_car = mysqli_fetch_array($objq_num_car);
              $num_car = $objr_num_car['SUM(num)'];
              $num_money_car = $objr_num_car['SUM(money)'];

              $total_num = $num + $num_car;
              $total_money = $num_money + $num_money_car;
              if($total_num==0) {

              }else{ 
            
            $pdf->Cell(70,8,iconv('UTF-8','cp874',$value['name_product']),1,0,'');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_num.' '.' '.$value['unit']),1,0,'');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
            $pdf->Ln(8);
                      }
                      $total_all_money = $total_all_money + $total_money;
                    }
            $pdf->Cell(70,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874','รวมเป็นเงิน'),1,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_all_money),1,0,'C');  
// --------------------------------------------------------------------------------------
    $pdf->Output();
?>