<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php'); 
  $district_code = $_GET['district_name'];
  $sql_store = "SELECT * FROM store  
                INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                WHERE store.district_code = $district_code AND store.status = 'N'";
  $objq_store = mysqli_query($conn,$sql_store);
  $objr_store = mysqli_fetch_array($objq_store);

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

        $this->SetFont('angsana','',20);
        $this->SetTextColor(0,0,0);
        
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
            $pdf->SetMargins(5, 15,10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร
            $pdf->AddPage();
            $pdf->SetTextColor(0,0,0); 
            $pdf->SetFont('angsana','',20);
            $pdf->Text(95,10, iconv( 'UTF-8','cp874' , 'ตำบล'.$objr_store['district_name'] ) , 0 , 1,'L' );
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(45,10,iconv('UTF-8','cp874','ชื่อร้าน'),1,0,'C');
            $pdf->Cell(75,10,iconv('UTF-8','cp874','ที่อยู่'),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874','เบอร์โทร'),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874','ประเภท'),1,0,'C');
            $pdf->Cell(25,10,iconv('UTF-8','cp874','สถานะ'),1,0,'C');
            $pdf->Ln(10);
          $district_code = $_GET['district_name'];
          $sql_store = "SELECT * FROM store  
                        INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                        INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                        INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                        WHERE store.district_code = $district_code AND store.status = 'N'";
          $objq_store = mysqli_query($conn,$sql_store);
          while($value = $objq_store -> fetch_assoc()){
            $status = $value['status'];
              if ($status == 'Y') {
                $status_B = 'เยี่ยมแล้ว';
              }else {
                $status_B = 'ไม่ได้เยี่ยม';
              }
              $pdf->SetTextColor(0,0,0); 
              $pdf->Cell(45,10,iconv('UTF-8','cp874',$value['name_store']),1,0,'C');
              $pdf->Cell(75,10,iconv('UTF-8','cp874',$value['address'].' ต.'.$value['district_name'].'อ.'.$value['amphur_name'].'จ.'.$value['province_name']),1,0,'L');
              $pdf->Cell(25,10,iconv('UTF-8','cp874',$value['tel']),1,0,'C');
              $pdf->Cell(25,10,iconv('UTF-8','cp874',$value['category']),1,0,'C');
              $pdf->Cell(25,10,iconv('UTF-8','cp874',$status_B),1,0,'C');
              $pdf->Ln(10);
          }
// --------------------------------------------------------------------------------------              
    $pdf->Output();
?>