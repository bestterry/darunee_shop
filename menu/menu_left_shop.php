<div class="row">
  <div class="col-md-3">
    <div class="box box-solid">
      <div class="box-header with-border">
        <font size="3"><B>เมนูจัดการสินค้า</B></font>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li><a href="product.php"><i class="fa fa-home"></i> สินค้าคงเหลือ </a></li>
          <!-- ขายสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus-square"></i> ขายสินค้า </a>
          </li>
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
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">ชื่อสินค้า</th>
                            <th class="text-center" width="15%">หน่วยนับ</th>
                            <th class="text-center" width="15%">คงเหลือ</th>

                            <?php
                            while ($product = $query_product1->fetch_assoc()) {
                              ?>
                            <tr>
                              <td class="text-center" width="15%">
                                <input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>">
                              </td>
                              <td width="35%"><?php echo $product['name_product']; ?></td>
                              <td class="text-center" width="15%"><?php echo $product['unit']; ?></td>
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
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close">
                        ปิดหน้าต่างนี้</i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /ขายสินค้า -->
          <!-- เบิกสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal10"><i class="fa fa-cloud-upload"></i> เบิกสินค้า
            </a></li>
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
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">ชื่อสินค้า</th>
                            <th class="text-center" width="15%">คงเหลือ</th>

                            <?php
                            while ($product = $query_product2->fetch_assoc()) {
                              ?>
                            <tr>
                              <td class="text-center" width="15%"><input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>"></td>
                              <td width="35%"><?php echo $product['name_product'] . ' (' . $product['unit'] . ')'; ?></td>
                              <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                            <?php } ?>
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
          <!-- /เบิกสินค้า -->
          <!--รับเข้าสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal11"><i class="fa fa-cloud-download"></i>
              รับเข้าสินค้า </a></li>
          <div class="modal fade" id="myModal11" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/add_num_product.php" method="post">
                <div class="modal-content">
                  <div class="modal-header texr-center">
                    <font size="5">
                      <B align="center"> รับเข้าสินค้าจาก </B>
                    </font>
                  </div>
                  <div class="modal-body col-md-12 table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-bordered table-hover">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%">ชื่อผู้ส่งสินค้า
                            </th>
                            <th bgcolor="#99CCFF" class="text-center" width="70%">
                              <select name="id_member" class="form-control text-center select2" style="width: 100%;">
                                <?php #endregion
                                $sql_member = "SELECT * FROM member WHERE status = 'employee'";
                                $objq_member = mysqli_query($conn, $sql_member);
                                while ($member = $objq_member->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $member['id_member']; ?>"><?php echo $member['name']; ?>
                                  </option>
                                <?php } ?>
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
          <!-- /ประวัติขายสินค้า -->
          <li><a href="manage_product/sale_history.php"><i class="fa fa-exchange"></i> ยอดขายประจำวัน</a></li>
          <!-- /ประวัติขายสินค้า -->
          <!-- ประวัติเบิกสินค้า -->
          <li><a href="manage_product/draw_history.php"><i class="fa fa-exchange"></i> ยอดเบิกสินค้าประจำวัน </a></li>
          <!-- /ประวัติเบิกสินค้า -->
          <!--ประวัติรับเข้าสินค้า -->
          <li><a href="manage_product/add_history.php"><i class="fa fa-exchange"></i> ประวัติรับเข้าสินค้า </a></li>
          <!-- เเก้ไขอุปกรณ์  -->
          <!--เพิ่มรายการอุปกรณ์ -->
          <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-cog"></i>แก้ไขจำนวนสินค้า</a></li>
          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="manage_product/insert_product.php" method="post" autocomplete="off">
                <div class="col-md-10 modal-content">
                  <div class="modal-header text-center">
                    <font size="5"><B><i class="fa fa-cog"></i>แก้ไขจำนวนสินค้า</B></font>
                  </div>
                  <div class=" modal-body">
                    <div class="form-group">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center" width="40%">รายการ</th>
                            <th class="text-center" width="20%">จำนวน</th>
                            <th class="text-center" width="20%">แก้ไข</th>
                          </tr>
                          <?php #endregion
                          $test = "SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product
                                  WHERE num_product.id_zone = $id_zone";
                          $vv = mysqli_query($conn, $test);
                          while ($history = $vv->fetch_assoc()) {
                            ?>
                            <tr>
                              <td>
                                <?php echo $history['name_product'].' ('.$history['unit'].')'; ?>
                              </td>
                              <td class="text-center">
                                <?php echo $history['num']; ?>
                              </td>
                              <td class="text-center">
                                <a href="manage_product/edit_product.php?id_numproduct=<?php echo $history['id_numproduct'];?>" type="button" class="btn btn-success"><i class="fa fa-cog"></i></a>
                              </td>
                            </tr>
                          <?php
                        } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <li><a href="login/logout.php"><i class="fa fa-power-off">  </i> ออกจากระบบ </a></li>
          <!--ประวัติเพิ่ม-ถอน อุปกรณ์ -->
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>