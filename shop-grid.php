<?php
session_start(); 
include "connect.php";
$productsPerPage = 9;

// Get the current page number from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset to fetch the products for the current page
$offset = ($page - 1) * $productsPerPage;

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
                            <a href="./index.html">Trang Chủ</a>

                            <span>Sản Phẩm - </span>
                            <span>
                            <?php 
                                if (isset($_GET['id'])) {
                                    // Lấy tên loại thức uống dựa trên 'id' nếu 'id' tồn tại
                                    $id = $_GET['id']; 
                                    $sql = "SELECT * from loai_thuc_uong where maloai = $id";
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    echo $row['tenloai'];
                                } else {
                                    // Nếu 'id' không tồn tại, lấy toàn bộ dữ liệu từ bảng 'loai_thuc_uong'
                                    $sql = "SELECT * from loai_thuc_uong";
                                    $result = $conn->query($sql);
                                    echo 'Tất cả sản phẩm';
                                    // Xử lý dữ liệu hoặc hiển thị nó dựa trên mục đích của bạn
                                }
                            ?>
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh Mục</h4>
                            <ul>
                                <li><a href="shop-grid.php">Tất cả sản phẩm</a></li>
                                <?php
                                    $sql = "SELECT * from loai_thuc_uong";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <li><a href="shop-grid.php?id=<?php echo $row['maloai'] ?>"><?php echo $row['tenloai'] ?></a></li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h5>Giảm giá</h5>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                            <?php
                                    $sql = "SELECT * FROM loai_thuc_uong l, khuyen_mai k, thuc_uong t WHERE l.maloai = t.ma_loai and t.ma = k.mathucuong";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                        if ($row['donvi'] === '%') {
                                            // Nếu 'don_vi' là '%', tính giá khuyến mãi theo công thức: giá - (giảm giá % x giá)
                                            $giam_gia = $row['giamgia']; // Phần trăm giảm giá
                                            $gia_khuyen_mai = $row['gia'] - ($giam_gia / 100 * $row['gia']);
                                        } elseif ($row['donvi'] === 'đ') {
                                            // Nếu 'don_vi' là 'đ', tính giá khuyến mãi theo công thức: giá - giảm giá
                                            $giam_gia = $row['giamgia']; // Giảm giá theo tiền đồng
                                            $gia_khuyen_mai = $row['gia'] - $giam_gia;
                                        } else {
                                            // Trường hợp khác, không thực hiện tính toán giá khuyến mãi
                                            $gia_khuyen_mai = $row['gia'];
                                        }
                                ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="img/<?php echo $row['hinh_anh'] ?>">
                                            <div class="product__discount__percent">-<?php
$phan_tram_giam_gia = (($row['gia'] - $gia_khuyen_mai) / $row['gia']) * 100;
$phan_tram_giam_gia_lam_tron = round($phan_tram_giam_gia);
echo $phan_tram_giam_gia_lam_tron;
?>
%  </div>
                                            <ul class="product__item__pic__hover">
                                        <form action="update-cart.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="pdt_name" value="<?php echo $row['ten'] ?>">
                                            <input type="hidden" name="pdt_price" value="<?php echo $gia_khuyen_mai ?>">
                                            <input type="hidden" name="pdt_img" value="<?php echo $row['hinh_anh'] ?>">
                                            <input type="hidden" name="soluong" value="1">
                                            <input type="hidden" name="pdt_id" value="<?php echo $row['ma'] ?>">
                                            <button type="submit" name="addtocart" class="circular-button">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span><?php echo $row['tenloai'] ?></span>
                                            <h5><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h5>
                                            <div class="product__item__price"><?php 
                                            
                                            echo number_format($gia_khuyen_mai) ?> đ <span><?php echo number_format($row['gia']) ?> đ</span></div>
                                        </div>
                                    </div>
                                </div>
                                
