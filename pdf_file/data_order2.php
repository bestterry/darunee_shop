<?php
require('fpdf.php');
require('../config_database/config.php'); 
  function DateThai($strDate)
      {
      $strYear = (date("Y",strtotime($strDate))+543)-2500;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMinute= date("i",strtotime($strDate));
      $strSeconds= date("s",strtotime($strDate));
      $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
      $strMonthThai=$strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strYear ";
      }

      $id_order_list = $_GET['id_order_list'];
      $sql_order_listdata = "SELECT * FROM order_list WHERE id_order_list = $id_order_list";
      $objq_order = mysqli_query($conn,$sql_order_listdata);
      $objr_order = mysqli_fetch_array($objq_order);

      $date_receive = DateThai($objr_order['date_receive']);
      $num = $objr_order['num_product'];
      $price = $objr_order['price'];
      $money = $objr_order['money'];
      $portage = $objr_order['portage'];
class PDF extends FPDF
  {
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(27, 20 ,20);
            $pdf->AddFont('cordia','','cordia.php');
            
            
              //สร้างหน้าเอกสาร
              $pdf->AddPage();

               //$pdf->Text(87, 45,iconv('UTF-8','cp874',$date_receive ),1,0,'C');
              //  $pdf->Text(87, 61,iconv('UTF-8','cp874',$num),1,0,'C');
              //  $pdf->Text(87, 73,iconv('UTF-8','cp874',$price),1,0,'C');
              //  $pdf->Text(87, 85,iconv('UTF-8','cp874',$money.'   '.'บาท'),1,0,'C');
              //  $pdf->Text(87, 97,iconv('UTF-8','cp874',$portage.'   '.'บาท'),1,0,'C');
              $pdf->SetFont('cordia','',26);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'หลังใบสั่ง') , 0 , 1,'C' );
              $pdf->Ln(20);

              $pdf->SetFont('cordia','',18);
              $pdf->Text(105, 37,iconv('UTF-8','cp874',$id_order_list),1,0,'C');
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'วันที่สินค้ามาถึง  :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,$date_receive) , 0 , 1,'L');
              $pdf->Ln(10);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'จำนวน :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,$num) , 0 , 1,'L');
              $pdf->Ln(5);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ราคาต่อหน่วย :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,$price) , 0 , 1,'L');
              $pdf->Ln(5);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'เงินซื้อ :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,$money) , 0 , 1,'L');
              $pdf->Ln(5);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ค่าขนส่ง :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,$portage) , 0 , 1,'L');
              $pdf->Ln(10);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ใบจ่าย :'),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'') , 0 , 1,'L');
              $pdf->Ln(10);
              $pdf->Cell(85,7, iconv( 'UTF-8','cp874' ,'ผู้ตรวจสอบ :' ),0,0,'R');
              $pdf->Cell(0,7, iconv( 'UTF-8','cp874' ,'') , 0 , 1,'L');
              $pdf->Ln(12);
              //$pdf->Text(91, 274,iconv('UTF-8','cp874',''),1,0,'L');
              
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>