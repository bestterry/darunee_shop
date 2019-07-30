<div class="row">
  <div class="col-md-3">
    <div class="box box-solid">
      <div class="box-header with-border">
        <font size="3"><B>เมนูหน่วยรถ</B></font>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <!-- ขายสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus-square"></i> ขายสินค้า </a>
          </li>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="sale_product.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5"><B> เลือกสินค้าที่ต้องการขาย </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">สินค้า_หน่วย</th>
                            <th class="text-center" width="15%">คงเหลือ</th>
                          <tr>
                            <?php while($product = $query_product2 ->fetch_assoc()){ ?>
                            <td class="text-center" width="15%">
                              <input type="checkbox" name="id_numPD[]" value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">
                        ปิดหน้าต่างนี้</i></button>
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /ขายสินค้า -->

          <!-- /สินค้าคงเหลือ -->
          <li><a href="total_store.php"><i class="fa fa-home"></i> สต๊อกหน่วยรถ </a></li>
          <!-- /สินค้าคงเหลือ -->

          <!-- ประวัติขายสินค้า -->
          <li><a href="sale_product_history.php"><i class="fa fa-exchange"></i> ข้อมูลการขาย </a></li>
          <!-- โอนสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-inbox"></i> โอนสินค้าระหว่างรถ </a></li>
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="transfer_product.php" method="post">
                <div class="modal-content text-center">
                  <div class="modal-header">
                    <font size="5"><B align="center"> เลือกสินค้าที่ต้องการโอน </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr class="info">
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">สินค้า_หน่วย</th>
                            <th class="text-center" width="15%">คงเหลือ</th>
                          <tr>
                            <?php while($product = $query_product1 ->fetch_assoc()){ ?>
                            <td class="text-center" >
                              <input type="checkbox" name="id_numPD[]" value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td ><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" ><?php echo $product['num']; ?></td>
                          </tr>
                          <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">
                        ปิดหน้าต่างนี้</i></button>
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /โอนสินค้า -->
          
          <!-- แยกสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-inbox"></i> แกะกล่องสินค้า </a></li>
          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="sr_product.php" method="post">
                <div class="modal-content text-center">
                  <div class="modal-header">
                    <font size="5"><B align="center"> เลือกสินค้าที่ต้องการแกะกล่อง </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">สินค้า_หน่วย</th>
                            <th class="text-center" width="20%">จำนวนคงเหลือ</th>
                          <tr>
                            <?php 
                                                $sr_product = "SELECT * FROM product INNER JOIN numpd_car ON product.id_product = numpd_car.id_product WHERE numpd_car.id_member = $id_member";
                                                $sql_sr_product = mysqli_query($mysqli,$sr_product);
                                                while($product = $sql_sr_product ->fetch_assoc()){
                                                    $id_product = $product['id_product'];
                                                    if($id_product==1){ 
                                            ?>
                            <td class="text-center" >
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td ><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" ><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==3) { 
                                            ?>
                          <tr>
                            <td class="text-center" >
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td ><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" ><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==5) { 
                                            ?>
                          <tr>
                            <td class="text-center">
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" ><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==9) { 
                                            ?>
                          <tr>
                            <td class="text-center" >
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" ><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==32) { 
                                            ?>
                          <tr>
                            <td class="text-center" >
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td ><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" ><?php echo $product['num']; ?></td>
                          </tr>
                          <?php            
                                                    }else{

                                                    }
                                                }
                                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">
                        ปิดหน้าต่างนี้</i></button>
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /แยกสินค้า -->

          <!-- สถานที่ทำงาน -->
          <li><a href="#" data-toggle="modal" data-target="#working"><i class="fa fa-users"></i> ข้อมูลทำงาน </a></li>
          <div class="modal fade" id="working" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="working.php" method="post">
                <div class="modal-content text-center">
                  <div class="modal-header">
                    <font size="5"><B align="center"> ข้อมูลทำงาน </B></font>
                  </div>
                  <br>
                  <div class="col-md-12">
                    <div class="col-md-6">  
                        <table class="table table-bordered ">
                          <tbody>
                              <tr>
                              <th class="text-center" width="30%"><font size="3">เดือน :</font></th>
                              <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                              <select name ="month" style="width: 100%;">
                              <option selected="selected" value="01">มกราคม</option>
                                    <option value="02">กุมภาพันธ์</option>
                                    <option value="03">มีนาคม</option>
                                    <option value="04">เมษายน</option>
                                    <option value="05">พฤษภาคม</option>
                                    <option value="06">มิถุนายน</option>
                                    <option value="07">กฤกฏาคม</option>
                                    <option value="08">สิงหาคม</option>
                                    <option value="09">กันยายน</option>
                                    <option value="10">ตุลาคม</option>
                                    <option value="11">พฤศจิกายน</option>
                                    <option value="12">ธันวาคม</option>
                              </select>
                              </th>
                              </tr>
                          </tbody>
                        </table> 
                      </div>
                        <!-- /.form-group -->

                        <div class="col-md-6">  
                          <table class="table table-bordered ">
                            <tbody>
                                <tr>
                                <th class="text-center" width="30%"><font size="3">ปี :</font></th>
                                <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                <select name ="year" style="width: 100%;">
                                      <option selected="selected" value="2019">2562</option>
                                      <option value="2020">2563</option>
                                      <option value="2021">2564</option>
                                      <option value="2022">2565</option>
                                      <option value="2023">2566</option>
                                </select>
                                </th>
                                </tr>
                            </tbody>
                          </table> 
                        </div>
                        <!-- /.form-group -->
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">ปิดหน้าต่างนี้</i></button>
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /สถานที่ทำงาน -->

          <!-- /สต๊อกรถ -->
          <li><a href="car_stock.php"><i class="fa fa-truck"></i> สต๊อกรถ </a></li>
          <!-- /สต๊อกรถ -->

          <!-- /สต๊อกรถ -->
          <li><a href="total_stock.php"><i class="fa fa-dropbox"></i> สต๊อกรวม </a></li>
          <!-- /สต๊อกรถ -->
          
          <!-- รายการรวมสต๊อกค้างส่ง -->
          <li><a href="sent_order.php" ><i class="fa fa-shopping-cart"></i> ORDER หน่วยรถ </a></li>
          <!-- /รายการรวมสต๊อกค้างส่ง -->

         <!-- ค้นหา ORDER -->
         <li><a href="#" data-toggle="modal" data-target="#seachorder"><i class="fa fa-archive"></i> ค้นหา ORDER </a></li>
          <div class="modal fade" id="seachorder" role="dialog">
              <div class="modal-dialog modal-lg">
                  <form action="../pdf_file/list_order3.php" method="post">
                      <div class="modal-content">
                          <div class="modal-header text-center">
                              <font size="5"><B> ค้นหา ORDER </B></font>
                          </div>
                          <div class="modal-body col-md-12 table-responsive mailbox-messages">
                            <div class="table-responsive mailbox-messages">

                              <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                  <th class="text-center" width="30%"><font size="5">จังหวัด</font></th>
                                  <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                  <select name="province_name" data-where="2" class="form-control ajax_address select2" style="width: 100%;">
                                      <option value="">-- เลือกจังหวัด --</option>
                                  </select>
                                  </th>
                                  </tr>
                              </tbody>
                              </table> 
                              <br> 

                            <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                  <th class="text-center" width="30%"><font size="5">อำเภอ</font></th>
                                  <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                  <select name="amphur_name" data-where="3" class="form-control ajax_address select2" style="width: 100%;">
                                      <option value="">-- เลือกอำเภอ --</option>
                                  </select>
                                  </th>
                                  </tr>
                              </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit"  class="btn btn-success pull-right">ถัดไป ==>></button>
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
          <!-- ค้นหา ORDER -->
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>