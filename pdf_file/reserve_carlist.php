<?php
  require('fpdf.php');
  require('../config_database/config.php'); 
  require('../session.php');
  require('date/datetime.php');
  $id_member = $_POST['id_member'];

  class PDF extends FPDF
    {
      function Header()
      {
        require('../config_database/config.php'); 
        $id_member = $_POST['id_member'];
        $sql_member = "SELECT id_member,name FROM member WHERE id_member = $id_member";
        $objq_member = mysqli_query($conn,$sql_member);
        $objr_member = mysqli_fetch_array($objq_member);
        $name_member = $objr_member['name'];
        $aday = $_POST['aday'];
        $bday = $_POST['bday'];
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        //Date
        $this->SetTextColor(0,0,0); 
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ข้อมูลใช้เงินสำรองจ่าย : '.$name_member.'  '.DateThai($aday).' ถึง '.DateThai($bday)), 0 , 1,'L' );
        $this->Ln(3);
        $this->SetFont('angsana','',16);
        $this->Cell(35,8,iconv('UTF-8','cp874','วันที่'),1,0,'C');
        $this->Cell(35,8,iconv('UTF-8','cp874','รายการ'),1,0,'C');
        $this->Cell(35,8,iconv('UTF-8','cp874','จำนวนเงิน'),1,0,'C');
        $this->Cell(35,8,iconv('UTF-8','cp874','คงเหลือ'),1,0,'C');
        $this->Cell(50,8,iconv('UTF-8','cp874','หมายเหตุ'),1,0,'C');
        $this->Ln(8);
      }
    }

  // Instanciation of inherited class
  $pdf=new PDF('P','mm','A4');
      // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
      $pdf->AliasNbPages();
      $pdf->SetMargins(10,5,10);
      $pdf->AddFont('angsana','','angsa.php');
      //สร้างหน้าเอกสาร
      $pdf->AddPage();
      $pdf->SetFont('angsana','',16);
      $aday = $_POST['aday'];
      $bday = $_POST['bday'];
      $sql_history = "SELECT * FROM reserve_history INNER JOIN reserve_list ON reserve_history.id_list = reserve_list.id_list
                      WHERE reserve_history.id_member_receive = $id_member AND (reserve_history.status = 3 OR reserve_history.status = 4) 
                      AND (reserve_history.date BETWEEN '$aday' AND '$bday')
                      ORDER BY reserve_history.id_reserve_history DESC
                      LIMIT 1000";
      $objq_history = mysqli_query($conn,$sql_history);
      while($value = $objq_history -> fetch_assoc()){
        $pdf->Cell(35,8,iconv('UTF-8','cp874',Datethai($value['date'])),1,0,'C');
        $pdf->Cell(35,8,iconv('UTF-8','cp874',$value['name_list']),1,0,'C');
        $pdf->Cell(35,8,iconv('UTF-8','cp874',$value['money']),1,0,'C');
        $pdf->Cell(35,8,iconv('UTF-8','cp874',$value['transfer']),1,0,'C');
        $pdf->Cell(50,8,iconv('UTF-8','cp874',$value['note']),1,0,'C');
        $pdf->Ln(8);
      }
     
  $pdf->Output();
?>