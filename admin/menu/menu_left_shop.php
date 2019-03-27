<div class="row">
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font size="3"><B>เมนูจัดการสินค้า</B></font>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked" ata-widget="tree">
                <!-- ประวัติขายสินค้า -->
                <li><a href="sale_history.php" ><i class="fa fa-exchange"></i> ยอดขายสินค้า </a></li>
                 <!--โอนสินค้า -->
                 <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-archive"></i> โอนสินค้า </a></li>
                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="withdraw_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> โอนสินค้า </p></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                    <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%">สต๊อกสินค้า
                                        </th>
                                        <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                            <?php #endregion
                                            $sql_member = "SELECT * FROM zone ";
                                            $objq_member = mysqli_query($conn,$sql_member);
                                            while($member = $objq_member -> fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </th>
                                        </tr>
                                    </tbody>
                                    </table> 
                                    <br> 

                                  <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%">ชื่อผู้รับสินค้า
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
                <!--//รับเข้าสินค้า -->

                 <!--โอนสินค้า -->
                 <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-archive"></i> รับเข้าสินค้า </a></li>
                <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="add_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> รับเข้าสินค้า </p></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">

                                    <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%">สต๊อกสินค้า
                                        </th>
                                        <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                            <?php #endregion
                                            $sql_member = "SELECT * FROM zone ";
                                            $objq_member = mysqli_query($conn,$sql_member);
                                            while($member = $objq_member -> fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </th>
                                        </tr>
                                    </tbody>
                                    </table> 
                                    <br> 

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
                <!--//รับเข้าสินค้า -->

                <!--ประวัติรับเข้าสินค้า -->
                <li><a href="total_stock.php" ><i class="fa fa-home"></i> สต๊อกรวม </a></li>
                <li><a href="car_stock.php" ><i class="fa fa-truck"></i> สต๊อกรถ </a></li>
                <li><a href="add_user.php" ><i class="fa fa-user"></i> เพิ่มพนักงาน </a></li>
                <!-- เพิ่มสินค้าเข้าสต๊อก -->
                <li><a href="#" data-toggle="modal" data-target="#myModal10"><i class="fa fa-archive"></i>เพิ่มสินค้าเข้าสต๊อก</a></li>
                <div class="modal fade" id="myModal10" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="add_num_product.php" method="post">
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
                                                <th class="text-center" width="15%">หน่วยนับ</th>
                                                <?php
                                                $sql_product = "SELECT * FROM product";
                                                $query_product = mysqli_query($conn,$sql_product);
                                                    while($product = $query_product ->fetch_assoc()){
                                                ?>
                                            <tr>
                                                <td class="text-center" width="15%"><input type="checkbox" name="id_product[]" value="<?php echo $product['id_product']; ?>"></td>
                                                <td  width="35%"><?php echo $product['name_product'];?></td>
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
                <!-- /เพิ่มสินค้าเข้าสต๊อก -->
                <li><a href="withdraw_history.php"><i class="fa fa-archive"></i> ประวัติการโอนสินค้า </a></li>
                <li><a href="add_history.php"><i class="fa fa-archive"></i> ประวัติการรับเข้าสินค้า </a></li>
                <li><a href="add_data.php" ><i class="fa fa-user"></i> เพิ่มข้อมูล </a></li>
                <li><a href="../login/logout.php" ><i class="fa fa-close"></i> ออกจากระบบ </a></li>
                
                <!-- /ประวัติขายสินค้า -->
                <!-- เบิกสินค้า -->
                <!-- <li><a href="#" data-toggle="modal" data-target="#myModal10"><i class="fa fa-archive"></i> เบิกสินค้า </a></li>
                <div class="modal fade" id="myModal10" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/draw_product.php" method="post">
                            <div class="modal-content">
                                <div class="col-md-3"></div>
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> เลือกสินค้าที่ต้องการเบิก </p></font>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="modal-body col-md-8 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                      <table class="table table-hover table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                            <th class="text-center" width="20%">เลือกสินค้า</th>
                                            <th class="text-center" width="35%">ชื่อสินค้า</th>
                                            <th class="text-center" width="15%">คงเหลือ</th>
                                            <th class="text-center" width="15%">หน่วยนับ</th>
                                          <tr>
                                            <td class="text-center" width="15%"><input type="checkbox" name="menu[]" value=""></td>
                                            <td  width="35%"></td>
                                            <td class="text-center" width="15%"></td>
                                            <td class="text-center" width="15%"></td> 
                                          </tr>
                                        </tbody>
                                      </table>
                                  </div>
                                  <button type="submit"  class="btn btn-success pull-left">ถัดไป ==>></button>
                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <!-- /เบิกสินค้า -->
                <!-- ประวัติเบิกสินค้า
                <li><a target="_blank" href="manage_product/draw_history.php" ><i class="fa fa-exchange"></i> ยอดเบิกสินค้าประจำวัน </a></li> -->
                <!-- /ประวัติเบิกสินค้า -->
                <!--เพิ่มจำนวนสินค้า -->
                <!-- <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus-square"></i> รับเข้าสินค้า</a></li>
                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <font size="6"><p align = "center"> เลือกรายการ </p></font>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover table-striped table-bordered">
                                    <tbody>
                                        <th class="text-center" width="50%">ชื่อสินค้า</th>
                                        <th class="text-center" width="20%">จำนวนที่มีอยู่</th>
                                        <th class="text-center" width="20%">หน่วยนับ</th>
                                        <th class="text-center" width="10%">เพิ่มจำนวน</th>
                                    <tr>
                                    <tr>
                                        <td class="text-center" width="50%"></td>
                                        <td class="text-center" width="20%"></td>
                                        <td class="text-center" width="20%"></td>
                                        <td class="text-center" ><a href="manage_product/add_num_product.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> ปิด</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <--เพิ่มจำนวนอุปกรณ์ -->
                <!-- <li><a target="_blank" href="manage_product/add_history.php" ><i class="fa fa-exchange"></i> ประวัติรับเข้าสินค้า </a></li> --> 
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
                                    <tr>
                                        <td class="text-center" width="15%"></td>
                                        <td class="text-center"><a href="manage_product/edit_product.php" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a></td>                                      
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
                <!-- <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-plus"></i>เพิ่มรายการสินค้าเข้าคลัง</a></li>
                <div class="modal fade" id="myModal3" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/insert_product.php" method="post" autocomplete="off">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <font size="3"><B><i class="fa fa-plus"></i>เพิ่มรายการสินค้าเข้าคลัง</B></font>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="txtname_tool">ชื่อสินค้า</label>
                                        <input type="text" name="name_product" class="form-control" id="txtuserid" placeholder="กรุณาระบุชื่อสินค้า" >
                                    </div>
                                    <div class="form-group">
                                        <label for="txtnum">จำนวน</label>
                                        <input type="text" name="num_product" class="form-control" id="txtname" placeholder="กรุณาระบุจำนวนสินค้า">
                                    </div>
                                    <div class="form-group">
                                        <label for="unit">หน่วยนับ</label>
                                        <input type="text" name="unit" class="form-control" id="unit" placeholder="กรุณาระบุหน่วยนับ">
                                    </div>
                                    <div class="form-group">
                                        <label>ประเภท</label>
                                        <select name="status" class="form-control select2" style="width: 100%;">
                                            <option value="health">เพื่อสุขภาพ</option>
                                            <option value="farm">การเกษตร</option>
                                        </select>
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
                <li><a href="../login/logout.php" ><i class="fa fa-power-off"></i> ออกจากระบบ </a></li> -->
                <!--ประวัติเพิ่ม-ถอน อุปกรณ์ -->
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>