<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
$aday = $_POST['aday'];
$bday = $_POST['bday'];

  function DateThai($strDate)
      {
        $strYear = date("Y",strtotime($strDate))-1957;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate)); 
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
      

class PDF extends FPDF
  {
   
  // Page header
    function Header()
    {
        // Date
        global $headerVisible;
          if($headerVisible=="true")
          {
            $aday = $_POST['aday'];
            $bday = $_POST['bday'];
            // Arial bold 15
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',20);
            //Date
            $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขาย'.'   '.Datethai($aday).' - '.Datethai($bday)) , 0 , 1,'C' );
            $this->Ln(12);
            $this->SetFont('angsana','',16);
            $this->SetXY(15,25);
            $this->Cell(30,14,iconv("UTF-8","TIS-620","วันที่"),1,0,'C');
            $this->Cell(50,14,iconv("UTF-8","TIS-620","ชื่อ - สกุล"),1,0,'C');
            $this->Cell(45,14,iconv("UTF-8","TIS-620","พื้นที่"),1,0,'C');
            $this->Cell(40,7,iconv("UTF-8","TIS-620","ปุ๋ยเคมีกวางฯ"),1,0,'C');
            $this->Cell(40,7,iconv("UTF-8","TIS-620","สารปรับปรุงดินโซเล่"),1,0,'C');
            $this->Cell(40,7,iconv("UTF-8","TIS-620","ปุ๋ยอินทรีย์กวางฯ"),1,0,'C');
            $this->Cell(25,14,iconv("UTF-8","TIS-620","รวมเงิน"),1,0,'C');
            $this->Ln(17);
      
            $this->SetXY(140,32);
            $this->Cell(15,7,iconv("UTF-8","TIS-620","กส."),1,0,'C');
            $this->Cell(25,7,iconv("UTF-8","TIS-620","บาท"),1,0,'C');
            $this->Cell(15,7,iconv("UTF-8","TIS-620","กส."),1,0,'C');
            $this->Cell(25,7,iconv("UTF-8","TIS-620","บาท"),1,0,'C');
            $this->Cell(15,7,iconv("UTF-8","TIS-620","กส."),1,0,'C');
            $this->Cell(25,7,iconv("UTF-8","TIS-620","บาท"),1,0,'C');
            $this->Ln(7);
          }

    }

    // Page footer
    function Footer()
    {
          
        $this->SetY(-15);
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',14);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }

  }

// Instanciation of inherited class
  $pdf=new PDF('L','mm','A4');
      
      // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
      // $pdf->AliasNbPages();
      $pdf->SetMargins(15,15,15);
      $headerVisible="true";
      $pdf->AddPage();
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('angsana','',16);

      $total_money = 0;
      $total_num1 = 0;
      $total_num2 = 0;
      $total_num3 = 0;
      $money1 = 0;
      $money2 = 0;
      $money3 = 0;
      $sql_acc = "SELECT * FROM acc_market
      INNER JOIN tbl_districts ON acc_market.district_id = tbl_districts.district_code
      INNER JOIN tbl_amphures ON acc_market.amphur_id = tbl_amphures.amphur_id
      INNER JOIN tbl_provinces ON acc_market.province_id = tbl_provinces.province_id
      WHERE (acc_market.date_acc between '$aday 00:00:00' and '$bday 23:59:59') ORDER BY acc_market.id_acc_market ASC";
      $objq_acc = mysqli_query($conn,$sql_acc);
      while($value = $objq_acc->fetch_assoc()){
        $id_acc_market = $value['id_acc_market'];
        $pdf->Cell(30,10,iconv('UTF-8','cp874',Datethai($value['date_acc'])),1,0,'C');
        $pdf->Cell(50,10,iconv('UTF-8','cp874',$value['name_customer']),1,0,'C');
        $pdf->Cell(45,10,iconv('UTF-8','cp874','อ.'.$value['amphur_name'].' จ.'.$value['province_name']),1,0,'C');
          
        $sql_pd1 = "SELECT * FROM acc_market_list WHERE id_acc_market = $id_acc_market AND id_product = 15";
        $objq_pd1 = mysqli_query($conn,$sql_pd1);
        $objr_pd1 = mysqli_fetch_array($objq_pd1);
          if(isset($objr_pd1['num_product'])){
            $pdf->Cell(15,10,iconv('UTF-8','cp874',$objr_pd1['num_product']),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874',$objr_pd1['acc_money']),1,0,'C');
          }else {
            $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
          }


        $sql_pd2 = "SELECT * FROM acc_market_list WHERE id_acc_market = $id_acc_market AND id_product = 11";
        $objq_pd2 = mysqli_query($conn,$sql_pd2);
        $objr_pd2 = mysqli_fetch_array($objq_pd2);
          if(isset($objr_pd2['num_product'])){
            $pdf->Cell(15,10,iconv('UTF-8','cp874',$objr_pd2['num_product']),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874',$objr_pd2['acc_money']),1,0,'C');
          }else {
            $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
          }

        $sql_pd3 = "SELECT * FROM acc_market_list WHERE id_acc_market = $id_acc_market AND id_product = 34";
        $objq_pd3 = mysqli_query($conn,$sql_pd3);
        $objr_pd3 = mysqli_fetch_array($objq_pd3);
          if(isset($objr_pd3['num_product'])){
            $pdf->Cell(15,10,iconv('UTF-8','cp874',$objr_pd3['num_product']),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874',$objr_pd3['acc_money']),1,0,'C');
          }else {
            $pdf->Cell(15,10,iconv('UTF-8','cp874',''),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874',''),1,0,'C');
          }
          $total_money = $total_money + $objr_pd1['acc_money'] + $objr_pd2['acc_money'] + $objr_pd3['acc_money'];
          $pdf->Cell(25,10,iconv('UTF-8','cp874',$total_money),1,0,'C');
          
          $total_num1 = $total_num1 + $objr_pd1['num_product'];
          $total_num2 = $total_num2 + $objr_pd2['num_product'];
          $total_num3 = $total_num3 + $objr_pd3['num_product'];
          $money1 = $money1 + $objr_pd1['acc_money'];
          $money2 = $money2 + $objr_pd2['acc_money'];
          $money3 = $money3 + $objr_pd3['acc_money'];
        $pdf->Ln(10);
      }
      $pdf->Cell(30,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(50,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(45,10,iconv('UTF-8','cp874','รวมทั้งสิ้น'),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',$total_num1),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',$money1),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',$total_num2),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',$money2),1,0,'C');
      $pdf->Cell(15,10,iconv('UTF-8','cp874',$total_num3),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',$money3),1,0,'C');
      $pdf->Cell(25,10,iconv('UTF-8','cp874',$total_money ),1,0,'C');

// รวมยอด สกต
      $headerVisible="false";
      $pdf->AddPage('P','A4');
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('angsana','',20);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ทีมงานคุณดารุณี') , 0 , 1,'C' );
      $pdf->Ln(5);
      $pdf->SetFont('angsana','',16);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'เลขที่ 379/5 หมู่ที่ 1 ต.แม่เจดีย์ อ.เวียงป่าเป้า จ.เชียงราย โทร. 081-916-9852') , 0 , 1,'C' );
      $pdf->Ln(3);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'รวม ยอดสินค้าส่ง สกต.') , 0 , 1,'C' );
      $pdf->Ln(5);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','สินค้า'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน(กส.)'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','บาท/กส.'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','เป็นเงิน'),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','ปุ๋ยเคมีกวางฯ'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$total_num1),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',790),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$money1),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','สารปรับปรุงดินโซเล่'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$total_num2),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',350),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$money2),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(70,10,iconv('UTF-8','cp874','ปุ๋ยอินทรีย์กวางฯ'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$total_num3),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',620),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$money3),1,0,'C');
      $pdf->Ln(10);
      $pdf->Cell(110,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','รวมเงิน'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874',$total_money),1,0,'C');
      
      
      $pdf->Output();
?>