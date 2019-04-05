<nav class="navbar navbar-static-top">
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
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
                    <?php echo $username; ?>
                    <small>ADMIN</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="../login/logout.php" class="btn btn-default btn-flat">ออกจากระบบ</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>