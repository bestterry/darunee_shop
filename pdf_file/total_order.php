<?php
require('fpdf.php');
require('../config_database/config.php'); 
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
    
  }

// Instanciation of inherited class
$pdf=new PDF('L','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(5,10,10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร

            //เชียงใหม่//
                  $pdf->AddPage();
                  $pdf->SetFont('angsana','',18);
                  $pdf->Text(145,9,iconv('UTF-8','cp874','ค้างส่ง จ.เชียงใหม่'),1,0,'C');
                  $pdf->Ln(3);
                  $pdf->SetFont('angsana','',16);
                  $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
                  $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 38";
                  $objq_amphur = mysqli_query($conn,$sql_amphur);
                  while($value_am = $objq_amphur->fetch_assoc()){
                    $pdf->Cell(27,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
                  }
                  $pdf->Cell(27,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
                  $pdf->Ln(9);
                  $sql_product = "SELECT * FROM product";
                  $objq_product = mysqli_query($conn,$sql_product);
                  while($value_pd = $objq_product->fetch_assoc())
                  {
                    $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                    $total_pd = 0;
                    $id_product = $value_pd['id_product'];
                    $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 38";
                    $objq_amphur = mysqli_query($conn,$sql_amphur);
                    while($value_am2 = $objq_amphur->fetch_assoc())
                    {
                      $amphur_id = $value_am2['amphur_id'];
                      $sql_numpd = "SELECT SUM(num) FROM listorder 
                                    INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                    INNER JOIN product ON listorder.id_product = product.id_product
                                    WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                      $objq_numpd = mysqli_query($conn,$sql_numpd);
                      $objr_numpd = mysqli_fetch_array($objq_numpd);
                      $numpd = $objr_numpd['SUM(num)'];
                      if (!isset($numpd)) {
                        $pdf->Cell(27,9,iconv('UTF-8','cp874','-'),1,0,'C');
                      }else{
                        $pdf->Cell(27,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                      }
                      $total_pd = $total_pd + $numpd;
                  }
                  $pdf->Cell(27,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
                  $pdf->Ln(9);
                }
                //--เชียงใหม่//

                //ลำปาง//
                $pdf->AddPage();
                $pdf->SetFont('angsana','',18);
                $pdf->Text(145, 9,iconv('UTF-8','cp874','ค้างส่ง จ.ลำปาง'),1,0,'C');
                $pdf->Ln(3);
                $pdf->SetFont('angsana','',14);
                $pdf->Cell(30,9,iconv('UTF-8','cp874',''),1,0,'C');
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id =40";
                $objq_amphur = mysqli_query($conn,$sql_amphur);
                while($value_am = $objq_amphur->fetch_assoc()){
                  $pdf->Cell(18,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
                }
                $pdf->Cell(18,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
                $pdf->Ln(9);
                $sql_product = "SELECT * FROM product";
                $objq_product = mysqli_query($conn,$sql_product);
                while($value_pd = $objq_product->fetch_assoc())
                {
                  $pdf->Cell(30,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                  $total_pd = 0;
                  $id_product = $value_pd['id_product'];
                  $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 40";
                  $objq_amphur = mysqli_query($conn,$sql_amphur);
                  while($value_am2 = $objq_amphur->fetch_assoc())
                  {
                    $amphur_id = $value_am2['amphur_id'];
                    $sql_numpd = "SELECT SUM(num) FROM listorder 
                                  INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                  INNER JOIN product ON listorder.id_product = product.id_product
                                  WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                    $objq_numpd = mysqli_query($conn,$sql_numpd);
                    $objr_numpd = mysqli_fetch_array($objq_numpd);
                    $numpd = $objr_numpd['SUM(num)'];
                    if (!isset($numpd)) {
                      $pdf->Cell(18,9,iconv('UTF-8','cp874','-'),1,0,'C');
                    }else{
                      $pdf->Cell(18,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                    }
                    $total_pd = $total_pd + $numpd;
                }
                $pdf->Cell(18,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
                $pdf->Ln(9);
              }
              //--ลำปาง//

              //พะเยา//
              $pdf->AddPage();
              $pdf->SetFont('angsana','',18);
              $pdf->Text(145, 9,iconv('UTF-8','cp874','ค้างส่ง จ.พะเยา'),1,0,'C');
              $pdf->Ln(3);
              $pdf->SetFont('angsana','',16);
              $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
              $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 44";
              $objq_amphur = mysqli_query($conn,$sql_amphur);
              while($value_am = $objq_amphur->fetch_assoc()){
                $pdf->Cell(25,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
              }
              $pdf->Cell(25,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
              $pdf->Ln(9);
              $sql_product = "SELECT * FROM product";
              $objq_product = mysqli_query($conn,$sql_product);
              while($value_pd = $objq_product->fetch_assoc())
              {
                $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                $total_pd = 0;
                $id_product = $value_pd['id_product'];
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 44";
                $objq_amphur = mysqli_query($conn,$sql_amphur);
                while($value_am2 = $objq_amphur->fetch_assoc())
                {
                  $amphur_id = $value_am2['amphur_id'];
                  $sql_numpd = "SELECT SUM(num) FROM listorder 
                                INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                INNER JOIN product ON listorder.id_product = product.id_product
                                WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                  $objq_numpd = mysqli_query($conn,$sql_numpd);
                  $objr_numpd = mysqli_fetch_array($objq_numpd);
                  $numpd = $objr_numpd['SUM(num)'];
                  if (!isset($numpd)) {
                    $pdf->Cell(25,9,iconv('UTF-8','cp874','-'),1,0,'C');
                  }else{
                    $pdf->Cell(25,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                  }
                  $total_pd = $total_pd + $numpd;
              }
              $pdf->Cell(25,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
              $pdf->Ln(9);
            }
            //--พะเยา//

            //เชียงราย//
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Text(145, 9,iconv('UTF-8','cp874','ค้างส่ง จ.เชียงราย'),1,0,'C');
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
            $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 45";
            $objq_amphur = mysqli_query($conn,$sql_amphur);
            while($value_am = $objq_amphur->fetch_assoc()){
              $pdf->Cell(27,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
            }
            $pdf->Cell(27,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
            $pdf->Ln(9);
            $sql_product = "SELECT * FROM product";
            $objq_product = mysqli_query($conn,$sql_product);
            while($value_pd = $objq_product->fetch_assoc())
            {
              $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
              $total_pd = 0;
              $id_product = $value_pd['id_product'];
              $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 45";
              $objq_amphur = mysqli_query($conn,$sql_amphur);
              while($value_am2 = $objq_amphur->fetch_assoc())
              {
                $amphur_id = $value_am2['amphur_id'];
                $sql_numpd = "SELECT SUM(num) FROM listorder 
                              INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                              INNER JOIN product ON listorder.id_product = product.id_product
                              WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                $objq_numpd = mysqli_query($conn,$sql_numpd);
                $objr_numpd = mysqli_fetch_array($objq_numpd);
                $numpd = $objr_numpd['SUM(num)'];
                if (!isset($numpd)) {
                  $pdf->Cell(27,9,iconv('UTF-8','cp874','-'),1,0,'C');
                }else{
                  $pdf->Cell(27,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                }
                $total_pd = $total_pd + $numpd;
            }
            $pdf->Cell(27,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
            $pdf->Ln(9);
          }
          //--เชียงราย//

// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>