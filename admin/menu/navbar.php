<aside class="main-sidebar" style="background: rgba(179, 255, 255, 0.1)";>
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="../dist/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $username;?></p><br>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
    </form>


    <!-- จัดการข้อมูลผู้ใช้น้ำประปา  -->
    <ul class="sidebar-menu" data-widget="tree">
        <!-- สต๊อกสินค้า   -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text-o"></i> <span>สต๊อกสินค้า</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="total_stock.php" ><i class="fa fa-home"></i> สต๊อกรวม </a></li>
                <li><a href="car_stock.php" ><i class="fa fa-truck"></i> สต๊อกรถ </a></li>
            </ul>
        </li>
        
    </ul>

    <form action="#" method="get" class="sidebar-form">
    </form>

    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview ">
            <a href="#">
                <i class="fa fa-group"></i> <span>เบิก-คืน สินค้า</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <!--เบิกสินค้า -->
                <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-archive"></i> เบิกสินค้า </a></li>
                <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                <!--//เบิกสินค้า -->
                <li><a href="manage_customer/check_customer.php"><i class="fa fa-circle-o"></i>คืนสินค้า</a></li>
            </ul>
        </li>

        <!-- จัดการข้อมูลเจ้าหน้าที่   -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> <span>ระบบจัดการข้อมูลเจ้าหน้าที่</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="manage_employee/edit_employee.php"><i class="fa fa-circle-o"></i>จัดการเเก้ไขข้อมูลเจ้าหน้าที่</a></li>
                <li><a href="manage_employee/insert_employee.php"><i class="fa fa-circle-o"></i>เพิ่มรายชื่อเจ้าหน้าที่</a></li>
            </ul>
        </li>
        <!-- ข้อมูลสถิติ  -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart"></i> <span>ข้อมูลสถิติ</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="manage_statistic/statistic_use_water.php"><i class="fa fa-circle-o"></i>สถิติใช้น้ำ</a></li>
            </ul>
        </li>
    </ul>
</section>
</aside>