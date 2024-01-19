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
            width: 40px;
            /* Set the desired width and height for your circular button */
            height: 40px;
            border: none;
            background-color: #113946;
            /* Set the background color */
            color: #fff;
            /* Set the text color */
            border-radius: 50%;
            /* Makes it circular */
            cursor: pointer;
            transition: background-color 0.3s;
            /* Add a smooth transition for hover effect */
        }

        /* Hover effect */
        .circular-button:hover {
            background-color: #1b6e89;
            /* Change the background color on hover */
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

    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->

    <!-- Breadcrumb Section End -->
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
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <?php
            // Get the user's ID from the session
            $customer = $_SESSION['login'];
            $id = $customer['ma'];

            // Query to retrieve order history for the logged-in user
            $sql = "SELECT *  from khach_hang k
            join tai_khoan tk on k.ma = tk.makh
            WHERE k.ma = '$id' ";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            // $sql2 = "SELECT count(*) as tong FROM chi_tiet_order_online ct
            //     JOIN oder_online ol ON ct.madon = ol.ma
            //     JOIN khach_hang k ON ct.makh = k.ma
            //     JOIN thuc_uong t ON t.ma = ct.mathucuong 
            //     join tai_khoan tk on k.ma_tai_khoan = tk.ma
            //     WHERE makh = '$id'
            //     ";
            // $result2 = $conn->query($sql2);
            // $row2 = $result2->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="img/<?php echo $row['hinh_kh'] ?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4> <?php echo $row['ten'] ?></h4>
                                    <p class="text-secondary mb-1"><?php echo $row['ten_dang_nhap'] ?> </p>
                                    <p class="text-muted font-size-sm"> <?php echo $row['dia_chi'] ?></p>
                                     <!-- <a href="change_password.php"><p class="text-primary font-size-sm"> <b> Đổi mật khẩu</b></p></a>   -->
                                    <br>
                                </div>
                            </div>
                      
                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="edit_password.php" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mật Khẩu Cũ</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="old" type="text" class="form-control" placeholder="Nhập mật khẩu cũ">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mật Khẩu Mới</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="new" type="text" class="form-control" placeholder="Nhập mật khẩu mới">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="edit" type="submit" class="btn btn-primary px-4" value="Cập Nhật">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

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