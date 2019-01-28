<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ใบเสร็จซื้อสินค้า</title>
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
              <h3 class="page-header"> ทีมงานคุณดารุณี </h3>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="10%">ลำดับ</th>
                    <th class="text-center" width="40%">รายการ</th>
                    <th class="text-center" width="10%">จำนวน</th>
                    <th class="text-center" width="20%">ราคา/หน่วย</th>
                    <th class="text-center" width="20%">รวมเป็นเงิน(บาท)</th>
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
                    <td class="text-center" ><?php echo $_POST['name_product'][$i]; ?></td>
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
                      <th class="text-center" >รวมเป็นเงิน</th>
                      <th class="text-center" ><?php echo $total_all; ?></th>
                  </tr>
                  <tr>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th class="text-center" >เงินที่รับมา</th>
                      <th class="text-center" ><?php echo $money_receive; ?></th>
                  </tr> 
                  <tr>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th style="visibility:collapse;" ></th>
                      <th class="text-center" >เงินทอน</th>
                      <th class="text-center" ><?php echo $change; ?></th>
                  </tr>   
                </tbody>
              </table>
            </div>
        </div>
      </section>
  </div>
</body>
</html>
