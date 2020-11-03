<?php
  if($id_member == 30 || $id_member == 33){
?>

  <div class="col-3 col-xs-7 col-sm-7 col-md-4 col-xl-4">
    <div class="box box-solid">
      <div class="box-header with-border">
      <font size="3"><B>สำนักงาน</B></font>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked" ata-widget="tree">

          <!-- ปฏิบัติงาน สนง. -->
          <li><a href="report_work.php"><i class="fa fa-user-circle"></i> ปฏิบัติงาน (สนง) </a></li>
          <!--/ปฏิบัติงาน สนง. -->
        
          <!-- สำรองจ่าย -->
          <li><a href="reserve_office.php"><i class="fa fa-money"></i> สำรองจ่าย </a></li>
          <!--/สำรองจ่าย -->

          <!-- ตัดจ่ายค่าสินค้า -->
          <li><a href="transfer.php" ><i class="fa fa-money"></i>ตัดจ่ายค่าสินค้า</a></li>
          <!-- /ตัดจ่ายค่าสินค้า -->

          <!--สั่งสินค้า -->
          <li><a href="../order/list_order.php" ><i class="fa fa-file-text-o"></i> สั่งซื้อสินค้า </a></li>
          <!--/สั่งสินค้า -->

          <!--ข้อมูลการรับเข้า -->
          <li><a href="add_history.php"><i class="fa fa-cloud-download"></i> รับเข้า </a></li>
          <!--/ข้อมูลการรับเข้า -->

          <!--ข้อมูลการเบิก -->
          <li><a href="withdraw_history.php"><i class="fa fa-cloud-upload"></i> เบิกออก (ปกติ) </a></li>
          <!--/ข้อมูลการเบิก -->

          <!--เบิกออก(ชำรุดและหาย) -->
          <li><a href="withdraw_productwaste.php"><i class="fa fa-cloud-upload"></i> เบิกออก (ชำรุดและหาย) </a></li>
          <!--/เบิกออก(ชำรุดและหาย) -->

          <!-- ยอดเบิกรับขาย (ตรวจ) -->
          <li><a href="abstract_today.php" ><i class="fa fa-money"></i>ยอดเบิกรับขาย (ตรวจ)</a></li>
          <!-- /ยอดเบิกรับขาย (ตรวจ) -->

          <!-- สกต. -->
          <li><a href="acc_market_sale.php" ><i class="fa fa-money"></i>ขาย สกต</a></li>
          <!-- /สกต. -->

          <!-- ขายนอกเขต. -->
          <li><a href="outside.php" ><i class="fa fa-truck"></i> ขายนอกเขต </a></li>
          <!-- /ขายนอกเขต. -->

        </ul>
      </div>
    </div>
  </div>

  <div class="col-3 col-xs-7 col-sm-7 col-md-4 col-xl-4">
    <div class="box box-solid">
      <div class="box-header with-border">
        <font size="3"><B>รายงาน</B></font>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked" ata-widget="tree">

          <!-- สต๊อกรวม -->
          <li><a href="total_stock.php" ><i class="fa fa-home"></i> STOCK </a></li>
          <!-- /สต๊อกรวม -->  

          <!--ORDER ค้างส่ง -->
          <li><a href="../add_customer/list_order.php" ><i class="fa fa-columns"></i> ORDER </a></li>
            <!--/ORDER ค้างส่ง -->

          <!-- รายการขาย (เงินขาย) -->
          <li><a href="sale_history.php" ><i class="fa fa-money"></i>รายการขาย (เงินขาย)</a></li>
          <!-- /รายการขาย (เงินขาย) -->

          <!-- ยอดจำหน่าย (กำไร) -->
          <li><a href="profit.php" ><i class="fa fa-money"></i>ยอดจำหน่าย (กำไร)</a></li>
          <!-- /ยอดจำหน่าย (กำไร) --> 

          <!-- เงินขาย (ค้างรับ) -->
          <li><a href="receive_money.php" ><i class="fa fa-money"></i>เงินขาย (ค้างรับ) </a></li>
          <!-- /เงินขาย (ค้างรับ) -->

          <!--เงินสะสม -->
          <li><a href="#" data-toggle="modal" data-target="#cu"><i class="fa fa-money"></i>เงินขาย (สะสม) </a></li>
          <div class="modal fade" id="cu" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="cu_sale.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5"><B> เงินขายสะสม </B></font>
                  </div>
                    <div class="modal-body col-md-12 table-responsive mailbox-messages">
                      <div class="table-responsive mailbox-messages">
                        <div class="col-12">
                          <div class="col-md-6 text-center">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <B><font size="5">ตั้งแต่</font></B>
                            </div>
                            <div class="col-sm-2"></div>
                          </div>
                          <div class="col-md-6 text-center"> 
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                              <B><font size="5">ถึง</font></B>
                            </div>
                            <div class="col-sm-2"></div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="col-md-6 text-center">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                              <input class="form-control text-center" type="date" name="aday">
                            </div>
                            <div class="col-sm-2"></div>
                          </div>
                          <div class="col-md-6 text-center"> 
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                              <input class="form-control text-center" type="date" name="bday">
                            </div>
                            <div class="col-sm-2"></div>
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

          <!-- ค่าส่งปุ๋ย -->
          <li><a href="sent_fertilizer.php" ><i class="fa fa-money"></i>ค่าส่งปุ๋ย </a></li>
          <!-- /ค่าส่งปุ๋ย -->
            
        </ul>
      </div>
    </div>
  </div>

 <div class="col-3 col-xs-7 col-sm-7 col-md-4 col-xl-4">
  <div class="box box-solid">
    <div class="box-header with-border">
     <font size="3"><B>อื่นๆ</B></font>
    </div>
    <div class="box-body no-padding">
     <ul class="nav nav-pills nav-stacked" ata-widget="tree">

        <!-- จัดการเพลง -->
        <li><a href="radio_list.php" ><i class="fa fa-play-circle-o"></i> เวลาเช่าวิทยุ </a></li>
        <!--/จัดการเพลง -->

        <!-- ระเบียนร้านค้า. -->
        <li><a href="store.php" ><i class="fa fa-user-circle-o"></i> ระเบียนร้านค้า </a></li>
        <!-- /ระเบียนร้านค้า. -->

        <!-- แนะนำสินค้า -->
        <li><a href="present_product.php"><i class="fa fa-columns"></i> แนะนำสินค้า </a></li>
        <!--/แนะนำสินค้า -->

        <!-- จัดการเพลงหลัก -->
        <li><a href="../manage_song/artist.php" ><i class="fa fa-music"></i> จัดการเพลง </a></li>
        <!--/จัดการเพลงหลัก -->

        <!-- จัดการเพลง -->
        <li><a href="../manage_interview/interview.php"><i class="fa fa-car"></i> จัดการสัมภาษณ์ </a></li>
        <!--/จัดการเพลง -->

         <!-- แผนที่ -->
         <li><a href="map.php" ><i class="fa fa-map"></i> แผนที่ </a></li>
        <!-- /แผนที่ -->
        
        <!--จัดการข้อมูลสินค้า-พนักงาน -->
        <li><a href="add_data.php" ><i class="fa fa-cog"></i> จัดการข้อมูล </a></li>
        <!--/จัดการข้อมูลสินค้า-พนักงาน -->
        
     </ul>
    </div>
  </div>
 </div>

<?php
    }elseif($id_member == 100 || $id_member == 101){
?>

  <div class="col-3 col-xs-8 col-sm-8 col-md-4 col-xl-4">
    <div class="box box-solid">
      <div class="box-header with-border">
      <font size="3"><B>เมนูหลัก</B></font>
      </div>
      <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked" ata-widget="tree">
        
        <!--ORDER ค้างส่ง -->
        <li><a href="../add_customer/list_order.php" ><i class="fa fa-columns"></i> ORDER </a></li>
          <!--/ORDER ค้างส่ง -->

          <!-- นอกเขต. -->
          <li><a href="store.php" ><i class="fa fa-user-circle-o"></i> ระเบียนร้านค้า </a></li>
          <!-- /นอกเขต. -->
          
          <!-- แผนที่ -->
          <li><a href="map.php" ><i class="fa fa-map"></i> แผนที่ </a></li>
          <!-- /แผนที่ -->

          <!-- จัดการเพลงหลัก -->
          <li><a href="../manage_song/artist.php" ><i class="fa fa-music"></i> จัดการเพลง </a></li>
          <!--/จัดการเพลงหลัก -->

          <!-- จัดการเพลง -->
          <li><a href="radio_list.php" ><i class="fa fa-play-circle-o"></i> เวลาเช่าวิทยุ </a></li>
          <!--/จัดการเพลง -->

          <!-- จัดการเพลง -->
          <li><a href="../manage_interview/interview.php"><i class="fa fa-car"></i> จัดการสัมภาษณ์ </a></li>
          <!--/จัดการเพลง -->
        
      </ul>
      </div>
    </div>
  </div>
        
<?php 
    }
?>