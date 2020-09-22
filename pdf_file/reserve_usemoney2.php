<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
require('date/datetime.php');
class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // Date
        require('../config_database/config.php'); 
        $id_member = $_GET['id_member'];
        $aday = $_GET['aday'];
        $bday = $_GET['bday'];
        $sql_member = "SELECT id_member,name FROM member WHERE id_member = $id_member";
        $objq_member = mysqli_query($conn,$sql_member);
        $objr_member = mysqli_fetch_array($objq_member);
        $name_member = $objr_member['name'];
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        //Date
        $this->SetTextColor(0,0,0); 
        $this->Text(200, 10,iconv('UTF-8','cp874','วันที่  '. $aday .'ถึง '.$bday),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ข้อมูลใช้เงินสำรองจ่ายหน่วยรถ : '.$name_member) , 0 , 1,'L' );
        $this->Ln(3);
        $this->SetFont('angsana','',16);
        $this->Cell(45,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
        $this->Cell(45,8,iconv('UTF-8','cp874','ค่าเช่ารถ'),1,0,'C');
        $this->Cell(45,8,iconv('UTF-8','cp874','ค่าน้ำมัน'),1,0,'C');
        $this->Cell(45,8,iconv('UTF-8','cp874','ค่าเบี้ยเลี้ยง'),1,0,'C');
        $this->Cell(45,8,iconv('UTF-8','cp874','ค่าที่พัก'),1,0,'C');
        $this->Cell(45,8,iconv('UTF-8','cp874','ค่าใช้จ่ายอื่นๆ'),1,0,'C');
        $this->Ln(8);
    }
  }

// Instanciation of inherited class
$pdf=new PDF('L','mm','A4');
    // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
    $pdf->AliasNbPages();
    $pdf->SetMargins(10,5,10);
    $pdf->AddFont('angsana','','angsa.php');
    //สร้างหน้าเอกสาร
    $pdf->AddPage();
    $pdf->SetFont('angsana','',16);
    $aday = $_GET['aday'];
    $bday = $_GET['bday'];
    $id_member = $_GET['id_member'];
      while(strtotime($bday) >= strtotime($aday)) { 
        $pdf->Cell(45,8,iconv('UTF-8','cp874',DateThai($bday)),1,0,'C');
        $sql_resevelist = "SELECT id_list FROM reserve_list WHERE status = 4";
          $objq_reservelist = mysqli_query($conn,$sql_resevelist);
          while($value_reservelist = $objq_reservelist->fetch_assoc()){
            $id_list = $value_reservelist['id_list'];
            $sql_history = "SELECT SUM(money) FROM reserve_history 
                            WHERE id_list = $id_list AND id_member = $id_member AND DATE_FORMAT(date,'%Y-%m-%d')='$bday'";
            $objq_history = mysqli_query($conn,$sql_history);
            while($value_history = $objq_history->fetch_assoc()){
              $pdf->Cell(45,8,iconv('UTF-8','cp874',$value_history['SUM(money)']),1,0,'C');
            }
          }
        $pdf->Ln(8);
        $bday = date ("Y-m-d", strtotime("-1 day", strtotime($bday)));
      }         
$pdf->Output();
?>