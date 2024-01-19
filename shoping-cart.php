<?php
session_start();
include "connect.php";

// Initialize the total variable
$totalCartValue = 0;

// Check if the 'addtocart' button is clicked
if (isset($_POST['addtocart'])) {
   
    if (isset($_SESSION['cart'])) {
        $product_id = $_POST['pdt_id'];
        $quantity = intval($_POST['soluong']); // Convert to integer
        
        // Check if the product with the same ID is already in the cart
        $product_exists = false;
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['ma'] == $product_id) {
                // Product is already in the cart, update the quantity
                $_SESSION['cart'][$key]['quantity'] += $quantity;
                $product_exists = true;
                break; // Exit the loop since the product was found
            }
        }

        if (!$product_exists) {
            // Product is not in the cart, add it
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array(
                'ten' => $_POST['pdt_name'],
                'gia' => $_POST['pdt_price'],
                'hinh_anh' => $_POST['pdt_img'],
                'ma' => $_POST['pdt_id'],
                'quantity' => $quantity
            );
        }
    } else {
        // Cart is empty, add the product
        $_SESSION['cart'][0] = array(
            'ten' => $_POST['pdt_name'],
            'gia' => $_POST['pdt_price'],
            'hinh_anh' => $_POST['pdt_img'],
            'ma' => $_POST['pdt_id'],
            'quantity' => intval($_POST['soluong'])
        );
    }

    // Redirect back to the current page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit(); // Make sure to exit after redirection
}
?>

<!DOCTYPE html>
<html lang="zxx">
<?php include "head.php" ?>
<body>
    <!-- Page Preloder -->
  

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
                            <span>Giỏ Hàng</span>
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
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                ?>
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Hình</th>
                                <th>Tên</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['cart'] as $item) {
                                if (isset($item['gia'])) {
                                    $total_price = $item['gia'] * $item['quantity'];
                                    $totalCartValue += $total_price; // Add the product total to the overall total
                            ?>
 <tr class="cart-item">
            <td class="col-1">
                <a href="shop-details.php?id=<?php echo $item['ma']; ?>">
                    <img src="img/<?php echo $item['hinh_anh']; ?>" alt="">
                </a>
            </td>
            <td class="col-3">
                <a style="font-size: 18px;" class="badge badge-light" href="shop-details.php?id=<?php echo $item['ma']; ?>"><?php echo $item['ten']; ?></a>
            </td>
            <td><?php echo number_format($item['gia']) . ' đ'; ?></td>
            <td class="col-1">
            <input class="form-control quantity-input" type="number" name="quantity[]" value="<?php echo $item['quantity']; ?>" data-gia="<?php echo $item['gia']; ?>" data-product-id="<?php echo $item['ma']; ?>" min="1" max="20" step="1">
            </td>
            <td class="total-price"><?php echo number_format($total_price) . ' đ'; ?></td>
            <td>
               <a href="delete_cart_item.php?ma=<?php echo $item['ma']; ?>"> <button type="button" class="btn btn-danger delete-item" >Xóa</button></a>
            </td>
        </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                } else {
                    // Display a message when the cart is empty
                    echo '<p id="empty-cart-message">Giỏ hàng trống.</p>';
                }
                ?>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="javascript:history.back()"><button type="button" class="btn btn-info ">Tiếp tục mua sắm</button></a>
                        <a href="clear-cart.php"> <button style="float: right;" type="button" class="btn btn-danger clear-cart" id="clear-cart-button">Xóa hết giỏ hàng</button></a>
                    </div>
                </div>
                <div class="col-lg-6">
                   
                </div>
                <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){ ?>
                <div class="col-lg-6">
    <div class="shoping__checkout">
        <h5>Thanh Toán</h5>
        <ul>
        <li>Tổng cộng<span id="total-amount">0 đ</span></li>

        </ul>

        <a href="checkout.php"  class="primary-btn">Thanh Toán</a>
    </div>
</div>
<?php } ?>
            </div>
    </div>
</section>
<?php include "footer.php" ?>

</body>
</html>
