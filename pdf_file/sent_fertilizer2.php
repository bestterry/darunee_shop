<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
require('date/datetime.php');

$aday = $_POST['aday'];
$bday = $_POST['bday'];

class PDF extends FPDF
  {
  // Page header
    function Header()
    {
      $aday = $_POST['aday'];
      $bday = $_POST['bday'];
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',20);
        
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' , 'ค่ายกปุ๋ย '.Datethai($aday).' ถึง '.Datethai($bday)) , 0 , 1,'C' );
        $this->Ln(5);
        
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
            $pdf->SetMargins(5, 10,5);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $sql_car = "SELECT id_member,name FROM member WHERE 
            status='employee' AND NOT id_member = 3 AND NOT id_member = 8 AND NOT id_member = 19
                    AND NOT id_member = 32 AND NOT id_member = 28";
            $objq_car = mysqli_query($conn,$sql_car);
            $objq_car2 = mysqli_query($conn,$sql_car);

            $pdf->AddPage();
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(25,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(50,8,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
            $pdf->Cell(50,8,iconv('UTF-8','cp874','ค่ายก'),1,0,'C');
            $pdf->Cell(50,8,iconv('UTF-8','cp874','ค่ารถ'),1,0,'C');
            $pdf->Ln(8);

            while($value = $objq_car2 -> fetch_assoc()){
              $id_member = $value['id_member'];
              $name = $value['name'];
              $sql_ferti = "SELECT SUM(money) FROM sent_ferti  
              WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') AND sent_ferti.id_member = $id_member";
              $objq_ferti = mysqli_query($conn,$sql_ferti);
              $objr_ferti = mysqli_fetch_array($objq_ferti);
              $money = $objr_ferti['SUM(money)'];

              $sql_numferti = "SELECT SUM(num_ferti) FROM sent_ferti  
              WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') AND sent_ferti.id_member = $id_member AND id_type_lift = 1 AND id_car = $id_member";
              $objq_numferti = mysqli_query($conn,$sql_numferti);
              $objr_numferti = mysqli_fetch_array($objq_numferti);
              $num_ferti = $objr_numferti['SUM(num_ferti)'];

              $pdf->Cell(25,8,iconv('UTF-8','cp874',''),0,0,'C');
              $pdf->Cell(50,8,iconv('UTF-8','cp874',$name),1,0,'C');
              $pdf->Cell(50,8,iconv('UTF-8','cp874',$money),1,0,'C');
              $pdf->Cell(50,8,iconv('UTF-8','cp874',ceil($num_ferti*1.5)),1,0,'C');
              $pdf->Ln(8);
            }

            $pdf->AddPage();
            $pdf->SetFont('angsana','',16);

        while($value_car = $objq_car->fetch_assoc()){
         $id_member = $value_car['id_member']; 
         $name_member = $value_car['name'];
         $total_rental = 0;
         $total_money = 0;
        $i = 1;
        $sql_ferti = "SELECT * FROM sent_ferti
                      INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
                      INNER JOIN member ON sent_ferti.id_member = member.id_member 
                      WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') AND sent_ferti.id_member = $id_member";
        $objq_ferti = mysqli_query($conn,$sql_ferti);
        $num_row = mysqli_num_rows($objq_ferti);

        if($num_row == 0){

        }else{
          $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'ชื่อ '.$name_member) , 0 , 1,'L' );
          $pdf->Ln(3);
          $pdf->Cell(10,8,iconv('UTF-8','cp874','ที่'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','รถ'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','งาน'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','กส'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','คน'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','ค่ายก'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','ค่ารถ'),1,0,'C');
          $pdf->Cell(44,8,iconv('UTF-8','cp874','รายการ'),1,0,'C');
          $pdf->Cell(15,8,iconv('UTF-8','cp874','วัน'),1,0,'C');
          $pdf->Ln(8);
        }


          while($value = $objq_ferti->fetch_assoc()){
            $id_car = $value['id_car'];
            $id_type_lift = $value['id_type_lift'];
            
            $sql = "SELECT name FROM member WHERE id_member = $id_car";
            $objq = mysqli_query($conn,$sql);
            $objr = mysqli_fetch_array($objq);
            $id_member = $value['id_member'];

            if(($id_member == $id_car) && ($id_type_lift == 1)){
              $car_rental = $value['num_ferti']*1.5;
            }else{
              $car_rental = 0;
            }
            
            $pdf->Cell(10,8,iconv('UTF-8','cp874',$i),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$objr['name']),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['name_type_lift']),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['num_ferti']),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['num_cus']),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['money']),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$car_rental),1,0,'C');
            $pdf->Cell(44,8,iconv('UTF-8','cp874',$value['note']),1,0,'C');
            $pdf->Cell(15,8,iconv('UTF-8','cp874',DateThai2($value['datetime'])),1,0,'C');
            $pdf->Ln(8);
            $i++;
            $total_rental = $total_rental + $car_rental;
            $total_money = $total_money + $value['money'];
          }
          
          if($num_row == 0){

          }else{
            $pdf->Cell(10,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874','รวม'),0,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$total_money),1,0,'C');
            $pdf->Cell(18,8,iconv('UTF-8','cp874',$total_rental),1,0,'C');
            $pdf->Cell(44,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(15,8,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Ln(10);
          }
            
        }

        $sql_ferti_car = "SELECT * FROM sent_ferti
                      INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
                      INNER JOIN member ON sent_ferti.id_member = member.id_member 
                      WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') AND sent_ferti.id_car = 36 AND id_type_lift = 1";
        $objq_ferti_car = mysqli_query($conn,$sql_ferti_car);
        $num_row2 = mysqli_num_rows($objq_ferti_car);
        if($num_row2 == 0){

        }else{
          $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'ชื่อ '.'รถทีมงาน') , 0 , 1,'L' );
          $pdf->Ln(3);
          $pdf->Cell(10,8,iconv('UTF-8','cp874','ที่'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','ชื่อ'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','รถ'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','คน'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','กส'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','ค่ารถ'),1,0,'C');
          $pdf->Cell(44,8,iconv('UTF-8','cp874','รายการ'),1,0,'C');
          $pdf->Cell(15,8,iconv('UTF-8','cp874','เวลา'),1,0,'C');
          $pdf->Ln(8);
        }
        while($value = $objq_ferti_car->fetch_assoc()){
          $car_rental = $value['num_ferti']*0.75;
          
          $pdf->Cell(10,8,iconv('UTF-8','cp874',$i),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['name']),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','รถทีมงาน'),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['num_cus']),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',$value['num_ferti']),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',$car_rental),1,0,'C');
          $pdf->Cell(44,8,iconv('UTF-8','cp874',$value['note']),1,0,'C');
          $pdf->Cell(15,8,iconv('UTF-8','cp874',Datetime($value['datetime'])),1,0,'C');
          $pdf->Ln(8);
          $i++;
          // $total_rental = $total_rental + $car_rental;
          // $total_money = $total_money + $value['money'];
        }  
        if($num_row2 == 0){

        }else{
          $Tnum_ferti = 0;
          $sql_check = "SELECT num_ferti,num_cus FROM sent_ferti WHERE id_car = 36 AND id_type_lift = 1 AND (datetime between '$aday 00:00:00' and '$bday 23:59:59')";
          $objq_check = mysqli_query($conn,$sql_check);
          while($value = $objq_check->fetch_assoc()){
            $num_ferti = $value['num_ferti'];
            $num_cus = $value['num_cus'];
            $Tnum_ferti = $Tnum_ferti+($num_ferti/$num_cus);
          }

          $pdf->Cell(10,8,iconv('UTF-8','cp874',''),0,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',''),0,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',''),0,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874','รวม'),0,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',ceil($Tnum_ferti)),1,0,'C');
          $pdf->Cell(18,8,iconv('UTF-8','cp874',ceil($Tnum_ferti*1.5)),1,0,'C');
          $pdf->Cell(44,8,iconv('UTF-8','cp874',''),0,0,'C');
          $pdf->Cell(15,8,iconv('UTF-8','cp874',''),0,0,'C');
          $pdf->Ln(10);
        }            
                      
    $pdf->Output();
?>