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
                  <?php
              
              $sql = "SELECT count(*) as tongdon, sum(thanhtien) as thanhtien from oder_online ";
              $sql1 = "SELECT count(*) as hoanthanh from oder_online  WHERE trangthai = 2"; 
              $sql2 = "SELECT count(*) as xuly from oder_online  WHERE trangthai = 0"; 
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              $result2= $conn->query($sql2);
              $row2 = $result2->fetch_assoc();
              $result1 = $conn->query($sql1);
              $row1 = $result1->fetch_assoc();
              ?>
                    <div class="row report-inner-cards-wrapper">
                      <div class=" col-md-6 col-sm-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">TỔNG ĐƠN</span>
                          <h4><?php echo $row['tongdon'] ?></h4>
                          
                        </div>
                        <div class="inner-card-icon bg-success">
                          <i class="icon-rocket"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">DOANH THU</span>
                          <h4><?php echo number_format(  $row['thanhtien'] ) ?> đ</h4>
                          
                        </div>
                        <div class="inner-card-icon bg-danger">
                          <i class="icon-briefcase"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">ĐƠN HOÀN THÀNH</span>
                          <h4><?php echo $row1['hoanthanh'] ?></h4>
                          
                        </div>
                        <div class="inner-card-icon bg-warning">
                          <i class="icon-globe-alt"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">ĐƠN CHỜ XỬ LÝ</span>
                          <h4><?php echo $row2['xuly'] ?></h4>
                        
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
                    <h4 class="card-title">Danh Sách Đơn Hàng</h4>
                  
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="font-weight-bold">Mã đơn</th>
                          <th class="font-weight-bold">Tên Khách Hàng</th>
                          <th class="font-weight-bold">SDT</th>
                          <th class="font-weight-bold">Thành Tiền</th>
                          <th class="font-weight-bold">Ngày Đặt</th>
                          <th class="font-weight-bold">Ghi Chú</th>
                          <th class="font-weight-bold">Trạng Thái</th>
                          <th class="font-weight-bold">Hành Động</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
              
                $sql = "SELECT ct.*, ol.* FROM chi_tiet_order_online ct
                JOIN oder_online ol ON ct.madon = ol.ma
                JOIN khach_hang k ON ct.makh = k.ma
                JOIN thuc_uong t ON t.ma = ct.mathucuong
               
                GROUP by ma
                order by ma desc";

                $result = $conn->query($sql);
                $stt = 0;
                while ($row = $result->fetch_assoc())
                 {
                  $stt ++;
                ?>
                        <tr>
                          <td>#<?php echo $row['ma'] ?></td>
                          <td> <?php echo $row['ten_khach_hang'] ?></td>
                          <td><?php echo $row['so_dien_thoai'] ?></td>
                          <td class="text-danger"><b> <?php echo number_format( $row['thanhtien']) ?> đ </b></td>
                          <td><?php $ngaydat = $row['ngaydat'];
$ngaydat_formatted = date('H:i:s  -  d/m/Y ', strtotime($ngaydat)); 
?>

<!-- Hiển thị ngày giờ đã định dạng -->
 <?php echo $ngaydat_formatted; ?></td>

 <td><?php echo !empty($row['ghi_chu']) ? $row['ghi_chu'] : '<em>Không có ghi chú</em>' ?></td>
                          <?php
                            
                            $badgeClass = '';
                            $trangthaiText = '';
                            $trangthai = $row['trangthai'];
                            switch ($trangthai) {
                                case 0:
                                    $badgeClass = 'badge badge-info'; // Đang xử lý
                                    $trangthaiText = 'Đang xử lý';
                                    break;
                                case 1:
                                    $badgeClass = 'badge badge-warning'; // Đang giao
                                    $trangthaiText = 'Đang giao';
                                    break;
                                case 2:
                                    $badgeClass = 'badge badge-success'; // Hoàn thành
                                    $trangthaiText = 'Hoàn thành';
                                    break;
                                case 3:
                                    $badgeClass = 'badge badge-danger'; // Đã hủy
                                    $trangthaiText = 'Đã hủy';
                                    break;
                                default:
                                    $badgeClass = 'badge badge-secondary'; // Không xác định
                                    $trangthaiText = 'Không xác định';
                            } ?>
                          
                            <td><label class="<?php echo $badgeClass; ?>">    <?php echo $trangthaiText; ?></label></td>
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
</td>            
                        </tr>
                       
                     
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















