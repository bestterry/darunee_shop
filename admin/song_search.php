<?php
  require "../config_database/config.php";

  $sql_age = "SELECT id_age,name_age FROM song_age";
  $objq_age = mysqli_query($conn,$sql_age);

  $sql_ageartist = "SELECT id_ageartist,name_ageartist FROM song_ageartist";
  $objq_ageartist = mysqli_query($conn,$sql_ageartist);
  $objq_ageartist2 = mysqli_query($conn,$sql_ageartist);

  $sql_sexartist = "SELECT id_sexartist,name_sexartist FROM song_sexartist";
  $objq_sexartist = mysqli_query($conn,$sql_sexartist);
  $objq_sexartist2 = mysqli_query($conn,$sql_sexartist);
  $objq_sexartist3 = mysqli_query($conn,$sql_sexartist);
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เพลง</title>
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
  <style>
    thead {
      color : red;
    }

    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>

</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div>
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
          </ul>
        </div>
      </nav>
    </header>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-6 col-sm-6 col-xl-6 col-md-6">
                      <a type="button" href="admin.php" class="btn button2"><< เมนูหลัก</a>
                    </div>
                    
                    <div class="col-6 col-sm-6 col-xl-6 col-md-6 text-right">
                      <a type="button" href="song_listAll.php" class="btn btn-success" style="color:black;">เพลงทั้งหมด</a>
                      <a type="button"href="#" data-toggle="modal" data-target="#add_song" class="btn btn-success" style="color:black;">เพิ่มเพลง</a>
                      <a type="button"href="#" data-toggle="modal" data-target="#add_artist" class="btn btn-success" style="color:black;">เพิ่มนักร้อง</a>
                      <a type="button" href="song_artist.php" class="btn btn-success" style="color:black;">จัดการนักร้อง</a>
                      <a type="button" href="algorithm/reset_song3.php" 
                      class="btn btn-danger" style="color:black;" OnClick="return confirm('คุณต้องการที่จะเปลี่ยนรายการเพลงเป็นยังไม่ได้เปิดหรือไม่ ?')";>รีเซตสถานะ</a>
                      <!-- <a type="button" href="../pdf_file/song_listY.php" class="btn btn-warning" style="color:black;">รายงาน</a> -->
                      <!-- <a type="button" href="algorithm/reset_song.php" class="btn btn-success" style="color:black;" OnClick="return confirm('คุณต้องการที่จะเปลี่ยนรายการเพลงเป็นยังไม่ได้เปิดหรือไม่ ?')";>รีเซตสถานะ</a> -->
                    </div>
                  </div>
                </div>
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#search_tune" data-toggle="tab">ทำนอง</a></li>
                    <li><a href="#search_artist" data-toggle="tab">นักร้อง</a></li>
                  </ul> 
                  <div class="tab-content">
                  
                    <div class="tab-pane active" id="search_tune">
                      <form action="song_list.php" class="form-horizontal" method="get" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <div class="row">
                                <div class="col-2 col-sm-2 col-md-2"></div>
                                <div class="col-8 col-sm-8 col-md-8">
                                  <div class="text-center">
                                    <B><font size="5">ค้นหาเพลง (ทำนอง)</font></B>
                                  </div>
                                  <br>
                                  <div class="form-group">
                                    <label class="col-sm-4 control-label"><font size="4">ยุค</font></label>
                                    <div class="col-sm-8">
                                      <select name="id_age" class=" form-control" style="width: 50%;">
                                        <option value="">-- เลือกยุคเพลง --</option>
                                        <?php 
                                          while($value_age = $objq_age->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $value_age['id_age'];?>"><?php echo $value_age['name_age'];?></option>
                                        <?php    
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-sm-4 control-label"><font size="4">ชาย / หญิง</font></label>
                                    <div class="col-sm-8">
                                      <select name="id_sexartist" class=" form-control" style="width: 50%;">
                                        <option value="">-- เลือกเพศนักร้อง --</option>
                                        <?php 
                                          while($value_sexartist = $objq_sexartist->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $value_sexartist['id_sexartist'];?>"><?php echo $value_sexartist['name_sexartist'];?></option>
                                        <?php    
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-sm-4 control-label"><font size="4">ทำนอง</font></label>
                                    <div class="col-sm-8">
                                      <select name="id_tune" class=" form-control" style="width: 50%;">
                                        <option value="">-- เลือกทำนองเพลง --</option>
                                        <?php 
                                          $sql_tune = "SELECT id_tune,name_tune FROM song_tune";
                                          $objq_tune = mysqli_query($conn,$sql_tune);
                                          while($value_tune = $objq_tune->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $value_tune['id_tune'];?>"><?php echo $value_tune['name_tune'];?></option>
                                        <?php    
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div align="center" class="box-footer">
                          <button type="submit" class="btn btn-success">ตกลง</button>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane" id="search_artist">
                      <form action="song_list2.php" class="form-horizontal" method="get" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <div class="row">
                                <div class="col-2 col-sm-2 col-md-2"></div>
                                <div class="col-8 col-sm-8 col-md-8">
                                  <div class="text-center">
                                    <B><font size="5">ค้นหาเพลง (นักร้อง)</font></B>
                                  </div>
                                  <br>
                                  <div class="form-group">
                                    <label class="col-sm-4 control-label"><font size="4">ยุค</font></label>
                                    <div class="col-sm-8">
                                      <select name="id_ageartist" id="id_ageartist" class=" form-control" style="width: 50%;">
                                        <option value="">-- เลือกยุคนักร้อง --</option>
                                        <?php 
                                          while($value = $objq_ageartist->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $value['id_ageartist'];?>"><?php echo $value['name_ageartist'];?></option>
                                        <?php    
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-sm-4 control-label"><font size="4">ชาย / หญิง</font></label>
                                    <div class="col-sm-8">
                                      <select name="id_sexartist" onchange="sSelect(this.value)" class="form-control" style="width: 50%;">
                                        <option value="">-- เลือกเพศนักร้อง --</option>
                                        <?php 
                                          while($value = $objq_sexartist2->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $value['id_sexartist'];?>"><?php echo $value['name_sexartist'];?></option>
                                        <?php    
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-sm-4 control-label"><font size="4">นักร้อง</font></label>
                                    <div class="col-sm-8">
                                      <select name="id_artist" id="id_artist" class=" form-control" style="width: 50%;"></select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div align="center" class="box-footer">
                          <button type="submit" class="btn btn-success">ตกลง</button>
                        </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="add_song" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="algorithm/add_song2.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                      <font size="5"><B> เพิ่มเพลง </B></font>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                        <div class="col-6 col-sm-6 col-xl-6 col-md-6">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ชื่อเพลง</font></th>
                                <th class="text-center" width="70%"> 
                                  <input type="text" name="name_song" class="form-control" style="width: 100%;">
                                </th>
                              </tr>
                              <tr>  
                                <th class="text-center" width="30%"><font size="4">นักร้อง</font></th>
                                <th class="text-center" width="70%"> 
                                  <select name="id_artist" class=" form-control" style="width: 100%;">
                                    <option value="">-- เลือกศิลปิน --</option>
                                    <?php 
                                      $sql_artist = "SELECT id_artist,name_artist FROM song_artist";
                                      $objq_artist = mysqli_query($conn,$sql_artist);
                                      while($value_artist = $objq_artist->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value_artist['id_artist'];?>"><?php echo $value_artist['name_artist'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                </th>
                              </tr>
                              <tr>  
                                <th class="text-center" width="30%"><font size="4">ยุค</font></th>
                                <th class="text-center" width="70%"> 
                                  <select name="id_age" class=" form-control" style="width: 100%;">
                                    <option value="">-- เลือกยุคเพลง --</option>
                                    <?php 
                                      $sql_age = "SELECT id_age,name_age FROM song_age";
                                      $objq_age = mysqli_query($conn,$sql_age);
                                      while($value_age = $objq_age->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value_age['id_age'];?>"><?php echo $value_age['name_age'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ทำนอง</font></th>
                                <th class="text-center" width="70%"> 
                                <select name="id_tune" class=" form-control" style="width: 100%;">
                                    <option value="">-- เลือกทำนอง --</option>
                                    <?php 
                                      $sql_tune = "SELECT id_tune,name_tune FROM song_tune";
                                      $objq_tune = mysqli_query($conn,$sql_tune);
                                      while($value_tune = $objq_tune->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value_tune['id_tune'];?>"><?php echo $value_tune['name_tune'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ต้นฉบับ</font></th>
                                <th class="text-center" width="70%"> 
                                <select name="script" class=" form-control" style="width: 100%;">
                                    <option value="">-- เลือกต้นฉบับ --</option>
                                    <option value="Y">ใช่</option>
                                    <option value="N">ไม่ใช่</option>
                                  </select>
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">เกรด</font></th>
                                <th class="text-center" width="70%"> 
                                <select name="melodic" class=" form-control" style="width: 100%;">
                                    <option value="">-- เลือกเกรด --</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                  </select>
                                </th>
                              </tr>
                            </tbody>
                          </table> 
                        </div>
                        <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit"  class="btn btn-success pull-right" OnClick="return confirm('ต้องการบันทึกรายการเพลงหรือไม่ ?')";>บันทึก</button>
                    <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="modal fade" id="add_artist" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="algorithm/add_artist2.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                      <font size="5"><B> เพิ่มนักร้อง </B></font>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                        <div class="col-6 col-sm-6 col-xl-6 col-md-6">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ชื่อนักร้อง</font></th>
                                <th class="text-center" width="70%"> 
                                  <input name="name_artist" class="form-control" style="width: 100%;">
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ยุคนักร้อง</font></th>
                                <th class="text-center" width="70%"> 
                                  <select name="id_ageartist" class="form-control" style="width: 100%;">
                                    <option value="">-- เลือกยุคนักร้อง --</option>
                                    <?php 
                                      while($value = $objq_ageartist2->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value['id_ageartist'];?>"><?php echo $value['name_ageartist'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">เพศนักร้อง</font></th>
                                <th class="text-center" width="70%"> 
                                  <select name="id_sexartist" class="form-control" style="width: 100%;">
                                    <option value="">-- เลือกเพศนักร้อง --</option>
                                    <?php 
                                      while($value = $objq_sexartist3->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value['id_sexartist'];?>"><?php echo $value['name_sexartist'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                </th>
                              </tr>
                            </tbody>
                          </table> 
                        </div>
                        <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit"  class="btn btn-success pull-right" OnClick="return confirm('ต้องการบันทึกรายการเพลงหรือไม่ ?')";>บันทึก</button>
                    <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <?php require("../menu/footer.html"); ?>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js">
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js">
    </script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js">
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js">
    </script>
    <script src="../plugins/iCheck/icheck.min.js">
    </script>
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : false
        }
        )
      });

      function sSelect(value){
        var id_ageartist = $('#id_ageartist'). val()
              $.ajax({
                        type:"POST",
                        url:"select_artist.php",
                        data:{value:value,id_ageartist:id_ageartist},
                        success:function(data){
                          $("#id_artist").html(data);
                          console.log(data);
                        }
                    });
    
                return false;
                }
    </script>
</body>

</html>