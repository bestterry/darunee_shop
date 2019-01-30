<?php 
 function DateThai($strDate)
 {
   $strYear = date("Y",strtotime($strDate))+543;
   $strMonth= date("n",strtotime($strDate));
   $strDay= date("j",strtotime($strDate));
   $strHour= date("H",strtotime($strDate));
   $strMinute= date("i",strtotime($strDate));
   $strSeconds= date("s",strtotime($strDate));
   $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
   $strMonthThai=$strMonthCut[$strMonth];
   return "$strDay $strMonthThai $strYear";
 }

 $strDate = date('d-m-Y');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
  <div class="wrapper">
      <section class="invoice">
          <div class="row">
            <div class="col-xs-12">
              <h5 class="text-center"> ใบเสร็จรับเงิน </h5>
              <h3 class="page-header text-center"> ร้านทีมงานคุณดารุณี </h3>
              <p class="text-center" size="5">เลขที่ 31/1 หมู่ 12 ตำบลสันสลี อำเภอเวียงป่าเป้า จังหวัดเชียงราย 57170  โทร 081-916-9852</p>
              <p class="text-center">วันที่ &nbsp;&nbsp; <?php echo DateThai($strDate); ?></p>
              <p>ผู้ซื้อ/ที่อยู่ ......................................................................................................................................................................................</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="10%">ลำดับ</th>
                    <th class="text-center" width="40%">รายการสินค้า</th>
                    <th class="text-center" width="10%">จำนวน</th>
                    <th class="text-center" width="20%">ราคาต่อหน่วย</th>
                    <th class="text-center" width="20%">รวมเงิน (บาท)</th>
                  </tr>
                </thead>
                <tbody>
                <?php #endregion
                  $total_all=0;
                  $money_receive = $_POST['money_receive'];
                  for ($i=0; $i < count($_POST['name_product']) ; $i++) {
                    $total_price = $_POST['num_product'][$i]*$_POST['price_product'][$i];
                ?>
                  <tr>
                    <td class="text-center" ><?php echo $i+1; ?></td>
                    <td><?php echo $_POST['name_product'][$i]; ?></td>
                    <td class="text-center" ><?php echo $_POST['num_product'][$i]; ?> </td>
                    <td class="text-center" ><?php echo $_POST['price_product'][$i]; ?></td>
                    <td class="text-center" ><?php echo $total_price; ?></td>
                  </tr>
                  
                <?php
                    $total_all = $total_all+$total_price;
                  } 
                    $change = $money_receive-$total_all;
                ?> 
                  <tr>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th class="text-right" >เงินรวม</th>
                      <th class="text-center" ><?php echo $total_all; ?></th>
                  </tr>
                  <tr>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th class="text-right" >รับเงิน</th>
                      <td class="text-center" ><?php echo $money_receive; ?></td>
                  </tr> 
                  <tr>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th class="text-right" >เงินทอน</th>
                      <td class="text-center" ><?php echo $change; ?></td>
                  </tr>   
                </tbody>
              </table>
            </div>
            <p class="text-center">ลงชื่อ ........................................................................................ ผู้รับเงิน</p>
        </div>
      </section>
       <a type="button" href="../index.php" class="btn btn-block btn-default pull-right" style="width:100px;height:50">กลับหน้าหลัก</a>
  </div>
</body>
</html>
