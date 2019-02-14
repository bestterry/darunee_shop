<?php
require('fpdf.php');
require('../config_database/config.php'); 

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
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'รายการนำเข้าสินค้า ประจำวันที่ ') , 0 , 1,'L' );
        
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
            $pdf->Cell(0,5, iconv( 'UTF-8','cp874' , 'ยอดนำเข้าสินค้า ') , 0 , 1,'' );
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(90,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(60,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Ln(10);
                
                $sum_monny = 0;
                $sql_history = "SELECT * FROM product";
                $objq_history = mysqli_query($conn,$sql_history);
                while($history = $objq_history ->fetch_assoc()){
                      $id_product = $history['id_product'];
                      $total_sale = "SELECT SUM(sale_history.num_sale) FROM sale_history 
                                      INNER JOIN product ON sale_history.id_product=product.id_product
                                      WHERE product.id_product = '$id_product' AND DATE_FORMAT(sale_history.datetime,'%d-%m-%Y')='$strDate' AND sale_history.status_sale='add'";
                      $objq_sale = mysqli_query($conn,$total_sale);
                      $objr_sale = mysqli_fetch_array($objq_sale);
                      $num_product = $objr_sale['SUM(sale_history.num_sale)'];
                      $sql_NameProduct = "SELECT * FROM product WHERE id_product = '$id_product'";
                      $objq_NameProduct = mysqli_query($conn,$sql_NameProduct);
                      $objr_NameProduct = mysqli_fetch_array($objq_NameProduct);
                      if(isset($num_product)){ 
            
            $pdf->Cell(90,8,iconv('UTF-8','cp874',$objr_NameProduct['name_product']),1,0,'');
            $pdf->Cell(60,8,iconv('UTF-8','cp874',$num_product.' '.'('.$objr_NameProduct['unit'].')'),1,0,'');
            
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
            $pdf->Cell(90,10,iconv('UTF-8','cp874','รายการ'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
            $pdf->Cell(40,10,iconv('UTF-8','cp874','ชื่อผู้ส่ง'),1,0,'C');
            $pdf->Ln(10);
            $date = "SELECT * FROM sale_history
                    WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND status_sale='add'";
            $objq = mysqli_query($conn,$date);
            while($data = $objq ->fetch_assoc()){
                $id_sale = $data['id_sale_history'];
                $SQL_product = "SELECT * FROM product INNER JOIN sale_history 
                ON product.id_product = sale_history.id_product 
                WHERE sale_history.id_sale_history='$id_sale'";
                $objq_product = mysqli_query($conn,$SQL_product);
                $objr_product = mysqli_fetch_array($objq_product);
            $pdf->Cell(90,8,iconv('UTF-8','cp874',$objr_product['name_product']),1,0,'L');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$objr_product['num_sale'].' '.'('.$objr_product['unit'].')'),1,0,'L');
            $pdf->Cell(40,8,iconv('UTF-8','cp874',$objr_product['name_draw']),1,0,'C');
            $pdf->Ln(8);
            }                
    $pdf->Output();
?>