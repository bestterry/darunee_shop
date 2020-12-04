<?php
  require('fpdf.php');
  require('../config_database/config.php'); 
  require('../session.php');
  require('date/datetime.php');
  class PDF extends FPDF
    {
      function Header()
      {
        require('../config_database/config.php'); 
        $aday = $_POST['aday'];
        $bday = $_POST['bday'];
        $this->SetTextColor(0,0,0);
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',22);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'รายการโอนจ่าย'), 0 , 1,'C' );
        $this->Ln(3);
        $this->SetFont('angsana','',18);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,DateThai($aday).'  ถึง  '.DateThai($bday)), 0 , 1,'C' );
        $this->Ln(3);
        $this->SetFont('angsana','',16);
        $this->Cell(30,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','รายการ'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','เงินจ่าย'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','คงเหลือ'),1,0,'C');
        $this->Cell(30,8,iconv('UTF-8','cp874','ประเภท'),1,0,'C');
        $this->Cell(110,8,iconv('UTF-8','cp874','รายละเอียด'),1,0,'C');
        $this->Ln(8);
      }
    }

  // Instanciation of inherited class
  $pdf=new PDF('L','mm','A4');
      // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
      $pdf->AliasNbPages();
      $pdf->SetMargins(20,13,10);
      $pdf->AddFont('angsana','','angsa.php');
      //สร้างหน้าเอกสาร
      $pdf->AddPage();
      $pdf->SetFont('angsana','',16);
      $aday = $_POST['aday'];
      $bday = $_POST['bday'];
      $sql_history = "SELECT * FROM reserve_history INNER JOIN reserve_list ON reserve_history.id_list = reserve_list.id_list
                      WHERE (reserve_history.status = 2 OR reserve_history.status = 3 OR reserve_history.status = 5 OR reserve_history.status = 1) 
                      AND reserve_history.transfer_office != '' 
                      AND (reserve_history.date BETWEEN '$aday' AND '$bday')
                      ORDER BY reserve_history.id_reserve_history DESC";
      $objq_history = mysqli_query($conn,$sql_history);
      while($value = $objq_history -> fetch_assoc()){

        if($value['status_lavish']=='Y'){
          $status_lavish = "ฟุ่มเฟือย";
        }else {
          $status_lavish = "ปกติ";
        }
        
        $pdf->Cell(30,8,iconv('UTF-8','cp874',Datethai($value['date'])),1,0,'C');
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['name_list']),1,0,'C');
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['money']),1,0,'C');
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$value['transfer_office']),1,0,'C');
        $pdf->Cell(30,8,iconv('UTF-8','cp874',$status_lavish),1,0,'C');
        $pdf->Cell(110,8,iconv('UTF-8','cp874',$value['note']),1,0,'C');
        $pdf->Ln(8);
      }

      $usemoney = "SELECT SUM(money) FROM reserve_history WHERE id_member = 33 
                   AND status_cancen = 'Y' AND id_list != 18 
                   AND (date BETWEEN '$aday' AND '$bday')";
      $objq_usermoney = mysqli_query($conn,$usemoney);
      $objr_usemoney = mysqli_fetch_array($objq_usermoney);

      $uselavish = "SELECT SUM(money) FROM reserve_history WHERE id_member = 33 AND status_cancen = 'Y' 
                   AND id_list != 18 AND status_lavish = 'Y' 
                   AND (date BETWEEN '$aday' AND '$bday')";
      $objq_uselavish = mysqli_query($conn,$uselavish);
      $objr_uselavish = mysqli_fetch_array($objq_uselavish);

      $usenormal = "SELECT SUM(money) FROM reserve_history WHERE id_member = 33 AND status_cancen = 'Y' 
                   AND id_list != 18 AND status_lavish = 'N' 
                   AND (date BETWEEN '$aday' AND '$bday')";
      $objq_usenormal = mysqli_query($conn,$usenormal);
      $objr_usenormal = mysqli_fetch_array($objq_usenormal);

        $pdf->Ln(8);
        
        $pdf->Cell(86,8,iconv('UTF-8','cp874','เงินฟุ่มเฟือย'),1,0,'C');
        $pdf->Cell(87,8,iconv('UTF-8','cp874','เงินปกติ'),1,0,'C');
        $pdf->Cell(87,8,iconv('UTF-8','cp874','รวมใช้เงิน'),1,0,'C');
        $pdf->Ln(8);
        $pdf->Cell(86,8,iconv('UTF-8','cp874',$objr_uselavish['SUM(money)']),1,0,'C');
        $pdf->Cell(87,8,iconv('UTF-8','cp874',$objr_usenormal['SUM(money)']),1,0,'C');
        $pdf->Cell(87,8,iconv('UTF-8','cp874',$objr_usemoney['SUM(money)']),1,0,'C');
        $pdf->Ln(8);
      
     
  $pdf->Output();
?>