<?php
// Kết nối CSDL (thay đổi thông tin kết nối cho phù hợp)
include "connect.php";

// Truy vấn CSDL để lấy danh sách sản phẩm
$sql = "SELECT * from loai_thuc_uong l, thuc_uong t where l.maloai=t.ma_loai";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product = array(
            "ma" => $row["product_id"],
            "ten" => $row["product_name"],
            "gia" => $row["product_price"]
        );

        $products[] = $product;
    }
}

// Đóng kết nối CSDL
$conn->close();

// Trả về danh sách sản phẩm dưới dạng JSON
echo json_encode($products);
?>
