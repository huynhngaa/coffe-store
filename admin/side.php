<?php $admin = $_SESSION['admin']; ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="../img/<?php echo $admin['hinhnv']?>" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $admin['ten'] ?></p>
                  <p class="designation <?php echo ($admin['role'] == 2) ? 'admin' : '' ?>"><?php echo ($admin['role'] == 2) ? 'Admin' : $admin['role'] ?></p>

                </div>
                <div class="icon-container">
                  <i class="icon-bubbles"></i>
                  <div class="dot-indicator bg-danger"></div>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">Dashboard</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">Quản Lý</span></li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Đơn Hàng</span>
                <!-- <i class="s menu-icon"></i> -->
                <i class="menu-icon fa-solid fa-truck-fast"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="them_don_hang.php">Thêm Đơn Hàng</a></li>
                  <li class="nav-item"> <a class="nav-link" href="don_hang.php">Danh Sách Đơn Hàng</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Khách Hàng</span>
               
                <i class="menu-icon fa-solid fa-user"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="them_khach_hang.php">Thêm Khách Hàng</a></li>
                  <li class="nav-item"> <a class="nav-link" href="khach_hang.php">Danh Sách Khách Hàng</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Nhân Viên</span>
                <!-- <i class=" menu-icon"></i> -->
                <i class="menu-icon fa-solid fa-user-tie"></i>
              </a>
              <div class="collapse" id="ui-basic3">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="them_nhan_vien.php">Thêm Nhân Viên</a></li>
                  <li class="nav-item"> <a class="nav-link" href="nhan_vien.php">Danh Sách Nhân Viên</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
                <span class="menu-title">Loại Thức Uống</span>
               
                <i class="menu-icon fa-solid fa-mug-saucer"></i>
              </a>
              <div class="collapse" id="ui-basic4">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="them_loai.php">Thêm Loại Thức Uống</a></li>
                  <li class="nav-item"> <a class="nav-link" href="loai_thuc_uong.php">Danh Sách Loại Thức Uống</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
                <span class="menu-title">Thức Uống</span>
                <!-- <i class="menu-icon"></i> -->
                <i class="menu-icon fa-solid fa-martini-glass"></i>
              </a>
              <div class="collapse" id="ui-basic5">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="them_thuc_uong.php">Thêm Thức Uống</a></li>
                  <li class="nav-item"> <a class="nav-link" href="thuc_uong.php">Danh Sách Thức Uống</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.php">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.php">Typography</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/icons/simple-line-icons.php">
                <span class="menu-title">Icons</span>
                <i class="icon-globe menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.php">
                <span class="menu-title">Form Elements</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartist.php">
                <span class="menu-title">Charts</span>
                <i class="icon-chart menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.php">
                <span class="menu-title">Tables</span>
                <i class="icon-grid menu-icon"></i>
              </a>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">Sample Pages</span></li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">General Pages</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.php"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.php"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.php"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.php"> 500 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.php"> Blank Page </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item pro-upgrade">
              <span class="nav-link">
                <a class="btn btn-block px-0 btn-rounded btn-upgrade" href="https://www.bootstrapdash.com/product/stellar-admin-template/" target="_blank"> <i class="icon-badge mx-2"></i> Upgrade to Pro</a>
              </span>
            </li>
          </ul>
        </nav>