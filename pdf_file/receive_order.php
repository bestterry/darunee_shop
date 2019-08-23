<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');

function DateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543-2500;
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
        // angsana
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        $this->SetTextColor(0,0,0);

        $this->Cell(0,8, iconv( 'UTF-8','cp874' , 'ตารางบันทึกข้อมูลการสั่งซื้อสินค้า') , 0 , 1,'L' );
        $this->Cell(15,8,iconv('UTF-8','cp874','ID'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','ใบสั่งที่'),1,0,'C');
        $this->Cell(35,8,iconv('UTF-8','cp874','สินค้า'),1,0,'C');
        $this->Cell(15,8,iconv('UTF-8','cp874','จำนวน'),1,0,'C');
        $this->Cell(15,8,iconv('UTF-8','cp874','ราคา'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','เงินซื้อ'),1,0,'C');
        $this->Cell(15,8,iconv('UTF-8','cp874','ใบจ่ายที่'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','ประเภทรถ'),1,0,'C');
        $this->Cell(15,8,iconv('UTF-8','cp874','ค่าขนส่ง'),1,0,'C');
        $this->Cell(23,8,iconv('UTF-8','cp874','วันที่สั่ง'),1,0,'C');
        $this->Cell(23,8,iconv('UTF-8','cp874','รถเข้า รง.'),1,0,'C');
        $this->Cell(23,8,iconv('UTF-8','cp874','รถมาถึง'),1,0,'C');
        $this->Cell(40,8,iconv('UTF-8','cp874','สั่งลง'),1,0,'C');
        $this->Ln(8);  
    }
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
            // ตั้งค่าขอบกระดาษทุกด้าน 15 มิลลิเมตร
            $pdf->SetMargins(8, 10, 10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            // กำหนดฟ้อนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 14
            $pdf->SetFont('angsana','',16);
            $pdf->SetTextColor(0,0,0);

          $order_list =" SELECT * FROM order_list
                         INNER JOIN product ON order_list.id_product = product.id_product
                         INNER JOIN tbl2_amphures ON order_list.amphur_id = tbl2_amphures.amphur_id
                         INNER JOIN tbl2_provinces ON order_list.province_id = tbl2_provinces.province_id
                         ORDER BY order_list.id_order_list DESC";
          $objq_addorder = mysqli_query($conn,$order_list);
            while($value = $objq_addorder->fetch_assoc())
            {
            $slip_number = $value['slip_number'];
            $num_product = $value['num_product'];
            $price = $value['price'];
            $total_money = $num_product * $price;
              $pdf->Cell(15,8,iconv('UTF-8','cp874',$value['id_order_list']),1,0,'C');
              $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['list_order']),1,0,'C');
              $pdf->Cell(35,8,iconv('UTF-8','cp874',$value['name_product'].'_'.$value['unit']),1,0,'C');
              $pdf->Cell(15,8,iconv('UTF-8','cp874',$num_product),1,0,'C');
              $pdf->Cell(15,8,iconv('UTF-8','cp874',$price),1,0,'C');
              $pdf->Cell(20,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
              
              if($slip_number == '-'){
                $pdf->Cell(15,8,iconv('UTF-8','cp874',$value['slip_number']),1,0,'C');
              }else{
                $pdf->Cell(15,8,iconv('UTF-8','cp874',$value['slip_number']),1,0,'C');
              }
              $pdf->Cell(20,8,iconv('UTF-8','cp874',$value['catagory_car']),1,0,'C');
              $pdf->Cell(15,8,iconv('UTF-8','cp874',$value['pay_portage']),1,0,'C');
              $pdf->Cell(23,8,iconv('UTF-8','cp874',DateThai($value['date_order'])),1,0,'C');
              $pdf->Cell(23,8,iconv('UTF-8','cp874',DateThai($value['date_getorder'])),1,0,'C');
              $pdf->Cell(23,8,iconv('UTF-8','cp874',DateThai($value['date_receive'])),1,0,'C');
              $pdf->Cell(40,8,iconv('UTF-8','cp874',$value['amphur_name'].' จ.'.$value['province_name']),1,0,'L');
              $pdf->Ln(8);
            }                    
    $pdf->Output();
?>