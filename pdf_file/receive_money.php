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

        $this->Cell(0,8, iconv( 'UTF-8','cp874' , 'ตารางบันทึกข้อมูลการรับเงิน') , 0 , 1,'L' );
        $this->Cell(25,8,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','งาน'),1,0,'C');
        $this->Cell(50,8,iconv('UTF-8','cp874','พื้นที่ปฏิบัติงาน'),1,0,'C');
        $this->Cell(25,8,iconv('UTF-8','cp874','เงิน(บ)'),1,0,'C');
        $this->Cell(25,8,iconv('UTF-8','cp874','ประเภท'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','วันที่รับเงิน'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','สนง'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','วันที่รับเงิน(สนง.)'),1,0,'C');
        $this->Cell(20,8,iconv('UTF-8','cp874','หัวหน้า'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','วันที่รับเงิน(หัวหน้า)'),1,0,'C');
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
            $receive_money = "SELECT * FROM rc_receive_money 
                              INNER JOIN rc_practice ON rc_receive_money.id_practice = rc_practice.id_practice
                              INNER JOIN rc_category ON rc_receive_money.id_category = rc_category.id_category
                              INNER JOIN member ON rc_receive_money.id_member = member.id_member
                              GROUP BY rc_receive_money.id_receive_money DESC";
            $objq_receive = mysqli_query($conn,$receive_money);
            while($value = $objq_receive -> fetch_assoc()){
              $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
              $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['name_practice']),1,0,'C');
              $pdf->Cell(50,8,iconv('UTF-8','cp874',$value['area']),1,0,'C');
              $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['money']),1,0,'C');
              $pdf->Cell(25,8,iconv('UTF-8','cp874',$value['name_category']),1,0,'C');
              $pdf->Cell(30,8,iconv('UTF-8','cp874',Datethai($value['date'])),1,0,'C');

              //สถานะ office
              if($value['status_office']=='Y'){
                $pdf->Cell(20,8,iconv('UTF-8','cp874','รับแล้ว'),1,0,'C');
              }else{
                $pdf->Cell(20,8,iconv('UTF-8','cp874',''),1,0,'C');
              }
              //-สถานะ office

              //นที่รับเงิน office
              if (empty($value['date_office'])) {
                $pdf->Cell(30,8,iconv('UTF-8','cp874',''),1,0,'C');
              }else {
                $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['date_office']),1,0,'C');
              }
              //-วันที่รับเงิน office

              //สถานะ boss
              if($value['status_boss']=='Y'){
                $pdf->Cell(20,8,iconv('UTF-8','cp874','รับแล้ว'),1,0,'C');
              }else{
                $pdf->Cell(20,8,iconv('UTF-8','cp874',''),1,0,'C');
              }
              //-สถานะ boss

              //วันที่รับเงิน boss
              if (empty($value['date_boss'])) {
                $pdf->Cell(30,8,iconv('UTF-8','cp874',''),1,0,'C');
              }else {
                $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['date_boss']),1,0,'C');
              }
              //-วันที่รับเงิน boss
              $pdf->Ln(8); 
            }
                           
    $pdf->Output();
?>