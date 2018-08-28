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

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li>
          <a href="<?= base_url() ?>">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>products/add">
                <i class="fa fa-user-circle"></i><span>Manage Orders</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>products/list/?q=1">
                <i class="fa fa-user-circle"></i><span>Track Orders</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-trophy"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>products/list/?q=1">
                <i class="fa fa-trophy"></i><span>Products</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>products/list/?q=1">
                <i class="fa fa-star"></i><span>Featured Products</span>
              </a>
            </li>
            <li >
              <a href="<?= base_url() ?>">
                <i class="fa fa-money"></i><span>Pricing</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>product_tag/list?q=1">
                <i class="fa fa-file-image-o"></i><span>Images</span>
              </a>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Product Settings</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="<?= base_url() ?>product_category/list/?q=1">
                      <i class="fa fa-list-ol"></i><span>Categories</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>product_tag/list?q=1">
                      <i class="fa fa-tags"></i><span>Tags</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>product_colors/list?q=1">
                      <i class="fa fa-eyedropper"></i><span>Colors</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>product_colors/list?q=1">
                      <i class="fa fa-expand"></i><span>Sizes</span>
                    </a>
                  </li>
                </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gift"></i> <span>Promotion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>products/add">
                <i class="fa fa-send-o"></i><span>New Promotions</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>products/list/?q=1">
                <i class="fa fa-tags0 "></i><span>Manage Promotions</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>products/list/?q=1">
                <i class="fa fa-user-circle"></i><span>Promotion Settings</span>
              </a>
            </li>
          </ul>
        </li>

        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Manage Site Content</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>customer/list">
                <i class="fa fa-user-circle"></i><span>Header</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>customer/list/?q=1">
                <i class="fa fa-user-circle"></i><span>Footer</span>
              </a>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-user-circle"></i> <span>Pages</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="<?= base_url() ?>product_category/list/?q=1">
                      <i class="fa fa-user-circle"></i><span>Home</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>product_tag/list?q=1">
                      <i class="fa fa-user-circle"></i><span>Shop</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>product_tag/list?q=1">
                      <i class="fa fa-user-circle"></i><span>Cart</span>
                    </a>
                  </li>
                </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>employee/add">
                <i class="fa fa-user-circle-o"></i><span>Online Orders</span>
              </a>
            </li>
          </ul>
        </li>
        -->

        <li class="header">ADMINISTRATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?= base_url() ?>user/add">
                <i class="fa fa-user-plus"></i><span>New Users</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>user/list/?q=1">
                <i class="fa fa-users"></i><span>Manage Users</span>
              </a>
            </li>
            <li>
              <a href="<?= base_url() ?>positions/list/?q=1">
                <i class="fa fa-vcard"></i><span>Positions</span>
              </a>
            </li>
            <li >
              <a href="<?= base_url() ?>">
                <i class="fa fa-lock"></i><span>Permissions</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="header">SYSTEM SETTINGS</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
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
        </li>
        <li >
          <a href="<?= base_url() ?>/process/logout">
            <i class="fa fa-sign-out"></i><span>Sign Out</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->