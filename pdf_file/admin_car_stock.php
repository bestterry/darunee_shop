<?php
require('fpdf.php');
require('../config_database/config.php'); 
require('../session.php');
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
        require('../config_database/config.php'); 
        $strDate = date('d-m-Y');
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',16);
        //Date
        $this->SetTextColor(0,0,0); 
        $this->Text(200, 10,iconv('UTF-8','cp874','วันที่  '.DateThai($strDate)),1,0,'C');
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'สต๊อกรถ') , 0 , 1,'L' );
        $this->Ln(3);
        $this->SetFont('angsana','',14);
        $this->Cell(25,8,iconv('UTF-8','cp874','สินค้า_หน่วย'),1,0,'C');
          $sql_member = "SELECT id_member,name_sub FROM member WHERE status_car = 1 
                        AND NOT id_member = 3 AND NOT id_member = 8 AND NOT id_member = 45  AND NOT id_member = 46";
          $objq_member = mysqli_query($conn,$sql_member);
          while($value = $objq_member -> fetch_assoc()){ 
            $this->Cell(10,8,iconv('UTF-8','cp874',$value['name_sub']),1,0,'C');
          }
        $this->Cell(11,8,iconv('UTF-8','cp874','รวม'),1,0,'C');
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
        
        $pdf->SetFont('angsana','',14);

      $sql_member = "SELECT id_member,name_sub FROM member WHERE status_car = 1 
                      AND NOT id_member = 3 AND NOT id_member = 8  AND NOT id_member = 45  AND NOT id_member = 46";

      $list_product = "SELECT * FROM product";
      $query_product = mysqli_query($conn,$list_product);
      $query_product2 = mysqli_query($conn,$list_product);

        while ($product = $query_product2->fetch_assoc()) {
          $pdf->Cell(25,8,iconv('UTF-8','cp874',$product['name_product'].'_'.$product['unit']),1,0,'C');
      
          $objq_member2 = mysqli_query($conn,$sql_member);
            while($value2 = $objq_member2 -> fetch_assoc()){
              $id_member = $value2['id_member'];
              $SQL_num = "SELECT num,SUM(num) FROM numpd_car WHERE id_product = $product[id_product] AND id_member = $id_member";
              $objq_num = mysqli_query($conn, $SQL_num);
              $objr_num = mysqli_fetch_array($objq_num);
              if((!isset($objr_num['num'])) || ($objr_num['num'] == 0)){
                $pdf->Cell(10,8,iconv('UTF-8','cp874',''),1,0,'C');
            } else {
              $num_pd = $objr_num['num'];
              $pdf->Cell(10,8,iconv('UTF-8','cp874',$num_pd),1,0,'C');
              }
            }
          $SQL_sum = "SELECT SUM(num) FROM numpd_car WHERE id_product = $product[id_product] ";
          $objq_sum = mysqli_query($conn, $SQL_sum);
          $objr_sum = mysqli_fetch_array($objq_sum);
          $sum = $objr_sum['SUM(num)'];
          $pdf->Cell(11,8,iconv('UTF-8','cp874',$sum),1,0,'C');
          $pdf->Ln(8); 
        }             
    $pdf->Output();
?>