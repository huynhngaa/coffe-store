

<header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> kimanh@gmail.com</li>
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                         
                           



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img width="150px" src="img/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Trang Chủ</a></li>
                            <li><a href="./shop-grid.php">Sản Phẩm</a></li>
                          
                            <li><a href="./blog.php">Bài Viết</a></li>
                            <li><a href="./contact.php">Liên Hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart header__menu">
                        <ul>
                       <!-- Display the total quantity of items in the cart -->
<li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span id="cart-item-count">
    <?php
    // Initialize total quantity
    $totalQuantity = 0;

    if (isset($_SESSION['cart'])) {
        // Loop through cart items and calculate the total quantity
        foreach ($_SESSION['cart'] as $item) {
            $totalQuantity += $item['quantity'];
        }
    }

    // Display the total quantity
    echo $totalQuantity;
    ?>
</span></a></li>





                            
                            <li><a href="#"><i class="fa fa-user"></i> <small><?php if(isset($_SESSION['login'])){   $customer = $_SESSION['login']; echo $customer['ten_dang_nhap'];} ?> </small></a>

                                <ul style="text-align: left;width:200px" class="header__menu__dropdown">
                                <?php if(!isset($_SESSION['login'])) {?>
                                    <li><a href="login.php">Đăng Nhập</a></li>
                                    <li><a href="login.php">Đăng Ký</a></li>
                                    <?php }else{ 
                            $customer = $_SESSION['login'];    
                            ?>
 <li><a href="./profile.php">Hồ sơ</a></li>
 <li><a href="./history.php">Lịch Sử Đơn Hàng</a></li>
                                    <li><a href="logout.php">Đăng Xuất</a></li>
<?php } ?>
                                </ul>
                            </li>

                        </ul>
                        <!-- <div class="header__cart__price">item: <span>$150.00</span></div> -->
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>