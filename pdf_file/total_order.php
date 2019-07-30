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
        function Header()
        {
            // Date
            $strDate = date('d-m-Y');
            // Arial bold 15
            $this->AddFont('angsana','','angsa.php');
            $this->SetFont('angsana','',20);
            
            //Date
            $this->SetTextColor(255,0,0); 
            $this->Text(235, 9,iconv('UTF-8','cp874',DateThai($strDate)),1,0,'C');
        }
        // Page footer
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
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(5,10,10);
            $pdf->AddFont('angsana','','angsa.php');
            //สร้างหน้าเอกสาร

            //ค้างส่งรวม//
                  $pdf->AddPage();
                  $pdf->SetFont('angsana','',18);
                  $pdf->Text(145,9,iconv('UTF-8','cp874','ORDER ค้างส่ง'),1,0,'C');
                  $pdf->Ln(3);
                  $pdf->Cell(40,9,iconv('UTF-8','cp874',''),1,0,'C');
                  $pdf->Cell(40,9,iconv('UTF-8','cp874','พะเยา'),1,0,'C');
                  $pdf->Cell(40,9,iconv('UTF-8','cp874','เวียงป่าเป้า'),1,0,'C');
                  $pdf->Cell(40,9,iconv('UTF-8','cp874','ลำปาง'),1,0,'C');
                  $pdf->Cell(40,9,iconv('UTF-8','cp874','ฮอด'),1,0,'C');
                  $pdf->Cell(40,9,iconv('UTF-8','cp874','แม่จัน'),1,0,'C');
                  $pdf->Cell(40,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
                  $pdf->Ln(9);
                  $sql_pd = "SELECT * FROM product";
                    $objq_pd = mysqli_query($conn,$sql_pd);
                    while ($value_pd = $objq_pd->fetch_assoc()) {
                     $id_product = $value_pd['id_product'];
                     $pdf->Cell(40,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                     $total_num = 0;
                      for ($i=1; $i < 6; $i++) { 
                        $sql_num = "SELECT SUM(num) FROM addorder 
                                    INNER JOIN listorder ON listorder.id_addorder = addorder.id_addorder 
                                    INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                    WHERE listorder.id_product = $id_product AND addorder.status = 'pending' AND tbl_amphures.id_area = $i";
                        $objq_num = mysqli_query($conn,$sql_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        $num = $objr_num['SUM(num)'];
                          if (!isset($num)) {
                            $pdf->Cell(40,9,iconv('UTF-8','cp874','-'),1,0,'C');
                          }else{
                            $pdf->Cell(40,9,iconv('UTF-8','cp874',$num),1,0,'C');
                          } 
                          $total_num = $total_num + $num;
                      }
                      $pdf->Cell(40,9,iconv('UTF-8','cp874',$total_num),1,0,'C');
                     $pdf->Ln(9);
                    }

            //ค้างส่งพะเยา//
                  $pdf->AddPage();
                  $pdf->SetFont('angsana','',18);
                  $pdf->Text(145,9,iconv('UTF-8','cp874','ค้างส่ง : เขต พะเยา'),1,0,'C');
                  $pdf->Ln(3);
                  $pdf->SetFont('angsana','',16);
                  $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
                  $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 1";
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
                      $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                      $total_pd = 0;
                          $id_product = $value_pd['id_product'];
                          $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 1";
                          $objq_amphur = mysqli_query($conn,$sql_amphur);
                          while($value_am = $objq_amphur->fetch_assoc())
                          {
                            
                            $amphur_id = $value_am['amphur_id'];
                            $sql_numpd = "SELECT SUM(num) FROM listorder 
                                          INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                          INNER JOIN product ON listorder.id_product = product.id_product
                                          WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                            $objq_numpd = mysqli_query($conn,$sql_numpd);
                            $objr_numpd = mysqli_fetch_array($objq_numpd);
                            $numpd = $objr_numpd['SUM(num)'];;
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
                //--ค้างส่งพะเยา//

               //ค้างส่งเวียงป่าเป้า//
               $pdf->AddPage();
               $pdf->SetFont('angsana','',18);
               $pdf->Text(145,9,iconv('UTF-8','cp874','ค้างส่ง : เขต เวียงป่าเป้า'),1,0,'C');
               $pdf->Ln(3);
               $pdf->SetFont('angsana','',16);
               $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
               $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 2";
               $objq_amphur = mysqli_query($conn,$sql_amphur);
               while($value_am = $objq_amphur->fetch_assoc()){
                 $pdf->Cell(40,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
               }
               $pdf->Cell(40,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
               $pdf->Ln(9);
                 $sql_product = "SELECT * FROM product";
                 $objq_product = mysqli_query($conn,$sql_product);
                 while($value_pd = $objq_product->fetch_assoc())
                 {
                   $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                   $total_pd = 0;
                       $id_product = $value_pd['id_product'];
                       $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 2";
                       $objq_amphur = mysqli_query($conn,$sql_amphur);
                       while($value_am = $objq_amphur->fetch_assoc())
                       {
                         
                         $amphur_id = $value_am['amphur_id'];
                         $sql_numpd = "SELECT SUM(num) FROM listorder 
                                       INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                       INNER JOIN product ON listorder.id_product = product.id_product
                                       WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                         $objq_numpd = mysqli_query($conn,$sql_numpd);
                         $objr_numpd = mysqli_fetch_array($objq_numpd);
                         $numpd = $objr_numpd['SUM(num)'];;
                         if (!isset($numpd)) {
                           $pdf->Cell(40,9,iconv('UTF-8','cp874','-'),1,0,'C');
                         }else{
                           $pdf->Cell(40,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                         }
                         $total_pd = $total_pd + $numpd;
                   }
               $pdf->Cell(40,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
               $pdf->Ln(9);
             }
             //--ค้างส่งเวียงป่าเป้า//

            //ค้างส่งลำปาง//
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Text(145,9,iconv('UTF-8','cp874','ค้างส่ง : เขต ลำปาง'),1,0,'C');
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
            $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 3";
            $objq_amphur = mysqli_query($conn,$sql_amphur);
            while($value_am = $objq_amphur->fetch_assoc()){
              $pdf->Cell(20,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
            }
            $pdf->Cell(20,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
            $pdf->Ln(9);
              $sql_product = "SELECT * FROM product";
              $objq_product = mysqli_query($conn,$sql_product);
              while($value_pd = $objq_product->fetch_assoc())
              {
                $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                $total_pd = 0;
                    $id_product = $value_pd['id_product'];
                    $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 3";
                    $objq_amphur = mysqli_query($conn,$sql_amphur);
                    while($value_am = $objq_amphur->fetch_assoc())
                    {
                      
                      $amphur_id = $value_am['amphur_id'];
                      $sql_numpd = "SELECT SUM(num) FROM listorder 
                                    INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                    INNER JOIN product ON listorder.id_product = product.id_product
                                    WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                      $objq_numpd = mysqli_query($conn,$sql_numpd);
                      $objr_numpd = mysqli_fetch_array($objq_numpd);
                      $numpd = $objr_numpd['SUM(num)'];;
                      if (!isset($numpd)) {
                        $pdf->Cell(20,9,iconv('UTF-8','cp874','-'),1,0,'C');
                      }else{
                        $pdf->Cell(20,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                      }
                      $total_pd = $total_pd + $numpd;
                }
            $pdf->Cell(20,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
            $pdf->Ln(9);
            }
            //--ค้างส่งลำปาง//

            //ค้างส่งฮอด//
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Text(145,9,iconv('UTF-8','cp874','ค้างส่ง : เขต ฮอด'),1,0,'C');
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
            $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 4";
            $objq_amphur = mysqli_query($conn,$sql_amphur);
            while($value_am = $objq_amphur->fetch_assoc()){
              $pdf->Cell(50,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
            }
            $pdf->Cell(50,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
            $pdf->Ln(9);
              $sql_product = "SELECT * FROM product";
              $objq_product = mysqli_query($conn,$sql_product);
              while($value_pd = $objq_product->fetch_assoc())
              {
                $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                $total_pd = 0;
                    $id_product = $value_pd['id_product'];
                    $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 4";
                    $objq_amphur = mysqli_query($conn,$sql_amphur);
                    while($value_am = $objq_amphur->fetch_assoc())
                    {
                      
                      $amphur_id = $value_am['amphur_id'];
                      $sql_numpd = "SELECT SUM(num) FROM listorder 
                                    INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                    INNER JOIN product ON listorder.id_product = product.id_product
                                    WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                      $objq_numpd = mysqli_query($conn,$sql_numpd);
                      $objr_numpd = mysqli_fetch_array($objq_numpd);
                      $numpd = $objr_numpd['SUM(num)'];;
                      if (!isset($numpd)) {
                        $pdf->Cell(50,9,iconv('UTF-8','cp874','-'),1,0,'C');
                      }else{
                        $pdf->Cell(50,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                      }
                      $total_pd = $total_pd + $numpd;
                }
            $pdf->Cell(50,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
            $pdf->Ln(9);
            }
            //--ค้างส่งฮอด//

            //ค้างส่งแม่จัน//
            $pdf->AddPage();
            $pdf->SetFont('angsana','',18);
            $pdf->Text(145,9,iconv('UTF-8','cp874','ค้างส่ง : เขต แม่จัน'),1,0,'C');
            $pdf->Ln(3);
            $pdf->SetFont('angsana','',16);
            $pdf->Cell(35,9,iconv('UTF-8','cp874',''),1,0,'C');
            $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 5";
            $objq_amphur = mysqli_query($conn,$sql_amphur);
            while($value_am = $objq_amphur->fetch_assoc()){
              $pdf->Cell(30,9,iconv('UTF-8','cp874',$value_am['amphur_name']),1,0,'C');
            }
            $pdf->Cell(30,9,iconv('UTF-8','cp874','รวม'),1,0,'C');
            $pdf->Ln(9);
              $sql_product = "SELECT * FROM product";
              $objq_product = mysqli_query($conn,$sql_product);
              while($value_pd = $objq_product->fetch_assoc())
              {
                $pdf->Cell(35,9,iconv('UTF-8','cp874',$value_pd['name_product'].'_'.$value_pd['unit']),1,0,'C');
                $total_pd = 0;
                    $id_product = $value_pd['id_product'];
                    $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 5";
                    $objq_amphur = mysqli_query($conn,$sql_amphur);
                    while($value_am = $objq_amphur->fetch_assoc())
                    {
                      
                      $amphur_id = $value_am['amphur_id'];
                      $sql_numpd = "SELECT SUM(num) FROM listorder 
                                    INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                    INNER JOIN product ON listorder.id_product = product.id_product
                                    WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                      $objq_numpd = mysqli_query($conn,$sql_numpd);
                      $objr_numpd = mysqli_fetch_array($objq_numpd);
                      $numpd = $objr_numpd['SUM(num)'];;
                      if (!isset($numpd)) {
                        $pdf->Cell(30,9,iconv('UTF-8','cp874','-'),1,0,'C');
                      }else{
                        $pdf->Cell(30,9,iconv('UTF-8','cp874',$numpd),1,0,'C');
                      }
                      $total_pd = $total_pd + $numpd;
                }
            $pdf->Cell(30,9,iconv('UTF-8','cp874',$total_pd),1,0,'C');
            $pdf->Ln(9);
            }
            //--ค้างส่งฮอด//

// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>