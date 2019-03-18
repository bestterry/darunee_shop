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
                <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus-square"></i> ขายสินค้า </a></li>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/price_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> เลือกสินค้าที่ต้องการขาย </p></font>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                      <table class="table table-hover table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                                <th class="text-center" width="20%">เลือกสินค้า</th>
                                                <th class="text-center" width="35%">ชื่อสินค้า</th>
                                                <th class="text-center" width="15%">คงเหลือ</th>
                                                <th class="text-center" width="15%">หน่วยนับ</th>
                                                <?php
                                                 while($product = $query_product1 ->fetch_assoc()){
                                                ?>
                                            <tr>
                                                <td class="text-center" width="15%">
                                                 <input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>">
                                                </td>
                                                <td width="35%"><?php echo $product['name_product'];?></td>
                                                <td class="text-center" width="15%"><?php echo $product['num'];?></td>
                                                <td class="text-center" width="15%"><?php echo $product['unit'];?></td>
                                                <?php } ?>
                                                 <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
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
                <!-- /ขายสินค้า -->
                <!-- /ประวัติขายสินค้า -->
                <li><a target="_blank" href="manage_product/sale_history.php" ><i class="fa fa-exchange"></i> ยอดขายประจำวัน </a></li>
                <!-- /ประวัติขายสินค้า -->
                <!-- เบิกสินค้า -->
                <li><a href="#" data-toggle="modal" data-target="#myModal10"><i class="fa fa-archive"></i> เบิกสินค้า </a></li>
                <div class="modal fade" id="myModal10" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/draw_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> เลือกสินค้าที่ต้องการเบิก </p></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                      <table class="table table-hover table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                                <th class="text-center" width="20%">เลือกสินค้า</th>
                                                <th class="text-center" width="35%">ชื่อสินค้า</th>
                                                <th class="text-center" width="15%">คงเหลือ</th>
                                                <th class="text-center" width="15%">หน่วยนับ</th>
                                                <?php
                                                    while($product = $query_product2 ->fetch_assoc()){
                                                ?>
                                            <tr>
                                                <td class="text-center" width="15%"><input type="checkbox" name="menu[]" value="<?php echo $product['id_numproduct']; ?>"></td>
                                                <td  width="35%"><?php echo $product['name_product'];?></td>
                                                <td class="text-center" width="15%"><?php echo $product['num'];?></td>
                                                <td class="text-center" width="15%"><?php echo $product['unit'];?></td>
                                                <?php } ?>
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
                <!-- /เบิกสินค้า -->
                <!-- ประวัติเบิกสินค้า -->
                <li><a target="_blank" href="manage_product/draw_history.php" ><i class="fa fa-exchange"></i> ยอดเบิกสินค้าประจำวัน </a></li>
                <!-- /ประวัติเบิกสินค้า -->
                <!--รับเข้าสินค้า -->
                <li><a href="#" data-toggle="modal" data-target="#myModal11"><i class="fa fa-archive"></i> รับเข้าสินค้า </a></li>
                <div class="modal fade" id="myModal11" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/add_num_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> รับเข้าสินค้าจาก </p></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                  <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%">ชื่อผู้ส่งสินค้า
                                        </th>
                                        <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name ="id_member" class="form-control text-center select2" style="width: 100%;">
                                            <?php #endregion
                                            $sql_member = "SELECT * FROM member WHERE status = 'employee'";
                                            $objq_member = mysqli_query($conn,$sql_member);
                                            while($member = $objq_member -> fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $member['id_member']; ?>"><?php echo $member['name']; ?></option>
                                            <?php } ?>
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
                <!--ประวัติรับเข้าสินค้า -->
                <li><a target="_blank" href="manage_product/add_history.php" ><i class="fa fa-exchange"></i> ประวัติรับเข้าสินค้า </a></li>
                <!-- เเก้ไขอุปกรณ์  -->
                <!-- <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-cogs"></i> เเก้ไขรายการสินค้า</a></li>
                <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <font size="3"><B><i class="fa fa-cogs"></i> เเก้ไขรายการสินค้า </B></font>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                            <div class="modal-body">
                                <table class="table table-hover table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                      
                                        <th class="text-center" width="40%">ชื่อสินค้า</th>
                                        <th class="text-center" width="10%">เเก้ไข</th>
                                    </tr>
                                    <?php 
                                       while($edit = $query_product4 ->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td class="text-center" width="15%"><?php echo $edit['name_product'];?>(<font color="red"><?php echo $edit['unit']?></font>)</td>
                                        <td class="text-center"><a href="manage_product/edit_product.php?id_numproduct=<?php echo $edit['id_numproduct'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a></td>
                                       <?php } ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- //เเก้ไขอุปกรณ์  -->
                <!--เพิ่มรายการอุปกรณ์ -->
                <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-plus"></i>เพิ่มรายการสินค้าเข้าคลัง</a></li>
                <div class="modal fade" id="myModal3" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/insert_product.php" method="post" autocomplete="off">
                            <div class="col-md-10 modal-content">
                                <div class="modal-header">
                                    <font size="3"><B><i class="fa fa-plus"></i>เพิ่มรายการสินค้าเข้าคลัง</B></font>
                                </div>
                                <div class=" modal-body">
                                    <div class="form-group">
                                    <label>ชื่อสินค้า</label>
                                        <select name="id_product" class="form-control select2" style="width: 100%;">
                                        <?php 
                                            $SQL_product ="SELECT * FROM product";
                                            $objq_product = mysqli_query($conn,$SQL_product);
                                            while($list_product = $objq_product -> fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $list_product['id_product'];?>"><?php echo $list_product['name_product'].'  ('.$list_product['unit'].')'; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>จำนวน</label>
                                        <input type="text" name="num" class="form-control" placeholder="กรุณาระบุจำนวนสินค้า">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success pull-left" onclick="if(confirm('ยืนยันการบันทึก')) return true; else return false;"><i class="fa fa-toggle-right"> ถัดไป</i></button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <li><a href="login/logout.php" ><i class="fa fa-power-off"></i> ออกจากระบบ </a></li>
                <!--ประวัติเพิ่ม-ถอน อุปกรณ์ -->
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>