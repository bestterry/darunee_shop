<?php require "../config_database/config.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require('../font/font_style.php');?>
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
									<!-- iCheck -->
									<link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
										<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
										<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
										<!--[if lt IE 9]>
										<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
										<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
										<![endif]-->
										<!-- Google Font -->
										<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
										</head>
										<body class="hold-transition register-page">
											<div class="container">
												<div class="box box-primary">
													<div class="box-header with-border">
														<font size="4">
															<B> ประวัติการขายสินค้า ประจำวันที่(
																<font size="4" color="red">
																	<?php echo $strDate = date('d-m-Y');?>
																</font>) 
															</font>
														</B>
													</div>
													<!-- /.box-header -->
													<div class="box-body no-padding">
														<div class="mailbox-read-message">
															<table class="table table-hover table-striped table-bordered">
																<tbody>
																	<tr bgcolor="#99CCFF">
																		<th class="text-center" width="40%">รายการ</th>
																		<th class="text-center" width="20%">จำนวน</th>
																		<th class="text-center" width="20%">บ/หน่วย</th>
																		<th class="text-center" width="20%">เงินขาย</th>
																	</tr>
												<?php #endregion
                           $date = "SELECT * FROM sale_history
                                     WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND status_sale='sale'";
													 $objq = mysqli_query($conn,$date);
													 
													 while($value = $objq ->fetch_assoc()){
                             $id_sale = $value['id_sale_history'];
                             $SQL_product = "SELECT * FROM product INNER JOIN sale_history 
                             ON product.id_product = sale_history.id_product 
                             WHERE sale_history.id_sale_history='$id_sale'";
                             $objq_product = mysqli_query($conn,$SQL_product);
                             $objr_product = mysqli_fetch_array($objq_product);
                        ?>
																	<tr>
																		<td>
																			<?php echo $objr_product['name_product']; ?>
																		</td>
																		<td class="text-center">
																			<?php echo $objr_product['num_sale'];?>  (
																			<?php echo $objr_product['unit']; ?>)
																		</td>
																		<td class="text-center">
																			<?php echo $objr_product['price']/$objr_product['num_sale'];?>
																		</td>
																		<td class="text-center">
																			<?php echo $objr_product['price']; ?>
																		</td>
																	</tr>
														<?php
                              }
                            ?>
																</tbody>
															</table>
														</div>
														<!-- /.mailbox-read-message -->
														<div class="box-header with-border">
															<font size="4">
																<B> ยอดขายสินค้า ประจำวันที่(
																	<font size="4" color="red">
																		<?php echo $strDate = date('d-m-Y');?>
																	</font>) 
																</font>
															</B>
														</div>
														<!-- /.box-header -->
														<div class="box-body no-padding">
															<div class="mailbox-read-message">
																<table class="table table-hover table-striped table-bordered">
																	<tbody>
																		<tr bgcolor="#99CCFF">
																			<th class="text-center" width="40%">รายการ</th>
																			<th class="text-center" width="20%">จำนวน</th>
																			<th class="text-center" width="20%">จำนวนเงิน(บาท)</th>
																		</tr>
													<?php #endregion
														$sum_monny = 0;
                            $sql_history = "SELECT * FROM product";
                            $objq_history = mysqli_query($conn,$sql_history);
                            while($history = $objq_history ->fetch_assoc()){
                              $id_product = $history['id_product'];
                              $total_sale = "SELECT SUM(sale_history.num_sale),SUM(sale_history.price) FROM sale_history 
                                              INNER JOIN product ON sale_history.id_product=product.id_product
                                              WHERE product.id_product = '$id_product' AND DATE_FORMAT(sale_history.datetime,'%d-%m-%Y')='$strDate' AND sale_history.status_sale='sale'";
                              $objq_sale = mysqli_query($conn,$total_sale);
                              $objr_sale = mysqli_fetch_array($objq_sale);
                              $num_product = $objr_sale['SUM(sale_history.num_sale)'];
                              $total_money = $objr_sale['SUM(sale_history.price)'];
                              $sql_NameProduct = "SELECT * FROM product WHERE id_product = '$id_product'";
                              $objq_NameProduct = mysqli_query($conn,$sql_NameProduct);
                              $objr_NameProduct = mysqli_fetch_array($objq_NameProduct);
                              if(isset($num_product)){ 
                          ?>
																		<tr>
																			<td>
																				<?php echo $objr_NameProduct['name_product']; ?>
																			</td>
																			<td class="text-center">
																				<?php echo$num_product; ?>  (
																				<?php echo $objr_NameProduct['unit']; ?>)
																			</td>
																			<td class="text-center">
																				<?php echo $total_money; ?>
																			</td>
																		</tr>
																		<?php }
																$sum_monny = $sum_monny+$total_money;
                          } ?>
													 <tr>
                            <td style="visibility:collapse;"></td>
                            <th class="text-center">รวมเป็นเงินทั้งหมด</th>
                            <th class="text-center"><?php echo $sum_monny; ?></th>
                          </tr>
																	</tbody>
																</table>
															
															<div class="box-footer">
																<div class="col-md-4"></div>
																	<div class="col-md-4">
																		<div class="col-md-4"></div>
																		<div class="col-md-5">
																			<a type="button" href="../pdf_file/sale_history.php" class="btn btn-block btn-success" >
																				<i class="fa fa-print"> พิมพ์ </i>
																			</a>
																		</div>
																		<div class="col-md-3"></div>
																	</div>
																	<div class="col-md-4"></div>
																</div>
															</div>
														</div>
													</div>
													<!-- /.register-box -->
													<!-- jQuery 3 -->
													<script src="../bower_components/jquery/dist/jquery.min.js"></script>
													<!-- Bootstrap 3.3.7 -->
													<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
													<!-- iCheck -->
													<script src="../plugins/iCheck/icheck.min.js"></script>
													<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
												</body>
											</html>