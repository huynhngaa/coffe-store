
<?php
// Kết nối CSDL ở đây (cần được thiết lập trước)
require_once "connect.php";

if (isset($_POST["query"])) {
    $query = $_POST["query"];
    
    // Thực hiện truy vấn CSDL để lấy danh sách sản phẩm gợi ý
    $sql = "SELECT * FROM thuc_uong WHERE ten LIKE '%$query%'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="shop-details.php?id=' . $row["ma"] . '">';
            echo '<div class="suggestion">';
          
            echo '<img class="product-image" src="img/' . $row["hinh_anh"] . '" alt="' . $row["ten"] . '">';
            echo '<span>' . $row["ten"] . '</span>';
            echo '</div>';
            echo '</a>';
            echo '<hr>';
            
            
        }
    } else {
        echo '<div style="padding:10px">';
        echo "Không tìm thấy sản phẩm phù hợp.";
        echo '</div>';
    }
}
?>
