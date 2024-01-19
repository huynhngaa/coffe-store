<section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm mới nhất</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                      
                            
                            <li data-filter=".oranges">Trà</li>
                             <li data-filter=".fresh-meat">Cà Phê</li>
                            <li data-filter=".fastfood">Trà Sữa</li>
                           
                           
                            <li data-filter=".vegetables">Đá Xay</li>
                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                 
            <?php
           
           $sql = "SELECT * FROM  thuc_uong t
           LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
           JOIN loai_thuc_uong l on l.maloai = t.ma_loai and maloai=1";
           $result = $conn->query($sql);
           while ($row = $result->fetch_assoc() ) {
            if ($row['donvi'] === '%') {
                // Nếu 'don_vi' là '%', tính giá khuyến mãi theo công thức: giá - (giảm giá % x giá)
                $giam_gia = $row['giamgia']; // Phần trăm giảm giá
                $gia_khuyen_mai = $row['gia'] - ($giam_gia / 100 * $row['gia']);
                $gia_goc = $row['gia'];
            } elseif ($row['donvi'] === 'đ') {
                // Nếu 'don_vi' là 'đ', tính giá khuyến mãi theo công thức: giá - giảm giá
                $giam_gia = $row['giamgia']; // Giảm giá theo tiền đồng
                $gia_khuyen_mai = $row['gia'] - $giam_gia;
                $gia_goc = $row['gia'];
            } else {
                // Trường hợp khác, không thực hiện tính toán giá khuyến mãi
                $gia_khuyen_mai = $row['gia'];
                $gia_goc = null;
            }
              
           ?>
          
   


                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges">
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
    <i class="fa fa-plus" aria-hidden="true"></i>
</button></form>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                        <h6><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h6>
                            <h5><span> <?php echo number_format( $gia_khuyen_mai) ?> đ</span>
                        <?php
if ($gia_goc != null) {
    echo '<span style="text-decoration: line-through; color: gray; font-size: smaller;">' . number_format($gia_goc) . ' đ</span>';
}
?></h5>
                        </div>
                    </div>
                </div> 
                <?php } ?>
                <?php
           
           $sql = "SELECT * FROM  thuc_uong t
           LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
           JOIN loai_thuc_uong l on l.maloai = t.ma_loai and maloai=2";
           $result = $conn->query($sql);
           while ($row = $result->fetch_assoc() ) {
            if ($row['donvi'] === '%') {
                // Nếu 'don_vi' là '%', tính giá khuyến mãi theo công thức: giá - (giảm giá % x giá)
                $giam_gia = $row['giamgia']; // Phần trăm giảm giá
                $gia_khuyen_mai = $row['gia'] - ($giam_gia / 100 * $row['gia']);
                $gia_goc = $row['gia'];
            } elseif ($row['donvi'] === 'đ') {
                // Nếu 'don_vi' là 'đ', tính giá khuyến mãi theo công thức: giá - giảm giá
                $giam_gia = $row['giamgia']; // Giảm giá theo tiền đồng
                $gia_khuyen_mai = $row['gia'] - $giam_gia;
                $gia_goc = $row['gia'];
            } else {
                // Trường hợp khác, không thực hiện tính toán giá khuyến mãi
                $gia_khuyen_mai = $row['gia'];
                $gia_goc = null;
            }
              
           ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat">
                <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="img/<?php echo $row['hinh_anh'] ?>">
                            <ul class="featured__item__pic__hover">
                              
                            <form action="update-cart.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pdt_name" value="<?php echo $row['ten'] ?>">
    <input type="hidden" name="pdt_price" value="<?php echo $gia_khuyen_mai ?>">
    <input type="hidden" name="pdt_img" value="<?php echo $row['hinh_anh'] ?>">
    <input type="hidden" name="soluong" value="1">
    <input type="hidden" name="pdt_id" value="<?php echo $row['ma'] ?>">
   
                            <button type="submit" name="addtocart" class="circular-button">
                            <i class="fa fa-plus" aria-hidden="true"></i>
</button></form>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                        <h6><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h6>
                            <h5><span> <?php echo number_format( $gia_khuyen_mai) ?> đ</span>
                        <?php
if ($gia_goc != null) {
    echo '<span style="text-decoration: line-through; color: gray; font-size: smaller;">' . number_format($gia_goc) . ' đ</span>';
}
?></h5>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <?php
           
           $sql = "SELECT * FROM  thuc_uong t
           LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
           JOIN loai_thuc_uong l on l.maloai = t.ma_loai and maloai=3";
           $result = $conn->query($sql);
           while ($row = $result->fetch_assoc() ) {
            if ($row['donvi'] === '%') {
                // Nếu 'don_vi' là '%', tính giá khuyến mãi theo công thức: giá - (giảm giá % x giá)
                $giam_gia = $row['giamgia']; // Phần trăm giảm giá
                $gia_khuyen_mai = $row['gia'] - ($giam_gia / 100 * $row['gia']);
                $gia_goc = $row['gia'];
            } elseif ($row['donvi'] === 'đ') {
                // Nếu 'don_vi' là 'đ', tính giá khuyến mãi theo công thức: giá - giảm giá
                $giam_gia = $row['giamgia']; // Giảm giá theo tiền đồng
                $gia_khuyen_mai = $row['gia'] - $giam_gia;
                $gia_goc = $row['gia'];
            } else {
                // Trường hợp khác, không thực hiện tính toán giá khuyến mãi
                $gia_khuyen_mai = $row['gia'];
                $gia_goc = null;
            }
              
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
    <i class="fa fa-plus" aria-hidden="true"></i>
</button></form>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                        <h6><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h6>
                            <h5><span> <?php echo number_format( $gia_khuyen_mai) ?> đ</span>
                        <?php
if ($gia_goc != null) {
    echo '<span style="text-decoration: line-through; color: gray; font-size: smaller;">' . number_format($gia_goc) . ' đ</span>';
}
?></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php
           
           $sql = "SELECT * FROM  thuc_uong t
           LEFT JOIN khuyen_mai k on k.mathucuong = t.ma
           JOIN loai_thuc_uong l on l.maloai = t.ma_loai and maloai=4";
           $result = $conn->query($sql);
           while ($row = $result->fetch_assoc() ) {
            if ($row['donvi'] === '%') {
                // Nếu 'don_vi' là '%', tính giá khuyến mãi theo công thức: giá - (giảm giá % x giá)
                $giam_gia = $row['giamgia']; // Phần trăm giảm giá
                $gia_khuyen_mai = $row['gia'] - ($giam_gia / 100 * $row['gia']);
                $gia_goc = $row['gia'];
            } elseif ($row['donvi'] === 'đ') {
                // Nếu 'don_vi' là 'đ', tính giá khuyến mãi theo công thức: giá - giảm giá
                $giam_gia = $row['giamgia']; // Giảm giá theo tiền đồng
                $gia_khuyen_mai = $row['gia'] - $giam_gia;
                $gia_goc = $row['gia'];
            } else {
                // Trường hợp khác, không thực hiện tính toán giá khuyến mãi
                $gia_khuyen_mai = $row['gia'];
                $gia_goc = null;
            }
              
           ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood">
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
    <i class="fa fa-plus" aria-hidden="true"></i>
</button></form>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="shop-details.php?id=<?php  echo  $row['ma']?>"><?php echo $row['ten'] ?></a></h6>
                            <h5><span> <?php echo number_format( $gia_khuyen_mai) ?> đ</span>
                        <?php
if ($gia_goc != null) {
    echo '<span style="text-decoration: line-through; color: gray; font-size: smaller;">' . number_format($gia_goc) . ' đ</span>';
}
?></h5>
                        </div>
                        
                    </div>
                </div>
                <?php } ?>
              
              
                
              
            </div>
        </div>
    </section>