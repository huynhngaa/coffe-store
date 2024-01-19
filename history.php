<?php
session_start();
include "connect.php";

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
}

// Initialize the total variable
$totalCartValue = 0;
?>

<!DOCTYPE html>
<html lang="zxx">
<?php include "head.php" ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>

    <!-- Humberger End -->
    <?php include "menu-mb.php" ?>
    <!-- Header Section Begin -->
    <?php include "header.php" ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                </div>

                <?php include "search.php" ?>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/shop2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Rohan Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Trang Chủ</a>
                            <span>Lịch Sử Đặt Hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad" id="cart-section">
        <div class="container">

            <div class="row ">
                <?php
                // Get the user's ID from the session
                $customer = $_SESSION['login'];
                $id = $customer['ma'];

                // Query to retrieve order history for the logged-in user
                $sql = "SELECT ct.*, ol.* FROM chi_tiet_order_online ct
                JOIN oder_online ol ON ct.madon = ol.ma
                JOIN khach_hang k ON ct.makh = k.ma
                JOIN thuc_uong t ON t.ma = ct.mathucuong
                WHERE makh = '$id'
                GROUP by ma
                order by ma desc";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="col-lg-3 col-md-5 mb-4 border border-secondary rounded-left">
                        <div class="sidebar">
                            <div class="sidebar__item">
                                <h4>Đơn Hàng #<?php echo $row['ma'] ?>   <a href="export_invoice.php?order_id=<?php echo $row['ma']; ?>" target="_blank" class="badge badge-pill badge-success"><i class="fa fa-print" aria-hidden="true"></i></a></h4>
                                <ul>
                              

                                    <li><a href="#"><b>Họ Tên:</b> <?php echo $row['ten_khach_hang'] ?></a></li>
                                    <li><a href="#"><b>SDT:</b> <?php echo $row['so_dien_thoai'] ?></a></li>
                                    <li><a href="#"><b>Địa chỉ:</b> <?php echo $row['dia_chi'] ?></a></li>
                                    <li><a href="#"><b>Ghi Chú:</b> <?php echo !empty($row['ghi_chu']) ? $row['ghi_chu'] : '<em>Không có ghi chú</em>' ?></a></li>
                                    <li><a href="#"><b>PT thanh toán:</b> <?php echo $row['hinhthuctt'] ?></a></li>
                                    <li><a href="#"><b>Ngày đặt:</b><?php
$ngaydat = $row['ngaydat']; // Ngày và giờ từ $row['ngaydat']
$ngaydat_formatted = date('H:i:s - d/m/Y ', strtotime($ngaydat)); // Định dạng lại ngày giờ
?>

<!-- Hiển thị ngày giờ đã định dạng -->
 <?php echo $ngaydat_formatted; ?>
 </a></li>

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
}
?>

<li>
    <a href="#">
    <b>Trạng thái: </b> <span class="<?php echo $badgeClass; ?>"><?php echo $trangthaiText; ?></span>
    </a>
</li>

<form action="cancel.php" method="post">
    <input name="ma" type="hidden" value="<?php echo $row['ma'] ?>">
    <li class="bot-0">
    <a href="#">
        <?php if ($row['trangthai'] == 0): ?>
            <button type="submit" name="cancel" class="btn primary-btn">Hủy đơn</button>
        <?php elseif ($row['trangthai'] == 2): ?>
            <button type="submit" name="review" class="btn primary-btn">Đánh giá</button>
        <?php endif; ?>
    </a>
</li>
</form>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9  mb-4 border border-secondary rounded-right" >
                        <div class="shoping__cart__table">
                            <table class="table table-borderless table-hover ">
                                <thead class="table-warning">
                                    <tr>
                                    <th>STT</th>
                                        <th>Hình</th>
                                        <th>Tên</th>
                                        <th>Đơn Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query to retrieve order details
                                    $order_id = $row['madon'];
                                    $order_detail_sql = "SELECT * FROM chi_tiet_order_online ct , thuc_uong t  
                                    WHERE ct.mathucuong =t.ma and madon = '$order_id'";
                                    $order_detail_result = $conn->query($order_detail_sql);
                                    $stt = 0;
                                    while ($order_detail_row = $order_detail_result->fetch_assoc()) {
                                        $stt++;
                                    ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo  $stt ?></td>
                                            <td class="col-1">
                <a href="shop-details.php?id=<?php echo  $order_detail_row['ma']; ?>">
                    <img src="img/<?php echo  $order_detail_row['hinh_anh']; ?>" alt="">
                </a>
            </td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo $order_detail_row['ten'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($order_detail_row['gia']) ?> đ</td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo $order_detail_row['so_luong'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($order_detail_row['thanh_tien']) ?> đ</td>
                                        </tr>
                                        
                                    <?php
                                    }
                                    ?>
                                      <tr>
      <th scope="row"></th>
      <td colspan="3"></td>
      <td><h6><b> Ship</b></h6></td>
      <td style="text-align: center; vertical-align: middle;"><h6 class="text-danger"><b><?php echo number_format($row['ship']) ?> đ</b></h6></td>
    </tr>
                                    <tr>
      <th scope="row"></th>
      <td colspan="3"></td>
      <td><h5><b> Tổng Cộng</b></h5></td>
      <td style="text-align: center; vertical-align: middle;"><h5 class="text-danger"><b><?php echo number_format($row['thanhtien']) ?> đ</b></h5></td>
    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                    </div> 
                <?php
                }
                ?>
                
            </div>

        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <?php include "footer.php" ?>

</body>

</html>
