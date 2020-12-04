<?php
  require "../config_database/config.php";
  require "../session.php"; 
  $sql_bank = "SELECT * FROM bank_company";
  $objq_bank = mysqli_query($conn,$sql_bank);
?>
<!DOCTYPE html>
<html>

  <?php require 'menu/header.php'; ?>
  <style>
    div.a {
      line-height: 5;
    }
  </style>

  <body class=" hold-transition skin-blue layout-top-nav">
   
    <header class="main-header">
      <?php require('menu/header_logout.php'); ?>
    </header>
    <div class="content-wrapper">
      <section class="content">

        <div class="box box-primary">
          <div class="row">
            <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
              <div class="topnav">
                <a class="active" href="list_bank.php"> บัญชีโอนจ่าย </a>
                <a href="add_bank.php"> เพิ่มบัญชี </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
              <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                </div>
                <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 text-center">
                  <font size="5"><B> บัญชีโอนจ่าย </B></font>
                </div>
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="row">
                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center" width="18%">บริษัท</th>
                          <th class="text-center" width="18%">สินค้า</th>
                          <th class="text-center" width="18%">ชื่อบัญชี</th>
                          <th class="text-center" width="18%">เลขที่บัญชี</th>
                          <th class="text-center" width="18%">ธนาคาร</th>
                          <th class="text-center" width="5%">#</th>
                          <th class="text-center" width="5%">#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          foreach($objq_bank as $value):
                            $id_company = $value['id_company'];
                        ?>
                         <tr>
                            <td class="text-center"> <?php echo $value['name_company']; ?> </td>
                            <td class="text-center"> 
                              <?php 
                                $sql_bankproduct = "SELECT name_product FROM bank_product WHERE id_company = $id_company";
                                $objq_bankproduct = mysqli_query($conn,$sql_bankproduct);
                                foreach($objq_bankproduct as $value_bankproduct):
                                  echo $value_bankproduct['name_product'].'<br><br>';
                                endforeach;   
                              ?> 
                            </td>

                            <?php 
                                $sql_banklist = "SELECT name_bank_list,number_bank_list,name_bank FROM bank_list WHERE id_company = $id_company";
                                $objq_banklist = mysqli_query($conn,$sql_banklist);
                              ?> 

                            <td class="text-center"> 
                              <?php 
                                foreach($objq_banklist as $name_bank_list):
                                  echo $name_bank_list['name_bank_list'].'<br><br>';
                                endforeach;   
                              ?> 
                            </td>
                            <td class="text-center"> 
                              <?php 
                                foreach($objq_banklist as $number_bank_list):
                                  echo $number_bank_list['number_bank_list'].'<br><br>';
                                endforeach;   
                              ?> 
                            </td>
                            <td class="text-center"> 
                              <?php 
                                foreach($objq_banklist as $name_bank):
                                  echo $name_bank['name_bank'].'<br><br>';
                                endforeach;   
                              ?> 
                            </td>
                            <td class="text-center"><a href="edit_bank.php?id_company=<?php echo $id_company; ?>" class="btn btn-xs btn-success">แก้</a></td>
                            <td class="text-center"><a href="algorithm/delete_bank.php?id_company=<?php echo $id_company; ?>" class="btn btn-xs btn-danger">ลบ</a></td>
                         </tr>
                        <?php 
                          endforeach;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div align="center" class="box-footer"> </div>
          </div>
        </div>
      </section>
    </div>

    <?php require('menu/script.php'); ?>
        
  </body>
</html>