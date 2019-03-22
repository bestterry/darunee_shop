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
        $this->Text(75, 19,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'รายการขายหน้าร้าน ประจำวันที่ ') , 0 , 1,'L' );
        if($this->PageNo()>1){
            $this->Ln(2);
            $this->Cell(60,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $this->Cell(24,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $this->Cell(20,10,iconv('UTF-8','cp874','บ/หน่วย'),1,0,'C');
            $this->Cell(24,10,iconv('UTF-8','cp874','เงินขาย'),1,0,'C');
            $this->Cell(40,10,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
            $this->Ln(10);
        }
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
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดขายสินค้า ') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(70,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวนเงิน(บาท)'),1,0,'C');
            $pdf->Ln(10);
                
            $sum_monny = 0;
            $sql_history = "SELECT * FROM product";
            $objq_history = mysqli_query($conn,$sql_history);
            while($history = $objq_history ->fetch_assoc()){
              $id_product = $history['id_product'];
              $total_sale = "SELECT SUM(price_history.num),SUM(price_history.money) FROM price_history 
                              INNER JOIN product ON price_history.id_product=product.id_product
                              WHERE product.id_product = '$id_product' AND DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate' AND price_history.id_zone='$id_zone' AND price_history.status='sale'";
              $objq_sale = mysqli_query($conn,$total_sale);
              $objr_sale = mysqli_fetch_array($objq_sale);
              $num_product = $objr_sale['SUM(price_history.num)'];
              $total_money = $objr_sale['SUM(price_history.money)'];
              $sql_NameProduct = "SELECT * FROM product WHERE id_product = '$id_product'";
              $objq_NameProduct = mysqli_query($conn,$sql_NameProduct);
              $objr_NameProduct = mysqli_fetch_array($objq_NameProduct);
              if(isset($num_product)){ 
            
            $pdf->Cell(70,8,iconv('UTF-8','cp874',$objr_NameProduct['name_product']),1,0,'');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$num_product.' '.' '.$objr_NameProduct['unit']),1,0,'');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
            $pdf->Ln(8);
                      }
                      $sum_monny = $sum_monny+$total_money;
                    }
            $pdf->Cell(70,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874','รวมเป็นเงินทั้งหมด'),1,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$sum_monny),1,0,'C');  
// --------------------------------------------------------------------------------------

// free----------------------------------------------------------------------------------    
$pdf->Ln(25);
$pdf->SetFont('angsana','',18);
$pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดรวมแถมสินค้า ') , 0 , 1,'' );
$pdf->Ln(3);
$pdf->SetFont('angsana','',16);
$pdf->Cell(110,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
$pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
$pdf->Ln(10);

$sql_history = "SELECT * FROM product";
                            $objq_history = mysqli_query($conn,$sql_history);
                            while($history = $objq_history ->fetch_assoc()){
                              $id_product = $history['id_product'];
                              $total_sale = "SELECT SUM(price_history.num),SUM(price_history.money),product.name_product,product.unit FROM price_history 
                                              INNER JOIN product ON price_history.id_product=product.id_product
                                              WHERE product.id_product = '$id_product' AND DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate' AND price_history.id_zone='$id_zone' AND price_history.status = 'free'";
                              $objq_sale = mysqli_query($conn,$total_sale);
                              $objr_sale = mysqli_fetch_array($objq_sale);
                              $num_product = $objr_sale['SUM(price_history.num)'];
															$total_money = $objr_sale['SUM(price_history.money)'];
															$name_product = $objr_sale['name_product'];
															$unit = $objr_sale['unit'];
                              if(isset($num_product)){ 

$pdf->Cell(110,8,iconv('UTF-8','cp874',$name_product),1,0,'');
$pdf->Cell(40,8,iconv('UTF-8','cp874',$num_product.' '.$unit),1,0,'');
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
            
            $date = "SELECT * FROM price_history
                     WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_zone = '$id_zone' AND price_history.status='sale'";
					$objq = mysqli_query($conn,$date);
					 while($value = $objq ->fetch_assoc()){
                    $id_sale = $value['id_price_history'];
                    $SQL_product = "SELECT * FROM product INNER JOIN price_history 
                    ON product.id_product = price_history.id_product 
                    WHERE price_history .id_price_history='$id_sale'";
                    $objq_product = mysqli_query($conn,$SQL_product);
                    $objr_product = mysqli_fetch_array($objq_product);
                $objq_product = mysqli_query($conn,$SQL_product);
                $objr_product = mysqli_fetch_array($objq_product);
            $pdf->Cell(60,8,iconv('UTF-8','cp874',$objr_product['name_product']),1,0,'L');
            $pdf->Cell(24,8,iconv('UTF-8','cp874',$objr_product['num'].' '.' '.$objr_product['unit']),1,0,'L');
            $pdf->Cell(20,8,iconv('UTF-8','cp874',$objr_product['price']),1,0,'C');
            $pdf->Cell(24,8,iconv('UTF-8','cp874',$objr_product['money']),1,0,'C');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$objr_product['note']),1,0,'C');
            $pdf->Ln(8);
            }                
    $pdf->Output();
?>