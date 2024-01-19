<?php
session_start(); 
include "connect.php";

?>
<!DOCTYPE html>
<html lang="zxx">


<?php include "head.php" ?>
<body>
    <style>
        /* Basic styling for the circular button */
.circular-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px; /* Set the desired width and height for your circular button */
    height: 40px;
    border: none;
    background-color: #113946; /* Set the background color */
    color: #fff; /* Set the text color */
    border-radius: 50%; /* Makes it circular */
    cursor: pointer;
    transition: background-color 0.3s; /* Add a smooth transition for hover effect */
}

/* Hover effect */
.circular-button:hover {
    background-color: #1b6e89; /* Change the background color on hover */
}

    </style>
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

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
        <div class="row">
            <div class="col-lg-2">
            </div>
                
            <style>
    .product-image {
    /* max-width: 80px;
    max-height: 80px; */
    
    width: 60px;
    height:  60px;
}
.suggestions {
    /* border: solid 2px #a3a3a3bf; */
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    border-bottom-left-radius: 10px;

border-bottom-right-radius: 10px;
    /* margin-top: -28px; */
    width: 700px;
    max-height: 240px; /* Đặt chiều cao tối đa là 100px */
    overflow-y: auto; /* Hiển thị thanh kéo khi nội dung vượt quá chiều cao tối đa */
}
/* Thiết lập màu chữ mặc định (màu đen) */
.suggestion span {
    color: black;
}

/* Thiết lập màu chữ khi hover (màu xám) */
.suggestion:hover {
    background-color:  #ebe8e8;
}
/* Tùy chỉnh biểu tượng kính lúp */



</style>
<div class="col-lg-10">
    <div class="hero__search">
        <div class="hero__search__form">
            <form action="shop-grid.php" method="post">
                <input id="search" name="search" type="text" placeholder="Bạn muốn tìm bài viết gì?">
                <button type="submit" class="site-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            
        </div>
      
       
        <div class="hero__search__phone">
            <div class="hero__search__phone__icon">
                <i class="fa fa-phone"></i>
            </div>
            <div class="hero__search__phone__text">
                <?php
                $sql = "SELECT * FROM cua_hang";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <h5><?php echo $row['sdt'] ?></h5>
                <span>Hỗ trợ 24/7</span>
            </div>
        </div>
      
    </div>
    <div style="z-index: 1;position: absolute; background-color:#fff" id="product-suggestions" class="suggestions"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#search").on("input", function() { // Sự kiện input thay vì keyup
        var query = $(this).val();
        
        if (query.length >= 1) {
            $.ajax({
                url: "search-blog.php",
                method: "POST",
                data: { query: query },
                success: function(data) {
                    $("#product-suggestions").html(data);
                }
            });
        } else {
            $("#product-suggestions").html("");
        }
    });
});
</script>

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
                        <h2>Bài Viết</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Trang Chủ</a>
                            <span>Bài Viết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 col-md-7">
                    <div class="row">
                    <?php
              
                $sql = "SELECT* from bai_viet b , nhan_vien n  where b.ma_nv = n.ma";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                ?>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="blog__item">
                            <div style="width: 100; /* Kích thước khung hình cố định */
    height: 200px;
    overflow: hidden; " class="blog__item__pic">
    <div style=" width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;" class="image-container">
        <img style="  object-fit: cover; /* Cắt và căn giữa ảnh */
    width: 100%;
    height: 100%;" src="img/<?php echo $row['hinh_minh_hoa'] ?>" alt="">
    </div>
</div>

                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i><?php
$ngaydat = $row['ngay_dang']; // Ngày và giờ từ $row['ngaydat']
$ngaydat_formatted = date('H:i:s - d/m/Y ', strtotime($ngaydat)); // Định dạng lại ngày giờ
?>

<!-- Hiển thị ngày giờ đã định dạng -->
 <?php echo $ngaydat_formatted; ?></li>
                                        <!-- <li><i class="fa fa-comment-o"></i> 5</li> -->
                                    </ul>
                                    <h5><a href="blog-details.php?id=<?php echo $row['ma_bv'] ?>">
                                    <?php
$tieu_de = $row['tieu_de'];

// Giới hạn tiêu đề tối đa 10 từ
$max_words = 38;
if (mb_strlen($tieu_de, 'UTF-8') > $max_words) {
    $tieu_de_gioi_han = mb_substr($tieu_de, 0, mb_strpos($tieu_de, ' ', $max_words, 'UTF-8'), 'UTF-8');
    echo $tieu_de_gioi_han . '...';
} else {
    echo $tieu_de;
}
?></a></h5>

                                    <p><?php
$noi_dung = $row['noi_dung'];

// Tạo một biến đếm số từ
$word_count = 0;

// Tạo một biến lưu trữ nội dung đã giới hạn
$noi_dung_gioi_han = '';

// Tách nội dung thành các từ tiếng Việt
$tokenizer = strtok($noi_dung, " \n\t\r\0\x0B"); // Dấu cách và ký tự trắng

while ($tokenizer !== false) {
    // Kiểm tra số từ đã tìm thấy
    $word_count++;

    // Thêm từ vào nội dung giới hạn
    $noi_dung_gioi_han .= $tokenizer . ' ';

    // Nếu đã tìm thấy đủ 20 từ, thoát khỏi vòng lặp
 

    // Lấy từ tiếp theo
    $tokenizer = strtok(" \n\t\r\0\x0B");
}

// Loại bỏ khoảng trắng cuối chuỗi
$noi_dung_gioi_han = rtrim($noi_dung_gioi_han);

// Kiểm tra xem nội dung đã giới hạn có vượt quá 100 chữ cái không
if (mb_strlen($noi_dung_gioi_han, 'UTF-8') > 150) {
    $noi_dung_gioi_han = mb_substr($noi_dung_gioi_han, 0, 150, 'UTF-8');
}

echo '<p>' . $noi_dung_gioi_han . ' ...</p>';
?>

    </p>
                                    <a href="blog-details.php?id=<?php echo $row['ma_bv'] ?>" class="blog__btn">XEM THÊM <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                      
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

  
    <?php include "footer.php" ?>


</body>

</html>