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

    <?php
              $id = $_GET['id'];
              $sql = "SELECT* from bai_viet b , nhan_vien n  where b.ma_nv = n.ma and ma_bv = $id";

              $result = $conn->query($sql);

              $row = $result->fetch_assoc();
              ?>

    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="img/shop2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2><?php echo $row['tieu_de']?></h2>
                        <ul>
                            <li>Bởi <?php echo $row['ten']?></li>
                            <li><?php
$ngaydat = $row['ngay_dang']; // Ngày và giờ từ $row['ngaydat']
$ngaydat_formatted = date('H:i:s - d/m/Y ', strtotime($ngaydat)); // Định dạng lại ngày giờ
?>

<!-- Hiển thị ngày giờ đã định dạng -->
 <?php echo $ngaydat_formatted; ?></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        
                      
                        <div class="blog__sidebar__item">
                            <h4>Bài Viết Mới</h4>
                            <div class="blog__sidebar__recent">
                            <?php
                            $id = $_GET['id'];
                                          $sql1 = "SELECT* from bai_viet b , nhan_vien n  where b.ma_nv = n.ma and ma_bv !=$id order by ma_bv desc";
              $result1 = $conn->query($sql1);
             while ( $row1 = $result1->fetch_assoc()) {
              ?>
                                <a href="#" class="blog__sidebar__recent__item">
                                <div style="  width: 70px; /* Kích thước khung hình cố định */
    height: 70px;
    overflow: hidden; " class="blog__sidebar__recent__item__pic">
    <div style=" width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;" class="image-container">
        <img style=" object-fit: cover; /* Cắt và căn giữa ảnh */
    width: 100%;
    height: 100%;" src="img/<?php echo $row1['hinh_minh_hoa'] ?>" alt="">
    </div>
</div>

                                    <div class="blog__sidebar__recent__item__text">
                                        <h6> <?php
$tieu_de = $row1['tieu_de'];

// Giới hạn tiêu đề tối đa 10 từ
$max_words = 38;
if (mb_strlen($tieu_de, 'UTF-8') > $max_words) {
    $tieu_de_gioi_han = mb_substr($tieu_de, 0, mb_strpos($tieu_de, ' ', $max_words, 'UTF-8'), 'UTF-8');
    echo $tieu_de_gioi_han . '...';
} else {
    echo $tieu_de;
}
?><br /> <?php echo $row1['ten'] ?></h6>
                                        <span><?php
$ngaydat = $row1['ngay_dang']; // Ngày và giờ từ $row['ngaydat']
$ngaydat_formatted = date('H:i:s - d/m/Y ', strtotime($ngaydat)); // Định dạng lại ngày giờ
?>

<!-- Hiển thị ngày giờ đã định dạng -->
 <?php echo $ngaydat_formatted; ?></span>
                                    </div>
                                </a>
                              <?php } ?>
                              
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="img/<?php echo $row['hinh_minh_hoa'] ?>" alt="">
                        <p><?php echo $row['noi_dung'] ?></p>
                      
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/<?php echo $row['hinhnv'] ?>" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6><?php echo $row['ten'] ?></h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
   <?php include "blog-deferent.php" ?>
    <!-- Related Blog Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>