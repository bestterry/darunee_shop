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
      $sql_order_listdata = "SELECT * FROM order_list
                             INNER JOIN product ON order_list.id_product = product.id_product
                             WHERE order_list.id_order_list = $id_order_list";
      $objq_order = mysqli_query($conn,$sql_order_listdata);
      $objr_order = mysqli_fetch_array($objq_order);

      $amphur_id = $objr_order['amphur_id'];
      $sql_amphur = "SELECT * FROM tbl2_amphures INNER JOIN tbl2_provinces ON tbl2_amphures.province_id = tbl2_provinces.province_id
                     WHERE tbl2_amphures.amphur_id = $amphur_id";
      $objq_amphur = mysqli_query($conn,$sql_amphur);
      $objr_amphur = mysqli_fetch_array($objq_amphur);

class PDF extends FPDF
  {
  // Page header
    function Header()
    {
        // Arial bold 15
        $this->AddFont('angsana','','angsa.php');
        $this->SetFont('angsana','',20);
        
        // Title
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ใบสั่งสินค้า') , 0 , 1,'C' ); 
        $this->Ln(2);
        $this->SetFont('angsana','',14);
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'ทีมงานคุณดารุณี ที่ตั้ง 31/1 ม.12 ต.สันสลี อ.เวียงป่าเป้า จ.เชียงราย 57170 โทร.081-916-9852') , 0 , 1,'C' );
        $this->Cell(0,5, iconv( 'UTF-8','cp874' ,'________________________________________________________________________________________________') , 0 , 1,'L' ); 
        $this->Ln(8);
      }
  }

// Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
            // ตั้งค่าขอบกระดาษทุกด้าน 20 มิลลิเมตร
            $pdf->AliasNbPages();
            $pdf->SetMargins(27, 20 ,20);
            $pdf->AddFont('angsana','','angsa.php');
            $pdf->SetFont('angsana','',18);
            
              //สร้างหน้าเอกสาร
              $pdf->AddPage();
              $pdf->SetTextColor(255,0,0);
              $pdf->SetFont('angsana','',25);
              $pdf->Text(60, 88,iconv('UTF-8','cp874',$objr_order['full_name']),1,0,'L');
              $pdf->SetTextColor(0,0,0);
              $pdf->SetFont('angsana','',18);
              $pdf->Text(195, 10,iconv('UTF-8','cp874',$objr_order['id_order_list']),1,0,'C');
              $pdf->Text(120, 58,iconv('UTF-8','cp874',DateThai($objr_order['date_order'])),1,0,'C');
              $pdf->Text(150, 48,iconv('UTF-8','cp874',$objr_order['list_order']),1,0,'C');
              $pdf->Text(63, 98,iconv('UTF-8','cp874',$objr_order['num_product'].'    '.$objr_order['unit']),1,0,'L');
              $pdf->Text(55, 119,iconv('UTF-8','cp874',$objr_order['name_store'].'     '.'อ.'.$objr_amphur['amphur_name'].'   จ.'.$objr_amphur['province_name']),1,0,'C');
              $pdf->Text(75, 127,iconv('UTF-8','cp874',$objr_order['name_to']),1,0,'C');
              $pdf->Text(132, 127,iconv('UTF-8','cp874',$objr_order['tel_to']),1,0,'L');
              $pdf->Text(60, 147,iconv('UTF-8','cp874',$objr_order['name_sent']),1,0,'L');
              $pdf->Text(132, 147,iconv('UTF-8','cp874',$objr_order['tel_sent']),1,0,'C');
              $pdf->Text(70, 155,iconv('UTF-8','cp874',$objr_order['catagory_car']),1,0,'C');
              $pdf->Text(132, 155,iconv('UTF-8','cp874',$objr_order['licent_plate']),1,0,'L');
              $pdf->Text(79, 163,iconv('UTF-8','cp874',DateThai($objr_order['date_getorder'])),1,0,'C');
              $pdf->Text(57, 182,iconv('UTF-8','cp874',$objr_order['name_author']),1,0,'C');
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'                                                                                               ใบสั่งที่ ......................................') , 0 , 1,'C' );
              $pdf->Ln(5);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'                                                                         วันที่ .................................................................') , 0 , 1,'C' );
              $pdf->Ln(5);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'') , 0 , 1,'L' );
              $pdf->Ln(5);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'สินค้า : ') , 0 , 1,'L' ); 
              $pdf->Ln(5);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'                สินค้า ........................................................................................................................') , 0 , 1,'L' );
              $pdf->Ln(5);
              $pdf->Cell(0,5, iconv( 'UTF-8','cp874' ,'                จำนวน .........................................................') , 0 , 1,'L' );
              $pdf->Ln(8);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'ผู้รับของ : ') , 0 , 1,'L' );
              $pdf->Ln(4);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'                ...........................................................................................................................') , 0 , 1,'L' );
              $pdf->Ln(4);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'                ผู้ประสานงาน ............................................... โทร ...................................................') , 0 , 1,'L' );
              $pdf->Ln(8);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'ข้อมูลรถ : ') , 0 , 1,'L' );
              $pdf->Ln(4);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'                พขร. .............................................................. โทร ...................................................') , 0 , 1,'L' );
              $pdf->Ln(4);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'                ประเภทรถ ......................................... ทะเบียนรถ ....................................................') , 0 , 1,'L' );
              $pdf->Ln(4);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'                วันที่เข้าโรงงาน ...........................................') , 0 , 1,'L' );
              $pdf->Ln(8);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'ผู้ออกใบสั่ง : ') , 0 , 1,'L' );
              $pdf->Ln(4);
              $pdf->Cell(0,4, iconv( 'UTF-8','cp874' ,'                 ..................................................................') , 0 , 1,'L' );                     
              $pdf->Ln(8);
              $pdf->Image('Signed.jpg',140,170,40,0,'','');
              $pdf->Text(157, 228,iconv('UTF-8','cp874','ผู้สั่ง'),1,0,'C');
              
// --------------------------------------------------------------------------------------                     
    $pdf->Output();
?>