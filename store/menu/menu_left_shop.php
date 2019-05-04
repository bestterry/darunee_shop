<div class="row">
  <div class="col-md-3">
    <div class="box box-solid">
      <div class="box-header with-border">
        <font size="3"><B>เมนูจัดการสินค้า</B></font>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li><a href="store.php"><i class="fa fa-home"></i> สินค้าคงเหลือ </a></li>
          <!-- ขายสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-minus-square"></i> ขายสินค้า </a>
          </li>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="sale_product.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5"><B> เลือกสินค้าที่ต้องการขาย </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">ชื่อสินค้า</th>
                            <th class="text-center" width="15%">คงเหลือ</th>
                          <tr>
                            <?php while($product = $query_product2 ->fetch_assoc()){ ?>
                            <td class="text-center" width="15%">
                              <input type="checkbox" name="id_numPD[]" value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php }?>
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
          <!-- /ขายสินค้า -->
          <!-- ประวัติขายสินค้า -->
          <li><a href="sale_product_history.php"><i class="fa fa-exchange"></i> ยอดขายสินค้า </a></li>
          <!-- โอนสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-inbox"></i> โอนสินค้า </a></li>
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="transfer_product.php" method="post">
                <div class="modal-content text-center">
                  <div class="modal-header">
                    <font size="5"><B align="center"> เลือกสินค้าที่ต้องการโอน </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">ชื่อสินค้า</th>
                            <th class="text-center" width="15%">คงเหลือ</th>
                          <tr>
                            <?php while($product = $query_product1 ->fetch_assoc()){ ?>
                            <td class="text-center" width="15%">
                              <input type="checkbox" name="id_numPD[]" value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php }?>
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
          <!-- /โอนสินค้า -->
          
          <!-- แยกสินค้า -->
          <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-inbox"></i> แยกสินค้า </a></li>
          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="sr_product.php" method="post">
                <div class="modal-content text-center">
                  <div class="modal-header">
                    <font size="5"><B align="center"> เลือกสินค้าที่ต้องการแยก </B></font>
                  </div>
                  <div class="modal-body table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="20%">เลือกสินค้า</th>
                            <th class="text-center" width="35%">ชื่อสินค้า</th>
                            <th class="text-center" width="15%">คงเหลือ</th>
                          <tr>
                            <?php 
                                                $sr_product = "SELECT * FROM product INNER JOIN numpd_car ON product.id_product = numpd_car.id_product WHERE numpd_car.id_member = $id_member";
                                                $sql_sr_product = mysqli_query($conn,$sr_product);
                                                while($product = $sql_sr_product ->fetch_assoc()){
                                                    $id_product = $product['id_product'];
                                                    if($id_product==1){ 
                                            ?>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==3) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==5) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==9) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
                            </td>
                            <td width="35%"><?php echo $product['name_product'].' ('.$product['unit'].')'; ?></td>
                            <td class="text-center" width="15%"><?php echo $product['num']; ?></td>
                          </tr>
                          <?php
                                                    }else if($id_product==32) { 
                                            ?>
                          <tr>
                            <td class="text-center" width="15%">
                              <input type="radio" class="minimal" name="id_numPD"
                                value="<?php echo $product['id_numPD_car']; ?>">
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

        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>