<?php } ?> 
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                    <div class="section-title product__discount__title">
                            <h5>Tất cả sản phẩm</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <?php
                                        $searchQuery = '';

                                        if (isset($_POST['search'])) {
                                            $searchQuery = $_POST['search'];
                                        }
                                        
                                        // Initialize the total count variable
                                        $totalCount = 0;
                                        
                                        // Handle category-based product display
                                        if (isset($_GET['id'])) {
                                            $id = $_GET['id'];
                                        
                                            // Construct the SQL query based on the presence of searchQuery
                                            if (!empty($searchQuery)) {
                                                $sql = "SELECT count(*) as tong from thuc_uong WHERE ma_loai = $id AND ten LIKE '%$searchQuery%'";
                                            } else {
                                                $sql = "SELECT count(*) as tong from thuc_uong WHERE ma_loai = $id";
                                            }
                                        } else {
                                            // Construct the SQL query based on the presence of searchQuery
                                            if (!empty($searchQuery)) {
                                                $sql = "SELECT count(*) as tong from thuc_uong WHERE ten LIKE '%$searchQuery%'";
                                            } else {
                                                $sql = "SELECT count(*) as tong from thuc_uong";
                                            }
                                        }
                                        
                                        $result = $conn->query($sql);
                                        if ($result) {
                                            $row = $result->fetch_assoc();
                                            $totalCount = $row['tong'];
                                        }
                                    ?>
                                    
                                    <!-- Display the total count -->
                                    <h6><span><?php echo $totalCount ?></span> Sản phẩm</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                    <?php
                    // Handle category-based product display
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Construct the SQL query based on the presence of searchQuery and pagination
                        if (!empty($searchQuery)) {
                            $sql = "SELECT * FROM  thuc_uong t
                            LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
                            JOIN loai_thuc_uong l on l.maloai = t.ma_loai
                            where makm is null AND maloai = $id AND t.ten LIKE '%$searchQuery%' LIMIT $offset, $productsPerPage";
                        } else {
                            $sql = "SELECT * FROM  thuc_uong t
                            LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
                            JOIN loai_thuc_uong l on l.maloai = t.ma_loai
                            where makm is null AND maloai = $id LIMIT $offset, $productsPerPage";
                        }
                    } else {
                        // Construct the SQL query based on the presence of searchQuery and pagination
                        if (!empty($searchQuery)) {
                            $sql = "SELECT * FROM  thuc_uong t
                            LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
                            JOIN loai_thuc_uong l on l.maloai = t.ma_loai
                            where makm is null AND t.ten LIKE '%$searchQuery%' LIMIT $offset, $productsPerPage";
                        } else {
                            $sql = "SELECT * FROM  thuc_uong t
                            LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
                            JOIN loai_thuc_uong l on l.maloai = t.ma_loai
                            where makm is null LIMIT $offset, $productsPerPage";
                        }
                    }

                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc() ) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/<?php echo $row['hinh_anh'] ?>">
                                    <ul class="product__item__pic__hover">
                                        <form action="update-cart.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="pdt_name" value="<?php echo $row['ten'] ?>">
                                            <input type="hidden" name="pdt_price" value="<?php echo $row['gia'] ?>">
                                            <input type="hidden" name="pdt_img" value="<?php echo $row['hinh_anh'] ?>">
                                            <input type="hidden" name="soluong" value="1">
                                            <input type="hidden" name="pdt_id" value="<?php echo $row['ma'] ?>">
                                            <button type="submit" name="addtocart" class="circular-button">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h6>
                                    <h5><?php echo  number_format($row['gia']) ?> đ</h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="product__pagination">
                        <?php
                        // Calculate the total number of pages
                        $totalPages = ceil($totalCount / $productsPerPage);

                        // Display pagination links
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<a href='shop-grid.php?page=$i'>" . $i . "</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <?php include "footer.php" ?>
    <!-- Footer Section End -->
</body>
</html>
