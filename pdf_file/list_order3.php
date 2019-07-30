<?php
require('fpdf.php');
require('../config_database/config.php'); 
  function DateThai($strDate)
      {
      $strYear = (date("Y",strtotime($strDate))+543)-2500;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMinute= date("i",strtotime($strDate));
      $strSeconds= date("s",strtotime($strDate));
      $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
      $strMonthThai=$strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strYear";
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
        $this->SetFont('angsana','',20);
        
        //Date
        $this->SetTextColor(255,0,0); 
        $this->Text(80, 9,iconv('UTF-8','cp874',''),1,0,'C');
        
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'') , 0 , 1,'L' ); 
        $this->Ln(2);
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
            $pdf->SetMargins(10, 5 ,3);
            $pdf->AddFont('angsana','','angsa.php');
            $pdf->SetFont('angsana','',20);
            //วนลูปหาอำเภอที่มีใน addorder
             
                $pdf->AddPage();
                $id_amphur = $_POST['amphur_name'];
                $sql_addorder = "SELECT * FROM addorder 
                                INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code 
                                INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                                WHERE addorder.status = 'pending' AND addorder.amphur_id = $id_amphur";
                $objq_addorder = mysqli_query($conn,$sql_addorder);
                while($value = $objq_addorder->fetch_assoc ())
                { 
                  $id_addorder = $value['id_addorder'];
                  $pdf->SetFont('angsana','',24);
                  $pdf->SetTextColor(255,0,0); 
                  $pdf->Text(15, 9,iconv('UTF-8','cp874','อ.'.$value['amphur_name']),1,0,'C');
                  $pdf->SetTextColor(0,0,0); 
                  $pdf->SetFont('angsana','',20);
                  $pdf->Text(140, 9,iconv('UTF-8','cp874','จ.'.$value['province_name']),1,0,'C');
                  $pdf->SetTextColor(255,0,0); 
                  $pdf->Text(165, 9,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
                  $pdf->SetTextColor(0,0,0); 
                  $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'_______________________________________________________________________________________________') , 0 , 1,'L' );
                  $pdf->Ln(4); 
                  
                  $x = $pdf->GetX();
                  $y = $pdf->GetY();
                  //รายการสินค้า
                  $sql_listorder = "SELECT * FROM listorder
                                    INNER JOIN product ON listorder.id_product = product.id_product
                                    WHERE listorder.id_addorder = $id_addorder";
                  $objq_listorder = mysqli_query($conn,$sql_listorder);
                  while ($list = $objq_listorder ->fetch_assoc()) {
                    $pdf->MultiCell( 65  , 7 , iconv( 'UTF-8','cp874' ,$list['name_product'].'    '.$list['num'].'   '.$list['unit']) );
                  }
                  
                  $pdf->SetXY($x + 65, $y);
                
                  //ที่อยู่ลูกค้า 
                  $pdf->MultiCell( 140  , 7 , iconv( 'UTF-8','cp874' ,'สั่ง  '.DateThai($value['datetime']).'   '.$value['name_member'].'
'.$value['id_addorder'].'  '.$value['name_customer'].'   '.$value['tel']  .'  
บ.'.$value['village'].'   ต.'.$value['district_name'].'อ.'.$value['amphur_name'].'จ.'.$value['province_name'].'
# '.$value['note'].'
'   .'  '  ) );
                }  
                   
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>