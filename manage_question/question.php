<?php
  require "menu/date.php";
  require "db_connect.php";
  $conn = connect();
  require "../session.php";
  
  if ($id_member == 33) {
    $location = "../admin/admin.php";
  }elseif ($id_member == 30) {
    $location = "../admin/admin.php";
  }else {
    $location = "../store/store.php";
  }
  
?>
<!DOCTYPE html>
<html>

<head>
    <?php require('../font/font_style.php'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>จัดการเพลง</title>
    <!-- Tell the browser to be responsive to screen width -->
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
    <style>
      table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
          }
          th, td {
            padding: 5px;
            text-align: left;    
          }
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

      .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
      }

      .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: #2196F3;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }


      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
    </style>
    <script language="javascript">
      function fncSubmit()
      {
        if(document.form1.district_id.value == "")
        {
          alert('กรุณาระบุตำบล');
          document.form1.district_id.focus();
          return false;
        }	
        if(document.form1.address.value == "")
        {
          alert('กรุณาระบุหมู่ที่');
          document.form1.address.focus();		
          return false;
        }	
        if(document.form1.id_career.value == "")
        {
          alert('กรุณาเลือกอาชีพ');
          return false;
        }
        if(document.form1.know_team.value == "")
        {
          alert('กรุณาเลือกรู้จักทีมงาน');
          return false;
        }
        if(document.form1.use_product.value == "")
        {
          alert('กรุณาเลือกใช้สินค้าทีมงาน');
          return false;
        }
        if(document.form1.radio_team.value == "")
        {
          alert('กรุณาเลือกฟังวิทยุทีมงาน');
          return false;
        }
        
        document.form1.submit();
      }
    </script>
  </head>



  <body class=" hold-transition skin-blue layout-top-nav">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </nav>
    </header>

    <div class="content-wrapper">
      <section class="content">
        <div class="box box-primary">
          <div class="row">
            <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
              <div class="topnav">
                <a class="active" href="question.php"> แบบสอบถาม </a>
                <a href="data_question.php"></i> สรุปข้อมูล </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            <form action="algorithm/add_question.php" method="POST" class="form-horizontal" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box box-primary">

                <div class="box-header with-border text-center"> 
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    
                      <a href="<?php echo $location; ?>" class="btn btn-danger pull-left"><< เมนูหลัก</a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                      <B> <font size="5">แบบสอบถาม (สัญจร)</font> </B>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                  </div>
                </div>

                <div class="box-body no-padding">
                  <div class="mailbox-read-message">

                    <div class="col-12">
                      <div class="col-2 col-sm-1 col-md-3 col-xl-2"></div>
                      <div class="col-10 col-sm-11 col-md-9 col-xl-10">

                        <div class="form-group">
                          <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label text-right"><font size="4">จังหวัด</font></label>
                          <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <select name="province_id" data-where="2" class="form-control ajax_address select2">
                            </select>
                          </div>
                          <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label text-right"></div>
                        </div>

                        <div class="form-group">
                          <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label text-right"><font size="4">อำเภอ</font></label>
                          <div class="col-6 col-xs-6 col-sm-6 col-md- col-lg-6">
                            <select name="amphur_id" data-where="3" class="ajax_address form-control select2">
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"></div>
                        </div>

                        <div class="form-group">
                          <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label text-right"><font size="4">ตำบล</font></label>
                          <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <select name="district_id" data-where="4" class="ajax_address form-control select2">
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"></div>
                        </div>

                        <div class="form-group">
                          <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label text-right"><font size="4">หมู่ที่</font></label>
                          <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <input type="number" name="address" class="form-control" value="">
                          </div>
                          <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"></div>
                        </div>
                        <br>
                        <br>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="col-1 col-sm-1 col-md-1 col-xl-1"></div>
                      <div class="col-10 col-sm-10 col-md-10 col-xl-10">
                        <font size="4">
                          <div class="text-center"> <font size="5"> <B>โดยผู้สอบถาม (ไม่ถาม)</B></font></div>
                          <br>
                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">เพศ &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              
                              <input type="radio" name="id_sex" value="1" checked>
                              &nbsp;ชาย
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_sex" value="2">
                              &nbsp;หญิง
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3"></label>
                          </div>

                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">อายุ &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_age" value="1" checked>
                              &nbsp;น้อยกว่า 30
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_age" value="2">
                              &nbsp;30 - 60
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_age" value="3">
                              &nbsp;มากกว่า 60
                            </label>
                          </div>

                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">ฐานะเศรษฐกิจ &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_status" value="3" checked>
                              &nbsp;ยากจน
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_status" value="2">
                              &nbsp;ปานกลาง
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_status" value="1">
                              &nbsp;ดี
                            </label>
                          </div>
                          <br>

                          <div class="text-center"> <font size="5"> <B>สอบถามผู้ให้ข้อมูล (ถาม)</B></font></div>
                          <br>
                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">อาชีพ &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_career" value="1">
                              &nbsp;เกษตรกร
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_career" value="2">
                              &nbsp;อื่นๆ
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="id_career" value="3">
                              &nbsp;ไม่ถาม
                            </label>
                          </div>

                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">รู้จักทีมงาน &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="know_team" value="Y">
                              &nbsp;ใช่
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="know_team" value="N">
                              &nbsp;ไม่ใช่
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="know_team" value="D">
                              &nbsp;ไม่ถาม
                            </label>
                          </div>

                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">ใช้สินค้าทีมงาน &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="use_product" value="Y">
                              &nbsp;ใช่
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="use_product" value="N">
                              &nbsp;ไม่ใช่
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="use_product" value="D">
                              &nbsp;ไม่ถาม
                            </label>
                          </div>

                          <div class="form-group">
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3 text-right">ฟังวิทยุทีมงาน &nbsp; &nbsp;</label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="radio_team" value="Y">
                              &nbsp;ใช่
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="radio_team" value="N">
                              &nbsp;ไม่ใช่
                            </label>
                            <label class="col-3 col-sm-3 col-md-3 col-xl-3">
                              <input type="radio" name="radio_team" value="D">
                              &nbsp;ไม่ถาม
                            </label>
                          </div>

                        </font>
                      </div>
                      <div class="col-1 col-sm-1 col-md-1 col-xl-1"></div>
                      
                    </div>
                  </div>
                </div>

                <div class="box-footer text-center">
                  <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')">บันทึกข้อมูล</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>

    <?php require "menu/footer.html"; ?>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="../bower_components/moment/min/moment.min.js"></script>
    <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

    <script type="text/javascript">
      $(function() {

        // เมื่อโหลดขึ้นมาครั้งแรก ให้ ajax ไปดึงข้อมูลจังหวัดทั้งหมดมาแสดงใน
        // ใน select ที่ชื่อ province_name 
        // หรือเราไม่ใช้ส่วนนี้ก็ได้ โดยไปใช้การ query ด้วย php แสดงจังหวัดทั้งหมดก็ได้
        $.post("getAddress.php", {
          IDTbl: 1
        }, function(data) {
          $("select[name=province_id]").html(data);
        });
        // สร้างตัวแปร สำหรับเก็บค่าข้อความให้เลือกรายการ เช่น เลือกจังหวัด
        // เราจะเก็บค่านี้ไว้ใช้กรณีมีการรีเซ็ต หรือเปลี่ยนแปลงรายการใหม่
        var chooseText = [];
        $(".ajax_address").each(function(i, k) {
          var initObj = $(".ajax_address").eq(i).find("option:eq(0)")[0];
          chooseText[i] = initObj;
        });

        // ส่วนของการตรวจสอบ และดึงข้อมูล ajax สังเกตว่าเราใช้ css คลาสชื่อ ajax_address
        // ดังนั้น css คลาสชื่อนี้จำเป็นต้องกำหนด หรือเราจะเปลี่ยนเป็นชื่ออื่นก็ได้ แต่จำไว้ว่า
        // ต้องเปลี่ยนในส่วนนี้ด้วย
        $(".ajax_address").on("change", function() {
          var indexObj = $(".ajax_address").index(this); // เก็บค่า index ไว้ใช้งานสำหรับอ้างอิง
          // วนลูปรีเซ็ตค่า select ของแต่ละรายการ โดยเอาค่าจาก array ด้านบนที่เราได้เก็บไว้
          $(".ajax_address").each(function(i, k) {
            if (i > indexObj) { // รีเซ็ตค่าของรายการที่ไม่ได้เลือก
              $(".ajax_address").eq(i).html(chooseText[i]);
            }
          });

          var obj = $(this);
          var IDCheck = obj.val(); // ข้อมูลที่เราจะใช้เช็คกรณี where เช่น id ของจังหวัด
          var IDWhere = obj.data("where"); // ค่าจาก data-where ค่าน่าจะเป็นตัวฟิลด์เงื่อนไขที่เราจะใช้
          var targetObj = $("select[data-where='" + (IDWhere + 1) + "']"); // ตัวที่เราจะเปลี่ยนแปลงข้อมูล
          if (targetObj.length > 0) { // ถ้ามี obj เป้าหมาย
            targetObj.html("<option>.. กำลังโหลดข้อมูล.. </option>"); // แสดงสถานะกำลังโหลด  
            setTimeout(function() { // หน่วงเวลานิดหน่อยให้เห็นการทำงาน ตัดเออกได้
              // ส่งค่าไปทำการดึงข้อมูล option ตามเงื่อนไข
              $.post("getAddress.php", {
                IDTbl: IDWhere,
                IDCheck: IDCheck,
                IDWhere: IDWhere - 1
              }, function(data) {
                targetObj.html(data); // แสดงค่าผลลัพธ์
              });
            }, 0);
          }
        });

      });
    </script>
    <script>
      $(function () {
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
          },
          function (start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
      })
    </script>
  </body>
</html> 