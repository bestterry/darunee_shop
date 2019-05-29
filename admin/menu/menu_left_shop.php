<div class="row">
<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <font size="3"><B>เมนูหลัก</B></font>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked" ata-widget="tree">
                <!-- ประวัติขายสินค้า -->
                <li><a href="sale_history.php" ><i class="fa fa-exchange"></i> ยอดขาย </a></li>
                 <!--โอนสินค้า -->
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
                <!--//รับเข้าสินค้า -->

                 <!--โอนสินค้า -->
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
                <!--//รับเข้าสินค้า -->

                <!--ประวัติรับเข้าสินค้า -->
                <li><a href="total_stock.php" ><i class="fa fa-home"></i> สต๊อกรวม </a></li>
                <li><a href="car_stock.php" ><i class="fa fa-truck"></i> สต๊อกรถ </a></li>
                <li><a href="withdraw_history.php"><i class="fa fa-cloud-upload"></i> ข้อมูลการเบิก </a></li>
                <li><a href="add_history.php"><i class="fa fa-cloud-download"></i> ข้อมูลการรับเข้า </a></li>
                <li><a href="profit.php"><i class="fa fa-money"></i> กำไรขาย </a></li>
                
                <!--เงินสะสม -->
                <li><a href="#" data-toggle="modal" data-target="#cu"><i class="fa fa-archive"></i> เงินสะสม </a></li>
                <div class="modal fade" id="cu" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="cu_sale.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <font size="5"><B> เงินสะสม </B></font>
                                </div>
                                <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <strong><i class="fa fa-file-text-o margin-r-6"></i> การใช้ </strong>
                                            <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบข้อมูลเงินสะสม</p>
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

                <!-- สถานที่ทำงาน -->
                <li><a href="working.php"><i class="fa fa-users"></i> ตารางปฏิบัติงาน </a></li>
                <!-- /สถานที่ทำงาน -->
                <li><a href="add_data.php" ><i class="fa fa-cog"></i> จัดการข้อมูลสินค้า-พนักงาน </a></li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>