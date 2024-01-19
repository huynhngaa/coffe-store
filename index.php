<?php include "connect.php";
session_start();
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
    <section class="hero">
        <div class="container">
            <div class="row">
            <div class="col-lg-2">
            </div>
                
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
    margin-top: -28px;
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

            </div>
          
        </div>
        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="3000">
      <img src="img/baner3.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-interval="3000">
      <img src="img/baner1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-interval="3000">
      <img src="img/baner2.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <?php include "spbanchay.php" ?>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
   
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <?php include "blog-deferent.php" ?>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
  <?php include "footer.php" ?>



</body>

</html>