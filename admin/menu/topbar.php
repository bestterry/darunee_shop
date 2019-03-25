
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="../dist/img/user.png" class="user-image" alt="User Image">
        <span class="hidden-xs"><?php echo $username; ?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="../dist/img/user.png" class="img-circle" alt="User Image">

            <p>
                <?php echo $username;?>
                <small>พนักงาน</small>
            </p>
        </li>
        <!-- Menu Body -->

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <a href="../login/logout.php" class="btn btn-default btn-flat">ออกจากระบบ</a>
            </div>
        </li>
    </ul>
</li>