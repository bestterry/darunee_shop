<div class="row">
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font size="3"><B>เมนูหลัก</B></font>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked" ata-widget="tree">

                <!-- เพิ่มรายการสั่งสินค้า -->
                <li><a href="add_order.php" ><i class="fa fa-home"></i> เพิ่ม ORDER ใหม่ </a></li>
                <!-- /เพิ่มรายการสั่งสินค้า -->

                <!-- ORDER ค้างส่ง -->
                <li><a href="list_order.php" ><i class="fa fa-truck"></i> ORDER ค้างส่ง </a></li>
                <!-- /ORDER ค้างส่ง -->

                <!-- ค้นหา ORDER -->
                <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-archive"></i> ค้นหา ORDER </a></li>
                <div class="modal fade" id="myModal2" role="dialog">
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

                <!-- รายการรวมสต๊อกค้างส่ง -->
                <li><a href="total_order.php" ><i class="fa fa-shopping-cart"></i> จำนวนค้างส่ง </a></li>
                <!-- /รายการรวมสต๊อกค้างส่ง -->

                
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>