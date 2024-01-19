<?php
session_start();
include "connect.php";

// Get the selected sorting option from the Ajax request
$sortBy = $_POST['sortBy'];

// Build the SQL query based on the selected sorting option
$sql = "SELECT * FROM loai_thuc_uong l, thuc_uong t WHERE l.maloai = t.ma_loai";

if ($sortBy == 'best-selling') {
    $sql .= " ORDER BY ten DESC"; // Replace 'sold_count' with your actual sold count column
} elseif ($sortBy == 'price-high-low') {
    $sql .= " ORDER BY gia DESC";
} elseif ($sortBy == 'price-low-high') {
    $sql .= " ORDER BY gia ASC";
} else {
    // Default sorting option, e.g., no sorting
}

$result = $conn->query($sql);

ob_start();

while ($row = $result->fetch_assoc()) {
    // Output product HTML as you did before
    ?>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="img/<?php echo $row['hinh_anh'] ?>">
                <!-- Product image here -->
            </div>
            <div class="product__item__text">
                <h6><a href="shop-details.php?id=<?php echo $row['ma'] ?>"><?php echo $row['ten'] ?></a></h6>
                <h5><?php echo number_format($row['gia']) ?> đ</h5>
            </div>
        </div>
    </div>
    <?php
}

ob_end_flush();
?>
