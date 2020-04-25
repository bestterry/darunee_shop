<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');
require('../config_database/config.php'); 
require('date/datetime.php');


class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // Date
        $strDate = date('Y-m-d');
        // Arial bold 15
        $this->AddFont('cordia','','cordia.php');
        $this->SetFont('cordia','',20);
        
        //Date
        $this->SetTextColor(255,0,0); 
        $this->Text(95, 9,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ORDER วันนี้') , 0 , 1,'L' ); 
        $this->Ln(2);
    }
    // Page footer
    function Footer()
    {
          
            $this->SetY(-20);
            $this->SetFont('cordia','',14);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,iconv('UTF-8','cp874','หน้า ').($this->PageNo()),0,1,'C');
    }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(10, 5 ,3);
            $pdf->AddFont('cordia','','cordia.php');
            $pdf->SetFont('cordia','',16);
            //วนลูปหาอำเภอที่มีใน addorder
            $pdf->AddPage();
            $strDate = date('Y-m-d');
                $sql_addorder = "SELECT * FROM addorder 
                                  INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code 
                                  INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                  INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                                  WHERE addorder.status = 'pending' AND DATE_FORMAT(addorder.datetime,'%Y-%m-%d') = '$strDate' 
                                  ORDER BY id_addorder DESC";
                $objq_addorder = mysqli_query($conn,$sql_addorder);
               
                while($value = $objq_addorder->fetch_assoc ())
                { 
                  
                  $id_addorder = $value['id_addorder'];
                  $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'_______________________________________________________________________________________________________') , 0 , 1,'L' );
                  $pdf->Ln(4); 
                  
                  $x = $pdf->GetX();
                  $y = $pdf->GetY();
                  //รายการสินค้า
                  $total_money = 0;
                  $sql_listorder = "SELECT * FROM listorder
                                    INNER JOIN product ON listorder.id_product = product.id_product
                                    WHERE listorder.id_addorder = $id_addorder";
                  $objq_listorder = mysqli_query($conn,$sql_listorder);
                  while ($list = $objq_listorder ->fetch_assoc()) {
                    $money = $list['money'];
                    //$pdf->MultiCell( 100  , 7 , iconv( 'UTF-8','cp874' ,$list['name_product'].'_'.$list['unit'].'  '.$list['num'].'  '.$list['unit'].'  '.$list['money'].' '.'บ.'));
                    $pdf->Cell(20,7, iconv( 'UTF-8','cp874' ,$list['name_product'].'_'.$list['unit']),0,0,'R');
                    $pdf->SetTextColor(255,0,0); 
                    $pdf->Cell(15,7, iconv( 'UTF-8','cp874' ,$list['num']),0,0,'R');
                    $pdf->SetTextColor(0,0,0); 
                    $pdf->Cell(16,7, iconv( 'UTF-8','cp874' ,$list['price']),0,0,'R');
                    $pdf->Cell(20,7, iconv( 'UTF-8','cp874',$list['money']),0,0,'R');
                    $pdf->Ln(7);
                    $total_money = $total_money + $money;
                  }
                  $pdf->Cell(51,7, iconv( 'UTF-8','cp874' ,''),0,0,'L');
                  $pdf->Cell(20,7, iconv( 'UTF-8','cp874' ,'[ '. $total_money .' ]'),0,0,'R');
                  
                  $pdf->SetXY($x + 85, $y);
                
                  //ที่อยู่ลูกค้า 
                  $pdf->MultiCell( 140  , 7 , iconv( 'UTF-8','cp874' ,$value['id_addorder'].' '.$value['name_customer']. '
บ.'.$value['village']. '
ต.'.$value['district_name'].' อ.'.$value['amphur_name'].' จ.'.$value['province_name'].'
'.DateThai($value['datetime']).' '.$value['name_member']  .' '. DateTime($value['datetime']).' '.$value['tel']  .'
# '.$value['note'] ) );
                }  
              
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>