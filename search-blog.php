
<?php
// Kết nối CSDL ở đây (cần được thiết lập trước)
require_once "connect.php";

if (isset($_POST["query"])) {
    $query = $_POST["query"];
    
    // Thực hiện truy vấn CSDL để lấy danh sách sản phẩm gợi ý
    $sql = "SELECT * FROM bai_viet WHERE tieu_de LIKE '%$query%'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="blog-details.php?id=' . $row["ma_bv"] . '">';
            echo '<div class="suggestion">';
            echo '<img class="product-image" src="img/' . $row["hinh_minh_hoa"] . '" alt="' . $row["tieu_de"] . '">';
            echo '<span class="product-title">' . $row["tieu_de"] . '</span>';
            echo '</div>';
            echo '</a>';
            echo '<hr>';
            
            
            
        }
    } else {
        echo '<div style="padding:10px">';
        echo "Không tìm thấy bài viết phù hợp.";
        echo '</div>';
    }
}
?>
