<?php
require 'fpdf.php';
require '../connect/connect.php';
$conn->set_charset("UTF-8");

class PDF extends FPDF{
    function header(){
        $this->Addfont('angsa','','angsa.php');
        $this->SetFont('angsa','','20'); 
        $this->Cell(180,10,iconv('UTF-8','TIS-620','สถิติการใช้น้ำ'),0,0,'C');
        $this->Ln();
        $this->Addfont('angsa','','angsa.php');
        $this->SetFont('angsa','','18');
        $this->Cell(180,10,iconv('UTF-8','TIS-620','องค์การบริหารส่วนตำบลบ้านถ้ำ'),0,0,'C');
        $this->Ln();
        $this->Addfont('angsa','','angsa.php');
        $this->SetFont('angsa','','16');
        $this->Setfillcolor(180,180,255);
        $this->SetDrawcolor(50,50,100);
        $this->Cell(50,10,iconv('UTF-8','TIS-620','วันที่'),1,0,'',true);
        $this->Cell(50,10,iconv('UTF-8','TIS-620','หน่วยน้ำที่ใช้'),1,0,'',true);
        $this->Cell(50,10,iconv('UTF-8','TIS-620','จำนวนเงิน'),1,0,'',true);
      
        $this->Ln();
    }
    function footer(){
        $this->SetY(-15);
        $this->Setfont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    
    
}


$pdf = new PDF('P','mm','A4');
$pdf->AddPage('','A4',0);
$pdf->Addfont('angsa','','angsa.php');
$pdf->SetFont('angsa','','16');


// echo $yearbefore;
// echo $yearafter;
//  die();
$month_before=$_GET['month_before'];
$year_before=$_GET['year_before'];
$month_after=$_GET['month_after'];
$year_after=$_GET['year_after'];
$query="SELECT datatime,sum(money),sum(meter) FROM datameter WHERE (datatime between '$year_before-$month_before-01' and '$year_after-$month_after-31') GROUP BY MONTH(datatime),YEAR(datatime)";
$data=mysqli_query($conn,$query);
$sql_search_sum="SELECT sum(meter),sum(money) FROM datameter  WHERE (datatime between '$year_before-$month_before-01' and '$year_after-$month_after-31')  ";
$data_sum=mysqli_query($conn,$sql_search_sum);
$objr_sum=mysqli_fetch_array($data_sum);
   
   foreach ($data as $m ):
    $pdf->Cell(50,9,$m['datatime'],1,0);
    $pdf->Cell(50,9,$m['sum(meter)'],1,0);
    $pdf->Cell(50,9,$m['sum(money)'],1,0);
    
    $pdf->Ln();
endforeach;
$pdf->Ln();
$pdf->Cell(50,10,iconv('UTF-8','TIS-620','วันที่'),1,0,'');
$pdf->Cell(50,10,iconv('UTF-8','TIS-620','จำนวนหน่วยน้ำที่ใช้'),1,0,'');
$pdf->Cell(50,10,iconv('UTF-8','TIS-620','จำนวนเงินทั้งหมด'),1,0,'');
$pdf->Ln();
$pdf->Cell(50,10,iconv('UTF-8','TIS-620',$month_after),1,0,'');
$pdf->Cell(50,10,iconv('UTF-8','TIS-620',$objr_sum['sum(meter)']),1,0,'');
$pdf->Cell(50,10,iconv('UTF-8','TIS-620',$objr_sum['sum(money)']),1,0,'');
$pdf->Output();
?>