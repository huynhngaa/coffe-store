<section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản Phẩm Liên Quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">

            <?php
           $maloai = $row['maloai'];
           $sql = "SELECT * from loai_thuc_uong l, thuc_uong t where l.maloai=t.ma_loai and maloai= $maloai limit 4";
           $result = $conn->query($sql);
           while ($row = $result->fetch_assoc() ) {
              
           ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables">
                <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="img/<?php echo $row['hinh_anh'] ?>">
                            <ul class="featured__item__pic__hover">
                              
                            <form action="update-cart.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pdt_name" value="<?php echo $row['ten'] ?>">
    <input type="hidden" name="pdt_price" value="<?php echo $row['gia'] ?>">
    <input type="hidden" name="pdt_img" value="<?php echo $row['hinh_anh'] ?>">
    <input type="hidden" name="soluong" value="1">
    <input type="hidden" name="pdt_id" value="<?php echo $row['ma'] ?>">
   
                            <button type="submit" name="addtocart" class="circular-button">
    <i class="fa fa-shopping-cart"></i>
</button></form>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                        <h6><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h6>
                            <h5><?php echo  number_format($row['gia']) ?> đ</h5>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>