
<?php 
session_start(); 
include "connect.php";
      
$this_id = $_GET['order_id'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Rohan Shop</title>
    <link rel="shortcut icon" href="img/title.png" />
    <link rel="stylesheet" type="text/css" href="print.css" media="print">
	<!-- <link rel="stylesheet" type="text/css" href="style.css">   -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body class="container">
   
	<div id="hoa_don">
        <header>
             <br><br>
            <h1 class="text-center">Hoá đơn đặt hàng</h1>
        </header>
        <?php
                

                // Query to retrieve order history for the logged-in user
                $sql = "SELECT ct.*, ol.* FROM chi_tiet_order_online ct
                JOIN oder_online ol ON ct.madon = ol.ma
                JOIN khach_hang k ON ct.makh = k.ma
                JOIN thuc_uong t ON t.ma = ct.mathucuong
                WHERE ol.ma = '$this_id'
                ";

                $result = $conn->query($sql);

                $row = $result->fetch_assoc();
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
        <section >
         
        <div class="row">
    <div class="col-md-6">
        <h4>Đơn Hàng #<?php echo $row['ma'] ?> </h4>
        <p><strong>Họ Tên:</strong> <?php echo $row['ten_khach_hang'] ?></p>
        <p><strong>SDT:</strong> <?php echo $row['so_dien_thoai'] ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo $row['dia_chi'] ?></p>
    </div>
    <div class="col-md-6">
        <p><strong>Ghi Chú:</strong> <?php echo !empty($row['ghi_chu']) ? $row['ghi_chu'] : '<em>Không có ghi chú</em>' ?></p>
        <p><strong>Ngày đặt:</strong>
            <?php
            $ngaydat = $row['ngaydat']; // Ngày và giờ từ $row['ngaydat']
            $ngaydat_formatted = date('H:i:s - d/m/Y ', strtotime($ngaydat)); // Định dạng lại ngày giờ
            echo $ngaydat_formatted;
            ?>
        </p>
        <p><strong>Trạng thái:</strong> <span class="<?php echo $badgeClass; ?>"><?php echo $trangthaiText; ?></span></p>
    </div>
</div>

            
        </section>

        <section>
            <h2>Thông tin tour du lịch</h2>

            <table class="table table-bordered">
  <thead>
    <tr>
                    <th style="text-align: center">STT</th>
                                        <th style="text-align: center">Hình</th>
                                        <th style="text-align: center">Tên</th>
                                        <th style="text-align: center">Đơn Giá</th>
                                        <th style="text-align: center">Số Lượng</th>
                                        <th style="text-align: center">Thành Tiền</th>
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
                                            <td style="width: 10px">
    <a href="shop-details.php?id=<?php echo $order_detail_row['ma']; ?>">
        <img src="img/<?php echo $order_detail_row['hinh_anh']; ?>" alt="" style="max-width: 100px; max-height: 100px;">
    </a>
</td>

                                            <td style="text-align: center; vertical-align: middle;"><?php echo $order_detail_row['ten'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($order_detail_row['gia']) ?> đ</td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo $order_detail_row['so_luong'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($order_detail_row['thanh_tien']) ?> đ</td>
                                        </tr>
 <?php } ?>
  </tbody>
</table>

            
        </section>

        <section>
           
      <h5 style="text-align: center; vertical-align: middle;"><b> Tổng Cộng</b>
      <span ><h5 class="text-danger"><b><?php echo number_format($row['thanhtien']) ?> đ</b></h5> </span>
  </h5>
        </section>
    </div>
    <div class="mt-3" style="display: flex; justify-content: center; align-items: center;">
    <button onclick="window.print();" class="btn btn-primary"  id="print-btn">IN HÓA ĐƠN</button>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<!-- <script>
$(document).ready(function () {  
    var form = $('#hoa_don'),  
    cache_width = form.width(),  
    a4 = [595.28, 841.89]; // for a4 size paper width and height  

    $('#create_pdf').on('click', function () {  
        $('body').scrollTop(0);  
        createPDF();  
    });  

    function createPDF() {  
        getCanvas().then(function (canvas) {  
            var  
             img = canvas.toDataURL("image/png"),  
             doc = new jsPDF({  
                 unit: 'px',  
                 format: 'a4'  
             });  
            doc.addImage(img, 'JPEG', 20, 20);  
            doc.save('hoa-don-dat-tour-<?=date("d-m-Y")?>.pdf');  
            form.width(cache_width);  
        });  
    }  

    function getCanvas() {  
        form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');  
        return html2canvas(form, {  
            imageTimeout: 2000,  
            removeContainer: true  
        });  
    }
});
</script> -->