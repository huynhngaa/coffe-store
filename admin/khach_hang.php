<?php include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 <?php include "head.php" ?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include "nav.php" ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include "side.php" ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
       
            <!-- Quick Action Toolbar Starts-->
          
            <!-- Quick Action Toolbar Ends-->
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  
                    <div class="row report-inner-cards-wrapper">
                      <div class=" col-md -6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Quản Lý</span>
                          <h4>$32123</h4>
                          
                        </div>
                        <div class="inner-card-icon bg-success">
                          <i class="icon-rocket"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Nhân Viên Pha Chế</span>
                          <h4>95,458</h4>
                       
                        </div>
                        <div class="inner-card-icon bg-danger">
                          <i class="icon-briefcase"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Nhân Viên Đứng Quầy</span>
                          <h4>2650</h4>
                          
                        </div>
                        <div class="inner-card-icon bg-warning">
                          <i class="icon-globe-alt"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">RETURN</span>
                          <h4>25,542</h4>
                          
                        </div>
                        <div class="inner-card-icon bg-primary">
                          <i class="icon-diamond"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Danh Sách Khách Hàng</h4>
            
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr> 
                          <th class="font-weight-bold">Mã</th>
                          <th class="font-weight-bold">Hình</th>
                          <th class="font-weight-bold">Tên</th>
                         <th class="font-weight-bold">Username</th>
                          <th class="font-weight-bold">SDT</th>
                          <th class="font-weight-bold">Địa chỉ</th>
                          <th class="font-weight-bold">Điểm tích lũy</th>
                          <th class="font-weight-bold"> Hành động </th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                        
                        $sql = " SELECT * FROM tai_khoan t, khach_hang n WHERE t.makh = n.ma  AND role=1  ";
                        $result = $conn->query($sql);
                          while($row = $result->fetch_assoc()) {
                                ?>
                        <tr>
                          <td><?php echo $row['ma']?></td>
                          <td class="py-1">
                            <img src="../img/<?php echo $row['hinh_kh']?>" alt="image" />
                          </td>
                          <td><?php echo $row['ten']?></td>
                          <td > <?php echo $row['ten_dang_nhap']?> </td>
                          <td>
    <?php
    if ($row['so_dien_thoai'] !== '') {
        echo $row['so_dien_thoai'];
    } else {
        echo '<em style="font-style: italic;">Chưa có dữ liệu</em>';
    }
    ?>
</td>

<td>
    <?php
     if ($row['dia_chi'] !== '' && $row['dia_chi'] !== null) {
        echo $row['dia_chi'];
    } else {
        echo '<em style="font-style: italic;">Chưa có dữ liệu</em>';
    }
    ?>
</td>
                          <td><?php echo $row['diem_tich_luy']?></td>
                         
                          <td>
    <a href="link-xem">
        <i class="fa-solid fa-eye text-success"></i>
    </a>
    &nbsp;
    <a href="link-sua">
        <i class="fa-solid fa-pen text-warning"></i>
    </a>
    &nbsp;
    <a href="link-xoa">
        <i class="fa-solid fa-trash text-danger"></i>
    </a>
</td>                        </tr>
<?php } ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
     



          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>















