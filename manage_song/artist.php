<?php
  require "../config_database/config.php";
  $sql_ageartist = "SELECT id_ageartist,name_ageartist FROM song_ageartist";
  $objq_ageartist = mysqli_query($conn,$sql_ageartist);

  $sql_sexartist = "SELECT id_sexartist,name_sexartist FROM song_sexartist";
  $objq_sexartist = mysqli_query($conn,$sql_sexartist);
?>
<!DOCTYPE html>
<html>

<?php require 'menu/header.php'; ?>

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
                <a class="active" href="artist.php"> ค้นหา </a>
                <a href="song_old.php"> เก่า </a>
                <a href="song_middle.php"></i> กลาง </a>
                <a href="song_new.php"> ใหม่ </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
                <a href="song_setting.php"> เพลง </a>
                <a href="artist_setting.php"> นักร้อง </a>
                <a href="song_setting2.php"> แก้ไข </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="text-center">
                  <font size="5">
                    <B align="center"> ค้นหาเพลง (นักร้อง) <font color="red"> </font></B>
                  </font>
                </div>
              </div>
              <form action="song_list.php" class="form-horizontal" method="get" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                <div class="box-body">
                  <div class="mailbox-read-message">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-2 col-sm-2 col-md-2"></div>
                        <div class="col-8 col-sm-8 col-md-8">
                          <div class="form-group">
                            <label class="col-sm-4 control-label"><font size="4">ยุค</font></label>
                            <div class="col-sm-8">
                              <select name="id_ageartist" onchange="sSelect2(this.value)" id="id_ageartist" class=" form-control" style="width: 50%;">
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
                              <select name="id_sexartist" onchange="sSelect(this.value)" id="id_ageartist" class="form-control" style="width: 50%;">
                                <option id="test" value="">-- เลือกเพศนักร้อง --</option>
                                <?php 
                                  while($value = $objq_sexartist->fetch_assoc()){
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
      </section>
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
      function sSelect(value){
        var id_ageartist = $('#id_ageartist').val()
            $.ajax({
                type:"POST",
                url:"algorithm/select_artist.php",
                data:{value:value,id_ageartist:id_ageartist},
                success:function(data){
                  $("#id_artist").html(data);
                }
            });
        return false;
      };

      function sSelect2(value){
        document.getElementById("test").selected = "true";
            $.ajax({
                type:"POST",
                url:"algorithm/select_artist2.php",
                data:{value:value},
                success:function(data){
                  $("#id_artist").html(data);
                }
            });
        return false;
      }
    </script>
  </body>

</html>