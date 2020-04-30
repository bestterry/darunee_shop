<div class="row">
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font size="3"><B>เมนูหลัก</B></font>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked" ata-widget="tree">
            <?php
                    if($id_member == 30 || $id_member == 33){
            ?>

                <!--สั่งสินค้า -->
                <li><a href="../order/list_order.php" ><i class="fa fa-file-text-o"></i> สั่งซื้อสินค้า </a></li>
                <!--/สั่งสินค้า -->

                <!--รับเข้า -->
                <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-download"></i> รับสินค้าเข้า </a></li>
                <div class="modal fade" id="myModal2" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="add_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B> รับสินค้าเข้า </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">

                                    <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">รับเข้า STOCK</font></th>
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

                                  <table class="table table-bordered ">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">ผู้ส่งของ</font></th>
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
                                  <button type="submit" class="btn button2 pull-right">ถัดไป >></button>
                                  <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//รับเข้า -->

                <!--ข้อมูลการรับเข้า -->
                <li><a href="add_history.php"><i class="fa fa-cloud-download"></i> ประวัติ (รับเข้า) </a></li>
                <!--/ข้อมูลการรับเข้า -->

                <!--เบิกออก -->
                <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-upload"></i> เบิกสินค้าออก </a></li>
                 <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="withdraw_product.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B align = "center"> เบิกสินค้าออกจาก STOCK </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                    <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">เบิกจาก STOCK</font></th>
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

                                  <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                        <th class="text-center" width="30%"><font size="5">ผู้ขอเบิก</font></th>
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
                                  <button type="submit"  class="btn button2 pull-right">ถัดไป >></button>
                                  <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//เบิกออก -->

                <!--ข้อมูลการเบิก -->
                <li><a href="withdraw_history.php"><i class="fa fa-cloud-upload"></i> ประวัติ (เบิกออก) </a></li>
                <!--/ข้อมูลการเบิก -->


                <!-- สต๊อกรวม -->
                <li><a href="total_stock.php" ><i class="fa fa-home"></i> STOCK </a></li>
                <!-- /สต๊อกรวม -->

                <!--ORDER ค้างส่ง -->
                <li><a href="../add_customer/order.php" ><i class="fa fa-columns"></i> ORDER </a></li>
                <!--/ORDER ค้างส่ง -->

                <!-- นอกเขต. -->
                <li><a href="outside.php" ><i class="fa fa-truck"></i> ขายนอกเขต </a></li>
                <!-- /นอกเขต. -->

                <!-- สต๊อกรถ -->
                <!-- <li><a href="car_stock.php" ><i class="fa fa-truck"></i> สต๊อกรถ </a></li> -->
                <!-- /สต๊อกรถ -->

                <!-- ยอดขาย -->
                <li><a href="sale_history.php" ><i class="fa fa-money"></i>เงินขาย (รายคน)</a></li>
                <!-- /ยอดขาย -->

                <!-- ยอดขาย -->
                <li><a href="total_soft.php" ><i class="fa fa-money"></i>เงินขาย (รายสินค้า) </a></li>
                <!-- /ยอดขาย -->

                <!-- เงินขายรายวัน -->
                <li><a href="receive_money.php" ><i class="fa fa-money"></i>เงินขาย (รายวัน) </a></li>
                <!-- /เงินขายรายวัน -->

                <!--เงินสะสม -->
                <li><a href="#" data-toggle="modal" data-target="#cu"><i class="fa fa-money"></i>เงินขาย (สะสม) </a></li>
                <div class="modal fade" id="cu" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="cu_sale.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B> เงินสะขายสม </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                    <div class="col-md-6 text-center">
                                        <div class="col-sm-4">
                                        <font size="5"><label>  ตั้งแต่ :</label></font>
                                        </div>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="date" name="aday">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center"> 
                                        <div class="col-sm-4">
                                            <font size="5"><label>  ถึง :</label></font>
                                        </div>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="date" name="bday">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit"  class="btn btn-success pull-right">ถัดไป >></button>
                                  <button type="button" class="btn button2 pull-left" data-dismiss="modal"> << ย้อนกลับ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//เงินสะสม -->

                <!-- สกต. -->
                <li><a href="acc_market_sale.php" ><i class="fa fa-money"></i>เงินขาย (สกต.) </a></li>
                <!-- /สกต. -->

                 <!-- กำไรขาย -->
                 <!-- <li><a href="profit.php"><i class="fa fa-money"></i> กำไรขาย </a></li> -->
                <!-- /กำไรขาย -->

                <!-- นอกเขต. -->
                <li><a href="store.php" ><i class="fa fa-user-circle-o"></i> ระเบียนร้านค้า </a></li>
                <!-- /นอกเขต. -->

                <!--จัดการข้อมูลสินค้า-พนักงาน -->
                <li><a href="add_data.php" ><i class="fa fa-cog"></i> จัดการข้อมูล </a></li>
                <!--/จัดการข้อมูลสินค้า-พนักงาน -->

                <!-- สำรองจ่าย. -->
                <!-- <li><a href="reserve_money.php" ><i class="fa fa-user-circle-o"></i> สำรองจ่าย </a></li> -->
                <!-- /สำรองจ่าย. -->

                <!-- สถานที่ทำงาน -->
                <!-- <li><a href="working.php"><i class="fa fa-users"></i> ตารางปฏิบัติงาน </a></li> -->
                <!-- /สถานที่ทำงาน -->
                <?php
                    }
                ?>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>