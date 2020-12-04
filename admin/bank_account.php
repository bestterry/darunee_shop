<?php
  require "../config_database/config.php";
  require "../session.php";
  $sql_bank_account = "SELECT * FROM bank_account
                        INNER JOIN bank_list ON bank_account.id_bank_list = bank_list.id_bank_list";
  $objq_bank_account = mysqli_query($conn,$sql_bank_account);
?>

<!DOCTYPE html>
<html>

  <head>
    <?php require('../font/font_style.php'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ทีมงานคุณดารุณี</title>
    <link rel="icon" type="image/png" href="../images/favicon.ico" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
        .topnav {
          background-color: while;
          overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
          float: left;
          color: black;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 15px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
          background-color: #ddd;
          color: black;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
          background-color: #3c8dbc;
          color: white;
        }
    </style>
  </head>

  <body class=" hold-transition skin-blue layout-top-nav ">

    <div class="wrapper">
      <header class="main-header">
        <?php require('menu/header_logout.php'); ?>
      </header>

      <div class="content-wrapper">
        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">

                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <div class="text-center">
                        <font size="5">
                          <B align="center">บัญชีโอนจ่าย</B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> เพิ่มบัญชี </a>
                    </div>
                  </div>
                </div>

                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="text-center" width="23%">บริษัท</th>
                            <th class="text-center" width="23%">ชื่อบัญชี</th>
                            <th class="text-center" width="22%">เลขที่บัญชี</th>
                            <th class="text-center" width="22%">ธนาคาร</th>
                            <th class="text-center" width="5%">แก้ไข</th>
                            <th class="text-center" width="5%">ลบ</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          foreach ($objq_bank_account as $value):
                        ?>
                          <tr>
                            <td class="text-center"><?php echo $value['company']; ?></td>
                            <td class="text-center"><?php echo $value['name_account']; ?></td>
                            <td class="text-center"><?php echo $value['number_account']; ?></td>
                            <td class="text-center"><?php echo $value['name_bank']; ?></td>
                            <td class="text-center"><a href="bank_account_edit.php?id_bank=<?php echo $value['id_bank']; ?>" 
                                class="btn btn-xs btn-success">แก้</a></td>
                            <td class="text-center"><a href="algorithm/delete_bank_account.php?id_bank=<?php echo $value['id_bank']; ?>"
                                class="btn btn-xs btn-danger">ลบ</a></td>
                          </tr>
                        <?php endforeach ;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box-footer text-right"></div>
              </div>
            </div>
          </div>
        </section>


      </div>
      <?php require("../menu/footer.html"); ?>
      
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="algorithm/add_bank_account.php" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> บัญชี </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                    <div class="table-responsive mailbox-messages">

                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">บริษัท</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="text" name="company" class="form-control text-center">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 

                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">ชื่อบัญชี</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="text" name="name_account" class="form-control text-center">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 

                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">เลขที่บัญชี</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="text" name="number_account" class="form-control text-center">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 

                      <table class="table table-bordered ">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">ธนาคาร</font></th>
                            <th class="text-center" width="70%"> 
                              <select name="id_bank_list" class="form-control select2" style="width: 100%;">
                                <?php 
                                  $sql_bank_list = "SELECT * FROM bank_list";
                                  $objq_bank_list = mysqli_query($conn,$sql_bank_list);
                                  foreach($objq_bank_list as $value):
                                ?>
                                  <option value="<?php echo $value['id_bank_list']; ?>"><?php echo $value['name_bank']; ?></option>
                                <?php 
                                  endforeach;
                                ?>
                              </select>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                      <br>

                    </div>
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn pull-left button2" data-dismiss="modal"><< ย้อนกลับ </button>
                <button type="submit" class="btn btn-success">บันทึก</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>

    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/iCheck/icheck.min.js"></script>
  </body>

</html>