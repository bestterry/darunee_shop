<?php 
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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ทีมงานคุณดารุณี</title>
    <link rel="icon" type="image/png" href="../images/favicon.ico"/>
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
    <style type='text/css'>
      th {
          height: 50px;
          padding-left: 12px;
          padding-right: 12px;  
          text-align: left;
          border-left: 1px solid #f4f4f4;
          border-bottom: solid 2px #fff;
          color: #333;
        }
    </style>
</head>
<body onload="window.print();">

  <div class="wrapper">
      <section class="invoice">
          <div class="row">
            <div class="col-xs-12">
            <a type="button" class="btn btn-block btn-info pull-right" href="../product.php" style="width:100px;height:50"><<=กลับ</a>
            <br>
              <h5 class="text-center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใบเสร็จรับเงิน </h5>
              <h3 class="page-header text-center"> ทีมงานคุณดารุณี </h3>
              <p class="text-center" size="5">เลขที่ 31/1 หมู่ 12 ตำบลสันสลี อำเภอเวียงป่าเป้า จังหวัดเชียงราย 57170  โทร 081-916-9852</p>
              <br>
              <br>
              <p class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ <?php echo DateThai($strDate); ?></p>
              <br>
              <p>ผู้ซื้อ/ที่อยู่................................................................................................................................................................</p>
              <p>.................................................................................................................................................................................</p>
              <br>
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
                    <th class="text-center" width="10%">หน่วย</th>
                    <th class="text-center" width="15%">ราคาต่อหน่วย</th>
                    <th class="text-center" width="15%">รวมเงิน (บาท)</th>
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
                    <td class="text-center" ><?php echo $_POST['unit'][$i]; ?> </td>
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
                      <th style="visibility:collapse;" ></th>
                      <th class="text-right" >เงินรวม</th>
                      <th class="text-center" ><?php echo $total_all; ?></th>
                  </tr>
                  <tr>
                      <th style="visibility:collapse;" ></th>
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
                      <th style="visibility:collapse;" ></th>
                      <th class="text-right" >เงินทอน</th>
                      <td class="text-center" ><?php echo $change; ?></td>
                  </tr>   
                </tbody>
              </table>
              <br>
            <br>
            </div>
            <p class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ ............................................................... ผู้รับเงิน</p>
            <p class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( _____________________________________ )</p>
        </div>
      </section>
  </div>
</body>
</html>
