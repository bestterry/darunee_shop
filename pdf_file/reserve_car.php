<?php
  require('fpdf.php');
  require('../config_database/config.php'); 
  require('../session.php');
  require('date/datetime.php');
  $id_member = $_POST['id_member'];
  $sql_resevelist = "SELECT id_list,name_list FROM reserve_list WHERE status = 4";

  class PDF extends FPDF
    {
    // Page header
      function Header()
      {
          // Date
          require('../config_database/config.php'); 
          $id_member = $_POST['id_member'];
          $sql_member = "SELECT id_member,name FROM member WHERE id_member = $id_member";
          $objq_member = mysqli_query($conn,$sql_member);
          $objr_member = mysqli_fetch_array($objq_member);
          $name_member = $objr_member['name'];
          // Arial bold 15
          $this->AddFont('angsana','','angsa.php');
          $this->SetFont('angsana','',16);
          //Date
          $this->SetTextColor(0,0,0); 
          // Title
          $this->SetTextColor(0,0,0);
          $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ข้อมูลใช้เงินสำรองจ่าย : '.$name_member), 0 , 1,'L' );
          $this->Ln(3);
          $this->SetFont('angsana','',16);
          $this->Cell(45,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
          $sql_resevelist = "SELECT id_list,name_list FROM reserve_list WHERE status = 4";
          $objq_reservelist = mysqli_query($conn,$sql_resevelist);
          while($value_reservename = $objq_reservelist->fetch_assoc()){
            $this->Cell(45,8,iconv('UTF-8','cp874',$value_reservename['name_list']),1,0,'C');
           }
          $this->Cell(45,8,iconv('UTF-8','cp874','รวมเงิน'),1,0,'C');
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
      $total_money = 0;
      $aday = $_POST['aday'];
      $bday = $_POST['bday'];
      while(strtotime($aday) <= strtotime($bday)) { 
        $pdf->Cell(45,8,iconv('UTF-8','cp874',Datethai($aday)),1,0,'C');
        $sum_money = 0;

        $objq_reservelist2 = mysqli_query($conn,$sql_resevelist);
        while($value_reservelist  = $objq_reservelist2->fetch_assoc()){
          $id_list = $value_reservelist['id_list'];
          $sql_history = "SELECT SUM(money) FROM reserve_history 
                            WHERE id_list = $id_list AND id_member = $id_member AND DATE_FORMAT(date,'%Y-%m-%d')='$aday'";
          $objq_history = mysqli_query($conn,$sql_history);
          while($value_history = $objq_history->fetch_assoc()){
            $pdf->Cell(45,8,iconv('UTF-8','cp874',$value_history['SUM(money)']),1,0,'C');
            $sum_money = $sum_money + $value_history['SUM(money)'];
          }
        } 
        $total_money = $total_money + $sum_money;
        $pdf->Cell(45,8,iconv('UTF-8','cp874',$sum_money),1,0,'C');
        $pdf->Ln(8);
        $aday = date ("Y-m-d", strtotime("+1 day", strtotime($aday)));
      } 

      $pdf->Cell(45,8,iconv('UTF-8','cp874','รวม'),1,0,'C');
      $aday = $_POST['aday'];
      $bday = $_POST['bday'];
      $objq_reservelist3 = mysqli_query($conn,$sql_resevelist);
        while($value_list = $objq_reservelist3->fetch_assoc()){
          $id_list = $value_list['id_list'];
          $sql_history = "SELECT SUM(money) FROM reserve_history WHERE id_list = $id_list AND id_member = $id_member 
                          AND (date between '$aday 00:00:00' and '$bday 23:59:59')";
          $objq_history = mysqli_query($conn,$sql_history);
          $objr_history = mysqli_fetch_array($objq_history);    
          $pdf->Cell(45,8,iconv('UTF-8','cp874',$objr_history['SUM(money)']),1,0,'C');
        } 
        $pdf->Cell(45,8,iconv('UTF-8','cp874',$total_money),1,0,'C');  
  $pdf->Output();
?>