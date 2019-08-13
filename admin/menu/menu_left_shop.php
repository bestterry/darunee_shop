<div class="row">
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font size="3"><B>เมนูหลัก</B></font>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked" ata-widget="tree">

                <!-- สต๊อกรวม -->
                <li><a href="total_stock.php" ><i class="fa fa-home"></i> สต๊อกร้าน </a></li>
                <!-- /สต๊อกรวม -->

                <!-- สต๊อกรถ -->
                <li><a href="car_stock.php" ><i class="fa fa-truck"></i> สต๊อกรถ </a></li>
                <!-- /สต๊อกรถ -->

                <!-- ยอดขาย -->
                <li><a href="sale_history.php" ><i class="fa fa-exchange"></i> ยอดขาย </a></li>
                <!-- /ยอดขาย -->

                <!-- ยอดขาย -->
                <li><a href="total_soft.php" ><i class="fa fa-exchange"></i> ยอดขาย sHD </a></li>
                <!-- /ยอดขาย -->

                <!--เงินสะสม -->
                <li><a href="#" data-toggle="modal" data-target="#cu"><i class="fa fa-money"></i> เงินขาย </a></li>
                <div class="modal fade" id="cu" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="cu_sale.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B> เงินสะขายสม </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <strong><i class="fa fa-file-text-o margin-r-6"></i> การใช้ </strong>
                                            <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบข้อมูลเงินขายสะสม</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ตั้งเเต่ : </label>
                                            <input type="date" name="aday">
                                        </div>
                                        <div class="form-group">
                                            <label>ถึง &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            <input type="date" name="bday">
                                        </div>
                                    </div>
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
                <!--//เงินสะสม -->

                 <!-- กำไรขาย -->
                 <li><a href="profit.php"><i class="fa fa-money"></i> กำไรขาย </a></li>
                <!-- /กำไรขาย -->

                <!--รับเข้า -->
                <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-archive"></i> รับเข้า </a></li>
                <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="add_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B> รับเข้า </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">

                                    <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">สต๊อก</font></th>
                                        <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                            <?php #endregion
                                            $sql_member = "SELECT * FROM zone ";
                                            $objq_member = mysqli_query($conn,$sql_member);
                                            while($member = $objq_member -> fetch_assoc()){
                                                if ($member['id_zone']==8) {
                                                    
                                                }else{
                                            ?>
                                                <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                            <?php 
                                                }
                                              } 
                                            ?>
                                        </select>
                                        </th>
                                        </tr>
                                    </tbody>
                                    </table> 
                                    <br> 

                                  <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">ผู้ส่ง</font></th>
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
                <!--//รับเข้า -->
                
                 <!--เบิกออก -->
                 <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-archive"></i> เบิกออก </a></li>
                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="withdraw_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B align = "center"> เบิกออก </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                    <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">สต๊อก</font></th>
                                        <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                            <?php #endregion
                                            $sql_member = "SELECT * FROM zone ";
                                            $objq_member = mysqli_query($conn,$sql_member);
                                            while($member = $objq_member -> fetch_assoc()){
                                                if ($member['id_zone']==8) {
                                                    
                                                }else{
                                            ?>
                                                <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                            <?php
                                                }   
                                            } 
                                            ?>
                                        </select>
                                        </th>
                                        </tr>
                                    </tbody>
                                    </table> 
                                    <br> 

                                  <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">ผู้เบิก</font></th>
                                        <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name ="id_member" class="form-control text-center select2" style="width: 100%;">
                                            <?php #endregion
                                            $sql_member = "SELECT * FROM member WHERE status = 'employee'";
                                            $objq_member = mysqli_query($conn,$sql_member);
                                            while($member = $objq_member -> fetch_assoc()){
                                                
                                            ?>
                                                <option value="<?php echo $member['id_member']; ?>"><?php echo $member['name']; ?></option>
                                            <?php
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
                                  <button type="submit"  class="btn btn-success pull-right">ถัดไป ==>></button>
                                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//เบิกออก -->
            
                <!--ข้อมูลการรับเข้า -->
                <li><a href="add_history.php"><i class="fa fa-cloud-download"></i> ข้อมูลการรับเข้า </a></li>
                <!--/ข้อมูลการรับเข้า -->

                <!--ข้อมูลการเบิก -->
                <li><a href="withdraw_history.php"><i class="fa fa-cloud-upload"></i> ข้อมูลการเบิก </a></li>
                <!--/ข้อมูลการเบิก -->

                <!--จัดการข้อมูลสินค้า-พนักงาน -->
                <li><a href="add_data.php" ><i class="fa fa-cog"></i> จัดการข้อมูล </a></li>
                <!--/จัดการข้อมูลสินค้า-พนักงาน -->

                <!--ORDER ค้างส่ง -->
                <li><a href="../add_customer/order.php" ><i class="fa fa-columns"></i> ORDER ค้างส่ง </a></li>
                <!--/ORDER ค้างส่ง -->

                <!--สั่งสินค้า -->
                <li><a href="../order/list_order.php" ><i class="fa fa-file-text-o"></i> สั่งสินค้า </a></li>
                <!--/สั่งสินค้า -->

                <!-- เงินขายรายวัน -->
                <li><a href="receive_money.php" ><i class="fa fa-money"></i> เงินขายรายวัน </a></li>
                <!-- /เงินขายรายวัน -->

                <!-- สถานที่ทำงาน -->
                <!-- <li><a href="working.php"><i class="fa fa-users"></i> ตารางปฏิบัติงาน </a></li> -->
                <!-- /สถานที่ทำงาน -->
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>