<div class="row">
  <div class="col-md-3">
    <div class="box box-solid">
      <div class="box-header with-border">
        <font size="3"><B>เมนูหน้าร้าน</B></font>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">

          <!-- ขายสินค้า ลูกค้า-->
          <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus-square"></i> ขายสินค้า </a></li>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/price_product.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5">
                      <B> เลือกสินค้าที่ต้องการขาย </B>
                    </font>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="modal-body col-md-12 table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped ">
                        <tbody>
                          <tr>
                            <th bgcolor="#99CCFF" class="text-center" width="20%">เลือก</th>
                            <th bgcolor="#99CCFF" class="text-center" width="35%">สินค้า_หน่วย</th>
                            <th bgcolor="#99CCFF" class="text-center" width="15%">คงเหลือ</th>

                            <?php
                              while ($product = $query_product6->fetch_assoc()) {
                            ?>
                            
                            <tr>
                              <td class="text-center" width="15%">
                                <input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>">
                              </td>
                              <td width="35%"><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                              <td class="text-center" width="15%"><?php echo $product['num']; ?></td>

                            <?php } ?>
                            <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">ปิดหน้าต่างนี้</i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /ขายสินค้า ลูกค้า-->

          <!-- ขายสินค้า นอกเขต-->
          <li><a href="#" data-toggle="modal" data-target="#outside"><i class="fa fa-minus-square"></i> ขายสินค้า (<font color='red'>นอกเขต</font>)</a></li>
          <div class="modal fade" id="outside" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/outside_price.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5">
                      <B> เลือกสินค้าที่ต้องการขาย (นอกเขต)</B>
                    </font>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="modal-body col-md-12 table-responsive mailbox-messages">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th bgcolor="#99CCFF" class="text-center" width="20%">เลือก</th>
                            <th bgcolor="#99CCFF" class="text-center" width="35%">สินค้า_หน่วย</th>
                            <th bgcolor="#99CCFF" class="text-center" width="15%">คงเหลือ</th>

                            <?php
                              while ($product = $query_product1->fetch_assoc()) {
                            ?>
                            
                            <tr>
                              <td class="text-center" width="15%">
                                <input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>">
                              </td>
                              <td width="35%"><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                              <td class="text-center" width="15%"><?php echo $product['num']; ?></td>

                            <?php } ?>
                            <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">ปิดหน้าต่างนี้</i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /ขายสินค้า นอกเขต-->

          <!-- /ประวัติขายสินค้า -->
          <li><a href="manage_product/sale_history.php"><i class="fa fa-exchange"></i>รายการขาย</a></li>
          <!-- /ประวัติขายสินค้า -->

          <!-- เบิกสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal10"><i class="fa fa-cloud-upload"></i> เบิกออก </a></li>
          <div class="modal fade" id="myModal10" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/draw_product.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5">
                      <B align="center"> เลือกสินค้าที่ต้องการเบิก </B>
                    </font>
                  </div>
                  <div class="modal-body col-md-12 table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือก</th>
                            <th class="text-center" width="35%">สินค้า_หน่วย</th>
                            <th class="text-center" width="15%"> คงเหลือ </th>

                            <?php
                            while ($product = $query_product2->fetch_assoc()) {
                              ?>
                            <tr>
                              <td class="text-center" width="15%"><input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>"></td>
                              <td width="35%"><?php echo $product['name_product'] . '_' . $product['unit']; ?></td>
                              <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                            <?php } ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">ปิดหน้าต่างนี้</i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /เบิกสินค้า -->

          <!--รับเข้าสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal11"><i class="fa fa-cloud-download"></i> รับเข้า </a></li>
          <div class="modal fade" id="myModal11" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/add_num_product.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5">
                      <B align="center"> รับเข้า </B>
                    </font>
                  </div>
                  <div class="modal-body col-md-12 table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-bordered table-hover">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"> <font size="5">ผู้ส่งสินค้า : </font>
                            </th>
                            <th bgcolor="#99CCFF" class="text-center" width="70%">
                              <select name="id_member" class="form-control text-center select2" style="width: 100%;">
                                <?php #endregion
                                $sql_member = "SELECT * FROM member WHERE status = 'employee'";
                                $objq_member = mysqli_query($conn, $sql_member);
                                while ($member = $objq_member->fetch_assoc()) {
                                  $id_member = $member['id_member'];
                                  if ($id_member == 19) {
                                    
                                  }else {
                                  ?>
                                  <option value="<?php echo $id_member; ?>"><?php echo $member['name']; ?>
                                  </option>
                                <?php 
                                      } 
                                  }
                                ?>
                              </select>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">ถัดไป ==>></button>
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">
                        ปิดหน้าต่างนี้</i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--//รับเข้าสินค้า -->

           <!-- แยกสินค้า -->
           <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-inbox"></i> แกะกล่องสินค้า </a></li>
          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/sr_product.php" method="post">
                <div class="modal-content text-center">
                  <div class="modal-header">
                    <font size="5"><B align="center"> เลือกสินค้าที่ต้องการแกะกล่อง </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">สินค้า</th>
                            <th class="text-center" width="15%">คงเหลือ</th>
                          <tr>
                            <?php 
                                                $sr_product = "SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product WHERE num_product.id_zone= $id_zone";
                                                $sql_sr_product = mysqli_query($conn,$sr_product);
                                                while($product = $sql_sr_product ->fetch_assoc()){
                                                    $id_product = $product['id_product'];
                                                    if($id_product==1){ 
                                            ?>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numproduct" value="<?php echo $product['id_numproduct']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==3) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numproduct"
                                value="<?php echo $product['id_numproduct']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==5) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numproduct"
                                value="<?php echo $product['id_numproduct']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==9) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numproduct"
                                value="<?php echo $product['id_numproduct']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==32) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numproduct"
                                value="<?php echo $product['id_numproduct']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
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

          <!-- ประวัติเบิกสินค้า -->
          <li><a href="manage_product/draw_history.php"><i class="fa fa-cloud-upload"></i> รายการเบิก </a></li>
          <!-- /ประวัติเบิกสินค้า -->
          <!--ประวัติรับเข้าสินค้า -->
          <li><a href="manage_product/add_history.php"><i class="fa fa-cloud-download"></i> รายการรับ </a></li>
          <!-- ประวัติรับเข้าสินค้า  -->
          <!-- สต๊อกรถ -->
          <li><a href="pdf_file/list_order.php" ><i class="fa fa-truck"></i> ออร์เดอร์ค้างส่ง </a></li>
          <!-- /สต๊อกรถ -->
                   <!-- ค้นหา ORDER -->
         <li><a href="#" data-toggle="modal" data-target="#seachorder"><i class="fa fa-archive"></i> ค้นหา ORDER </a></li>
          <div class="modal fade" id="seachorder" role="dialog">
              <div class="modal-dialog modal-lg">
                  <form action="pdf_file/list_order3.php" method="post">
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
          <!-- รายการรวมสต๊อกค้างส่ง -->
          <li><a href="manage_product/total_order.php" ><i class="fa fa-shopping-cart"></i> จำนวนออร์เดอร์ค้างส่ง </a></li>
          <!-- /รายการรวมสต๊อกค้างส่ง -->


        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>