<style>
    .product-image {
    /* max-width: 80px;
    max-height: 80px; */
    
    width: 60px;
    height:  60px;
}
.suggestions {
    /* border: solid 2px #a3a3a3bf; */
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    border-bottom-left-radius: 10px;

    border-bottom-right-radius: 10px;
    /* margin-top: -28px; */
    width: 700px;
    max-height: 240px; /* Đặt chiều cao tối đa là 100px */
    overflow-y: auto; /* Hiển thị thanh kéo khi nội dung vượt quá chiều cao tối đa */
}
/* Thiết lập màu chữ mặc định (màu đen) */
.suggestion span {
    color: black;
}

/* Thiết lập màu chữ khi hover (màu xám) */
.suggestion:hover {
    background-color:  #ebe8e8;
}
/* Tùy chỉnh biểu tượng kính lúp */


</style>
<div class="col-lg-10">
    <div class="hero__search">
        <div class="hero__search__form">
            <form action="shop-grid.php" method="post">
                <input id="search" name="search" type="text" placeholder="Bạn muốn tìm gì?">
                <button type="submit" class="site-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            
        </div>
      
       
        <div class="hero__search__phone">
            <div class="hero__search__phone__icon">
                <i class="fa fa-phone"></i>
            </div>
            <div class="hero__search__phone__text">
                <?php
                $sql = "SELECT * FROM cua_hang";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <h5><?php echo $row['sdt'] ?></h5>
                <span>Hỗ trợ 24/7</span>
            </div>
        </div>
      
    </div>
    <div style="z-index: 1;position: absolute; background-color:#fff" id="product-suggestions" class="suggestions"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#search").on("input", function() { // Sự kiện input thay vì keyup
        var query = $(this).val();
        
        if (query.length >= 1) {
            $.ajax({
                url: "search-products.php",
                method: "POST",
                data: { query: query },
                success: function(data) {
                    $("#product-suggestions").html(data);
                }
            });
        } else {
            $("#product-suggestions").html("");
        }
    });
});
</script>
