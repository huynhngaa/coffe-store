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
                            <a href="./index.html">Home</a>
                            <span>Shop Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
            <?php
           $id = $_GET['id'];
           $sql = "SELECT * FROM  thuc_uong t
           LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
           JOIN loai_thuc_uong l on l.maloai = t.ma_loai and ma=$id";
           $result = $conn->query($sql);
           $row = $result->fetch_assoc(); 
           if ($row['donvi'] === '%') {
            // Nếu 'don_vi' là '%', tính giá khuyến mãi theo công thức: giá - (giảm giá % x giá)
            $giam_gia = $row['giamgia']; // Phần trăm giảm giá
            $gia_khuyen_mai = $row['gia'] - ($giam_gia / 100 * $row['gia']);
            $gia_goc = $row['gia'];
        } elseif ($row['donvi'] === 'đ') {
            // Nếu 'don_vi' là 'đ', tính giá khuyến mãi theo công thức: giá - giảm giá
            $giam_gia = $row['giamgia']; // Giảm giá theo tiền đồng
            $gia_khuyen_mai = $row['gia'] - $giam_gia;
            $gia_goc = $row['gia'];
        } else {
            // Trường hợp khác, không thực hiện tính toán giá khuyến mãi
            $gia_khuyen_mai = $row['gia'];
            $gia_goc = null;
        }
           ?>
          
                <div class="col-lg-5 col-md-6">
                    <div class="product__details__pic">
                    <div class="product__details__pic__item" style="width: 100%; height: 400px; overflow: hidden;">
    <img class="product__details__pic__item--large" src="img/<?php echo $row['hinh_anh'] ?>" alt="" style="object-fit: cover; width: 100%; height: 100%;">
</div>

<div style="width: 500px; height: 80px; overflow: hidden;" class="product__details__pic__slider owl-carousel">
    <img style="object-fit: cover; width: 100%; height: 100%;" data-imgbigurl="img/<?php echo $row['hinh_anh_2'] ?>"
        src="img/<?php echo $row['hinh_anh_2'] ?>" alt="">
    <img style="object-fit: cover; width: 100%; height: 100%;" data-imgbigurl="img/<?php echo $row['hinh_anh_3'] ?>"
        src="img/<?php echo $row['hinh_anh_3'] ?>" alt="">
    <img style="object-fit: cover; width: 100%; height: 100%;" data-imgbigurl="img/<?php echo $row['hinh_anh_4'] ?>"
        src="img/<?php echo $row['hinh_anh_4'] ?>" alt="">
</div>


                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $row['ten'] ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price"><span> <?php echo number_format( $gia_khuyen_mai) ?> đ</span>
                        <?php
if ($gia_goc != null) {
    echo '<span style="text-decoration: line-through; color: gray; font-size: smaller;">' . number_format($gia_goc) . ' đ</span>';
}
?>
</div>
                        <p><?php echo $row['mota'] ?></p>
                        <form action="update-cart.php" method="post" enctype="multipart/form-data">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="soluong" type="number" value="1">
                                </div>
                            </div>
                        </div>
                      
    <input type="hidden" name="pdt_name" value="<?php echo $row['ten'] ?>">
    <input type="hidden" name="pdt_price" value="<?php echo $gia_khuyen_mai ?>">
    <input type="hidden" name="pdt_img" value="<?php echo $row['hinh_anh'] ?>">
    
    <input type="hidden" name="pdt_id" value="<?php echo $row['ma'] ?>">
   
                             <button name="addtocart" class="btn primary-btn" type="submit">Thêm vào giỏ </button></form>
                     
                        
                    
                        
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả</a>
                            </li>
                          
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả</h6>
                                    <p><?php echo $row['mota'] ?></p>
                                </div>
                            </div>
                          
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
     <?php include "related.php" ?>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php include "footer.php" ?>


</body>

</html>