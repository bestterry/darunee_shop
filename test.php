<?php
   $objr_debt = mysqli_fetch_array($objq_debt);

   if (!empty($objr_debt['id_debt_list']==1)) {
     $debt_office = $objr_debt['money_debt_hr'];
     $debt_owing_office = $objr_debt['money_debt_owing'];
   }else {
     $debt_office = 0;
     $debt_owing_office = 0;
   }

   if (!empty($objr_debt['id_debt_list']==2)) {
     $debt_func = $objr_debt['money_debt_hr'];
     $debt_owing_func = $objr_debt['money_debt_owing'];
   }else {
     $debt_func = 0;
     $debt_owing_func = 0;
   }

 $total_owe = $debt_owing_office+$debt_office+$debt_owing_func+$debt_func;
 $total_pay_debt = $debt_func + $debt_office;
 $total_debt = $total_owe - $total_pay_debt;

?>

<?php 
                              $sql_debt = "SELECT * FROM salary_debt_history WHERE id_member = $id_member AND date = '$date2'";
                              $objq_debt = mysqli_query($conn,$sql_debt);
                              if ($objq_debt->num_rows > 0) {
                            ?>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="25%">รายการหนี้</th>
                                    <th class="text-center" width="25%">ยอดค้าง</th>
                                    <th class="text-center" width="25%">หัก</th>
                                    <th class="text-center" width="25%">คงเหลือ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_debt_list = "SELECT * FROM salary_dept_list";
                                    $objq_debt_list = mysqli_query($conn,$sql_debt_list);
                                    foreach()
                                  ?>
                                  <tr> 
                                    <td class="text-center">หนี้สำนักงาน</td>
                                    <td class="text-center"><?php echo $debt_owing_office+$debt_office; ?></td>
                                    <td class="text-center"><?php echo $debt_office; ?></td>
                                    <td class="text-center"><?php echo $debt_owing_office; ?></td>
                                  </tr>

                                  <tr> 
                                    <td class="text-center">หนี้กองทุน</td>
                                    <td class="text-center"><?php echo $debt_owing_func+$debt_func; ?></td>
                                    <td class="text-center"><?php echo $debt_func; ?></td>
                                    <td class="text-center"><?php echo $debt_owing_func; ?></td>
                                  </tr>
                                  <tr> 
                                    <th class="text-center">หนี้คงเหลือ</th>
                                    <th class="text-center"><?php echo $total_owe; ?></th>
                                    <th class="text-center"><?php echo $total_pay_debt; ?></th>
                                    <th class="text-center"><?php echo $total_debt; ?></th>
                                  </tr>
                                </tbody>
                              </table>
                            <?php
                              }else {
                            ?>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="25%">รายการหนี้</th>
                                    <th class="text-center" width="25%">ยอดค้าง</th>
                                    <th class="text-center" width="25%">หัก</th>
                                    <th class="text-center" width="25%">คงเหลือ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td class="text-center">หนี้สำนักงาน</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><?php echo "test2"; ?></td>
                                    <td class="text-center"></td>
                                  </tr>
                                  <tr> 
                                    <td class="text-center">หนี้กองทุน</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><?php  ?></td>
                                    <td class="text-center"></td>
                                  </tr>
                                  <tr> 
                                    <th class="text-center">หนี้คงเหลือ</th>
                                    <th class="text-center"></th>
                                    <th class="text-center"><?php  ?></th>
                                    <th class="text-center"></th>
                                  </tr>
                                </tbody>
                              </table>
                            <?php 
                              } 
                            ?>