    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
<!--       <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
 -->      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li class="active">
          <a href="<?= base_url() ?>">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>customer/list">
                <i class="fa fa-user-circle"></i><span>Manage Customers</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>customer/list/?q=1">
                <i class="fa fa-user-circle"></i><span>Purchase History</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>customer/list/?q=1">
                <i class="fa fa-user-circle"></i><span>Promotions</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>customer/loyalty/?q=1">
                <i class="fa fa-clock-o"></i><span>Loyalty Program</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>employee/add">
                <i class="fa fa-user-circle-o"></i><span>New Employee</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>employee/list/?q=1">
                <i class="fa fa-user-circle"></i><span>Manage Employee</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>employee/shift/?q=1">
                <i class="fa fa-clock-o"></i><span>Manage Shifts</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>employee/attandance/?q=1">
                <i class="fa fa-book"></i><span>Attandance</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="header">SYSTEM</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>System Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-user"></i>My Account</a></li>
            <li>
              <a href="#">
                <i class="fa fa-users"></i><span>Users</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-address-card"></i> Access Levels                  
              </a>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Modules
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="https://adminlte.io/docs">
            <i class="fa fa-question-circle"></i> <span>Help</span>
          </a>
        </li>
        <li>
          <a href="https://adminlte.io/docs">
            <i class="fa fa-info-circle"></i> <span>About</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->