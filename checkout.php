    <?php
    session_start();
    include "connect.php";
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
    };
    if (!isset($_SESSION['cart'])) {
        header("Location: shoping-cart.php");
    };
    $totalCartValue = 0;
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
                background-color: #547523;
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
                background-color: #7fad39;
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
                                <span>Thanh Toán</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Checkout Section Begin -->
        <section class="checkout spad">
            <div class="container">

                <div class="checkout__form">
                    <h4>Thông tin đặt hàng</h4>
                    <form action="booking.php" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <?php if (isset($_SESSION['login'])) {
                                    $customer = $_SESSION['login']; ?>
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input name="ma" value="<?php echo  $customer['ma'] ?>" type="hidden">
                                        <input class="text-dark" name="ten" value="<?php echo  $customer['ten'] ?>" required type="text">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Số Điện Thoại<span>*</span></p>
                                        <input class="text-dark" name="sdt" id="sdt" value="<?php echo  $customer['so_dien_thoai'] ?>" required type="text">

                                    </div>
                                    <div id="sdtError" style="color: red;"></div>


                                    <div class="checkout__input">
                                        <p>Quận/Huyện<span>*</span></p>
                                        <select required class="form-control" name="huyen" id="huyen">
                                            <option disabled selected value="">--Chọn quận/huyện--</option>
                                            <?php
                                            // Kết nối cơ sở dữ liệu
                                            $conn = mysqli_connect('localhost', 'root', '', 'coffe_store');

                                            // Lấy danh sách các huyện
                                            $sql = "SELECT h_ma, h_ten FROM huyen";
                                            $result = mysqli_query($conn, $sql);

                                            // Hiển thị danh sách các huyện trong thẻ select
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['h_ma'] . '">' . $row['h_ten'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="checkout__input">
                                        <p>Phường/Xã<span>*</span></p>
                                        <select required class="form-control" name="xa" id="xa">
                                            <option disabled selected value="">--Chọn phường/xã--</option>
                                        </select>
                                    </div>
                                    <div class="checkout__input">
    <!-- <p>Phường/Xã đã chọn:</p> -->
    <p id="selectedHuyen"></p>
    <p id="selectedXa"></p>
    <!-- <p id="shipping"></p> -->
</div>

                                    <div class="checkout__input">
                                        <p>Địa Chỉ<span>*</span></p>
                                        <input class="text-dark" required name="diachi" value="<?php echo  $customer['dia_chi'] ?>" placeholder="Địa chỉ " required type="text">
                                    </div>
                                    <div class="checkout__input">
                                        <p>Phương Thức Thanh Toán<span>*</span></p>
                                        <select required class="form-control" name="tt" id="xa">
                                        <option  disabled selected value="">--Chọn phương thức thanh toán--</option>
                                            <option value="Tiền Mặt">Tiền Mặt</option>
                                            <option value="Chuyển Khoản">Chuyển Khoản</option>
                                        </select>
                                    </div>
                                    <div class="checkout__input">
                                        <p>Ghi Chú</p>
                                        <textarea placeholder="Ghi chú" class="form-control text-dark" name="ghichu" id="" cols="30" rows="5"></textarea>

                                    </div>

                                <?php } ?>


                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout__order">
                                    <h4>Đơn hàng</h4>

                                    <ul>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Thành Tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $itemCount = 0; // Initialize the item count
                                                $totalCartValue = 0; // Initialize the overall total cart value
                                                $totalCartValue2 = 0;
                                                foreach ($_SESSION['cart'] as $item) {
                                                    if (isset($item['gia'])) {
                                                        $total_price = $item['gia'] * $item['quantity'];

                                                        $totalCartValue += $total_price;
                                                        $totalCartValue2 += $total_price;  // Add the product total to the overall total
                                                        $itemCount++; // Increment the item count

                                                        // Display the item count in the first column
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $itemCount; ?></th>
                                                            <td><?php echo $item['ten']; ?></td>
                                                            <td><?php echo $item['quantity'] ?></td>
                                                            <td><?php echo number_format($total_price) ?> đ</td>
                                                        </tr>
                                                <?php }
                                                }

                                                // Check if the totalCartValue is greater than or equal to 200,000 đ
                                                // if ($totalCartValue <= 200000) {
                                                //     $totalCartValue += 20000; // Add 20 đ for shipping
                                                // }
                                                ?>


                                            </tbody>
                                        </table>

                                    </ul>
                                    <div class="checkout__order__total">Tổng cộng <span><?php echo number_format($totalCartValue2) ?> đ</span></div>
                                    <div id="ship" class="checkout__order__total">Phí ship <span id="shipping">
                                            <?php
                                            // if ($totalCartValue2 <= 200000) {
                                            //     echo "20,000 đ";
                                            // } else {
                                            //     echo "0 đ";
                                            // }
                                            ?>
                                        </span></div>
                                        <script>
$(document).ready(function() {
    $('#huyen, #xa').change(function() {
        var selectedHuyen = $('#huyen').val();
        var selectedXa = $('#xa').val();
        var shippingValue = ''; // Khởi tạo giá trị phí ship

        if (['3', '5', '6', '7', '8', '9'].includes(selectedHuyen) && ['21', '22', '23', '24', '25', '26', '27', '28', '29', '36', '37', '38', '39', '40', '41', '42','43', '44', '45', '46', '47', '48', '49', '50', '51', '52','53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83'].includes(selectedXa)) {
            shippingValue = 'Không khả dụng ở khu vực của bạn!';
        } else {
            if (['11', '6', '2', '5', '10'].includes(selectedXa)) {
                shippingValue = '0';
            } else if (['3', '9', '4', '32', '7', '8', '12'].includes(selectedXa)) {
                shippingValue = '10000';
            } else if (['30', '33', '1', '16'].includes(selectedXa)) {
                shippingValue = '20000';
            } else {
                shippingValue = '40000';
            }
        }

        // Hiển thị giá trị phí ship
        $('#shipping').text(shippingValue);

        // Gán giá trị phí ship vào input hidden
        $('input[name="ship"]').val(shippingValue);
    });

    // Trigger change event to update shipping and total on page load
    $('#huyen, #xa').trigger('change');
});
</script>


                                    <div class="checkout__order__total">Tổng thanh toán <span><?php echo number_format($totalCartValue) ?> đ</span></div>
                                    <input type="hidden" name="thanhtien" value="<?php echo $totalCartValue ?>">
                                    <input type="hidden" name="ship" >
                                    <button name="book" type="submit" class="site-btn">Đặt Hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                  <!-- Your existing HTML and PHP code -->
<script>
    $(document).ready(function() {
    function calculateTotal() {
        var totalCartValue = parseInt(<?php echo $totalCartValue; ?>); // Giá trị tổng giỏ hàng từ PHP
        var shippingCost = 0;

        var selectedHuyen = $('#huyen').val();
        var selectedXa = $('#xa').val();

       
            if (['11', '6', '2', '5', '10'].includes(selectedXa)) {
                shippingCost = 0;
            } else if (['3', '9', '4', '32', '7', '8', '12'].includes(selectedXa)) {
                shippingCost = 10000;
            } else if (['30', '33', '1', '16'].includes(selectedXa)) {
                shippingCost = 20000;
            } else {
                shippingCost = 40000;
            }
        

        var totalPayment = totalCartValue + shippingCost;
        $('#shipping').text(shippingCost.toLocaleString('vi-VN') + ' đ');
      

// Gán giá trị phí ship vào input hidden
$('input[name="ship"]').val(shippingCost);
        // $('#ship').text('Phí ship ' + shippingCost.toLocaleString('vi-VN') + ' đ');
        $('.checkout__order__total:last span').text(totalPayment.toLocaleString('vi-VN') + ' đ');
        $('input[name=thanhtien]').val(totalPayment);
    }

    $('#huyen, #xa').change(function() {
        calculateTotal();
    });

    // Tính toán khi trang được tải
    calculateTotal();
});

</script>
                  <script>
    $(document).ready(function() {
        // Send a request when the value of the district select element changes
        $('#huyen').change(function() {
            var h_ma = $(this).val();
            $.ajax({
                url: 'get_phuongxa.php',
                type: 'POST',
                data: {
                    h_ma: h_ma
                },
                dataType: 'json',
                success: function(data) {
                    // Clear the previous ward options and display the new ones
                    $('#xa').find('option').remove().end().append('<option value="">--Chọn phường/xã--</option>');
                    $.each(data, function(index, element) {
                        $('#xa').append('<option value="' + element.x_ma + '">' + element.x_ten + '</option>');
                    });
                }
            });
        });

    });
</script>


<!-- Your remaining HTML and PHP code -->

                </div>
            </div>
        </section>
        <!-- Checkout Section End -->

        <!-- Footer Section Begin -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- <script src="js/jquery.nice-select.min.js"></script> -->
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>

    </body>

    </html>