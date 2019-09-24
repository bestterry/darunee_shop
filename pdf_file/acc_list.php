<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
  

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
    // function Header()
    // {
    //     // Date
    //     $strDate = date('d-m-Y');
    //     // Arial bold 15
    //     $this->AddFont('angsana','','angsa.php');
    //     $this->SetFont('angsana','',16);
    //     //Date
    //     $this->SetTextColor(0,0,0); 
    //     $this->Text(200, 10,iconv('UTF-8','cp874','วันที่  '.DateThai($strDate)),1,0,'C');
    //     // Title
    //     $this->SetTextColor(0,0,0);
    //     $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'เงินขาย สกต.') , 0 , 1,'L' );
    //     $this->Ln(3);
    //         $this->Cell(30,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
    //         $this->Cell(70,8,iconv('UTF-8','cp874','ชื่อลูกค้า'),1,0,'C');
    //         $this->Cell(30,8,iconv('UTF-8','cp874','สินค้า'),1,0,'C');
    //         $this->Cell(30,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
    //         $this->Cell(30,8,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
    //         $this->Cell(30,8,iconv('UTF-8','cp874','เงิน สกต.'),1,0,'C');
    //         $this->Cell(30,8,iconv('UTF-8','cp874','คืน.เพิ่ม'),1,0,'C');
    //         $this->Cell(30,8,iconv('UTF-8','cp874','เงินสะสม'),1,0,'C');
    //         $this->Ln();
    // }

    // Page footer
    function Footer()
    {
          
            $this->SetY(-20);
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }

    public function head(){
      $strDate = date('d-m-Y');
      // Arial bold 15
      $this->AddFont('angsana','','angsa.php');
      $this->SetFont('angsana','',16);
      //Date
      $this->SetTextColor(0,0,0); 
      $this->Text(200, 10,iconv('UTF-8','cp874','วันที่  '.DateThai($strDate)),1,0,'C');
      // Title
      $this->SetTextColor(0,0,0);
      $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'เงินขาย สกต.') , 0 , 1,'L' );
      $this->Ln(3);
      $this->Cell(30,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
      $this->Cell(70,8,iconv('UTF-8','cp874','ชื่อลูกค้า'),1,0,'C');
      $this->Cell(30,8,iconv('UTF-8','cp874','สินค้า'),1,0,'C');
      $this->Cell(30,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
      $this->Cell(30,8,iconv('UTF-8','cp874','ราคา/หน่วย'),1,0,'C');
      $this->Cell(30,8,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
      $this->Cell(30,8,iconv('UTF-8','cp874','เงิน สกต.'),1,0,'C');
      $this->Cell(30,8,iconv('UTF-8','cp874','เงินสะสม'),1,0,'C');
      $this->Ln();
    }


  }

// Instanciation of inherited class
  $pdf=new PDF('L','mm','A4');
      
      // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
      // $pdf->AliasNbPages();
      $pdf->SetMargins(5,5,5);
      $pdf->AddFont('angsana','','angsa.php');
      //สร้างหน้าเอกสาร
       
      $pdf->AddPage();
      $pdf->SetFont('angsana','',16);     
      $last_money = 0; 
      $pdf->head();
      $aday = $_POST['aday'];
      $bday = $_POST['bday'];
      $sql_acc = "SELECT * FROM acc_market
      INNER JOIN tbl_districts ON acc_market.district_id = tbl_districts.district_code
      INNER JOIN tbl_amphures ON acc_market.amphur_id = tbl_amphures.amphur_id
      INNER JOIN tbl_provinces ON acc_market.province_id = tbl_provinces.province_id
      WHERE (acc_market.date_acc between '$aday 00:00:00' and '$bday 23:59:59') ORDER BY acc_market.id_acc_market DESC";
      $objq_acc = mysqli_query($conn,$sql_acc);
      while($value = $objq_acc->fetch_assoc()){
        $x = $pdf->GetX();
        $y = $pdf->GetY();
            $id_acc_market = $value['id_acc_market'];
            
            $pdf->MultiCell(30, 6,iconv('UTF-8','cp874',Datethai($value['date_acc']))."\n"."\n"."\n"."\n", 1, 1);
            $pdf->SetXY($x + 30, $y);
            
            $pdf->MultiCell(70, 6,iconv('UTF-8','cp874',$value['name_customer']."\n".$value['village']."  ต.".$value['district_name']."อ.".$value['amphur_name']."จ.".$value['province_name']."   โทร ".$value['tel']."\n"."\n"), 1, 1);
            $pdf->SetXY($x + 100, $y);
            $sql_list = "SELECT * FROM acc_market_list INNER JOIN product ON acc_market_list.id_product = product.id_product WHERE acc_market_list.id_acc_market = $id_acc_market";
            $objq_list = mysqli_query($conn,$sql_list);
            
              $name_product = array();
              $num_product = array();
              $price = array();
              $total_money = array();
              $setment = array();
              $i = 0;
              $total_money1 = 0;
              $total_money2 = 0;
              $total_money3 = 0;
              $total_money4 = 0;
              $total_money5 = 0;

              $total_num = 0;
              while($value = $objq_list->fetch_assoc()){
                
                $name_product[$i] = $value['name_product'];
                $num_product[$i] = $value['num_product'];
                $total_money[$i] = $value['total_money'];
                $acc_money[$i] = $value['acc_money'];
                $set_ment[$i] = $value['setment'];
                $price[$i] = $value['price'];
                $i++;

                $total_num = $total_num + $value['num_product'];
                $total_money1 = $total_money1 + $value['total_money'];
                $total_money2 = $total_money2 + $value['acc_money'];
                $total_money3 = $total_money3 + $value['setment'];
                 
              }
              // name_product
              if (isset($name_product[0])) {
                $a = "$name_product[0]";
                $num = "$num_product[0]";
                $set = "$set_ment[0]";
                $t_money = "$total_money[0]";
                $a_money = "$acc_money[0]";
                $a_price = "$price[0]";
              }else {
                $a = '';
                $num = '';
                $set = '';
                $t_money = '';
                $a_money = '';
                $a_price = '';
              }

             if (isset($name_product[1])) {
                $b = "$name_product[1]";
                $num1 = "$num_product[1]";
                $t_money1 = "$total_money[1]";
                $a_money1 = "$acc_money[1]";
                $set1 = "$set_ment[1]";
                $a_price1 = "$price[1]";
              }else {
                $b = '';
                $num1 = '';
                $set1 = '';
                $t_money1 = '';
                $a_money1 = '';
                $a_price1 = '';
              }
        
             if (isset($name_product[2])) {
                $c = "$name_product[2]";
                $num2 = "$num_product[2]";
                $set2 = "$set_ment[2]";
                $t_money2 = "$total_money[2]";
                $a_money2 = "$acc_money[2]";
                $a_price2 = "$price[2]";
              }else {
                $c = "";
                $num2 = "";
                $set2 = "";
                $t_money2 = "";
                $a_money2 = "";
                $a_price2 = "";
              }

              if (isset($name_product[3])) {
                $d = "$name_product[3]";
                $num3 = "$num_product[3]";
                $set3 = "$set_ment[3]";
                $t_money3 = "$total_money[3]";
                $a_money3 = "$acc_money[3]";
                $a_price3 = "$price[3]";
              }else {
                $d = "";
                $num3 = "";
                $set3 = "";
                $t_money3 = "";
                $a_money3 = "";
                $a_price3 = "";
              }


              //-name product
            
            $namePD="$a\n"."$b\n"."$c\n"."$d\n";
            $pdf->MultiCell(30, 6,iconv('UTF-8','cp874',$namePD), 1);
            $pdf->SetXY($x + 130, $y);
            
            $numPD="$num\n"."$num1\n"."$num2\n"."$num3\n";
            $pdf->MultiCell(30, 6,iconv('UTF-8','cp874',$numPD), 1);
            $pdf->SetXY($x + 160, $y);

            $set_price="$a_price\n"."$a_price1\n"."$a_price2\n"."$a_price3\n";
            $pdf->MultiCell(30, 6, iconv('UTF-8','cp874',$set_price), 1);
            $pdf->SetXY($x + 190, $y);
            
            $tt_money="$t_money\n"."$t_money1\n"."$t_money2\n"."$t_money3\n";
            $pdf->MultiCell(30, 6,iconv('UTF-8','cp874',$tt_money), 1);
            $pdf->SetXY($x + 220, $y);
            
            $aa_money="$a_money\n"."$a_money1\n"."$a_money2\n"."$a_money3\n";
            $pdf->MultiCell(30, 6,iconv('UTF-8','cp874',$aa_money), 1);
            $pdf->SetXY($x + 250, $y);

            $last_money = $last_money + $total_money2;
            $money2=$last_money."\n"."\n"."\n"."\n";
            $pdf->MultiCell(30, 6, $money2, 1);
            if($pdf->GetY() > 165 ){
              $pdf->SetAutoPageBreak(false);
              $pdf->AddPage();
              $pdf->$y = 0;
            }
      }  
      
      $pdf->AddPage();
      $pdf->SetFont('angsana','',20);
      $pdf->SetTextColor(0,0,0);
      $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'ร้านทีมงานคุณดารุณี') , 0 , 1,'C' );
      $pdf->Ln(3);
      $pdf->SetFont('angsana','',16);
      $pdf->Cell(45,10,iconv('UTF-8','cp874',''),0,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
      $pdf->Cell(80,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','หน่วยล่ะ'),1,0,'C');
      $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวนเงิน'),1,0,'C');
      $pdf->Ln(10);
      $sql_pd_acc = "SELECT * FROM product";
      $objq_pd_acc = mysqli_query($conn,$sql_pd_acc);
      while($value = $objq_pd_acc->fetch_assoc()){
        
      }
      
      $pdf->Output();
?>