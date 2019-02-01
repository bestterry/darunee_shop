<div class="row">
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font size="3"><B>เมนูจัดการสินค้า</B></font>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
            <li><a href="index.php"><i class="fa fa-home"></i> สินค้าคงเหลือ </a></li>
                <!-- ขายสินค้า -->
                <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus-square"></i> ขายสินค้า </a></li>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="manage_product/price_product.php" method="post">
                            <div class="modal-content">
                                <div class="col-md-3"></div>
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> เลือกสินค้าที่ต้องการขาย </p></font>
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
                                                <?php
                                                foreach($query_product as $product):
                                              ?>
                                            <tr>
                                                <td class="text-center" width="15%"><input type="checkbox" name="menu[]" value="<?php echo $product['id_product']; ?>"></td>
                                                <td  width="35%"><?php echo $product['name_product'];?></td>
                                                <td class="text-center" width="15%"><?php echo $product['num_product'];?></td>
                                                <td class="text-center" width="15%"><?php echo $product['unit'];?></td>
                                                <?php endforeach; ?>
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
                </div>
                <!-- ถอนอุปกรณ์ -->
                <!--เพิ่มจำนวนอุปกรณ์ -->
                <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus-square"></i> เพิ่มจำนวนสินค้า</a></li>
                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <font size="6"><p align = "center"> เลือกรายการที่ต้องการเพิ่มจำนวน </p></font>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover table-striped table-bordered">
                                    <tbody>
                                        <th class="text-center" width="50%">ชื่อสินค้า</th>
                                        <th class="text-center" width="20%">จำนวนที่มีอยู่</th>
                                        <th class="text-center" width="20%">หน่วยนับ</th>
                                        <th class="text-center" width="10%">เพิ่มจำนวน</th>
                                    <tr>
                                        <?php foreach($query_product as $addproduct):?>
                                    <tr>
                                        <td class="text-center" width="50%"><?php echo $addproduct['name_product']; ?></td>
                                        <td class="text-center" width="20%"><?php echo $addproduct['num_product']; ?></td>
                                        <td class="text-center" width="20%"><?php echo $addproduct['unit']; ?></td>
                                        <td class="text-center" ><a href="manage_product/add_num_product.php?id_product=<?php echo $addproduct['id_product']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span></a></td>
                                    </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> ปิด</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--เพิ่มจำนวนอุปกรณ์ -->
                <!-- เเก้ไขอุปกรณ์  -->
                <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-cogs"></i> เเก้ไขรายการสินค้า</a></li>
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
                                        foreach($query_product as $edit):
                                    ?>
                                    <tr>
                                        <td class="text-center" width="15%"><?php echo $edit['name_product'];?>(<font color="red"><?php echo $edit['unit']?></font>)</td>
                                        <td class="text-center"><a href="manage_product/edit_product.php?id_product=<?php echo $edit['id_product'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a></td>
                                    <?php endforeach;?>
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
                </div>
                <!-- //เเก้ไขอุปกรณ์  -->
                <!--เพิ่มรายการอุปกรณ์ -->
                <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-plus"></i>เพิ่มรายการสินค้าเข้าคลัง</a></li>
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
                <!--เพิ่มรายการอุปกรณ์ -->
                <!--ประวัติเพิ่ม-ถอน อุปกรณ์ -->
                <li><a target="_blank" href="manage_product/sale_history.php" ><i class="fa fa-exchange"></i> ยอดขายประจำวัน </a></li>
                <!--ประวัติเพิ่ม-ถอน อุปกรณ์ -->
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>