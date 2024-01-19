<section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Bài Viết</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
             // Kiểm tra xem biến id đã được truyền từ $_GET hay chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bai_viet b, nhan_vien n WHERE b.ma_nv = n.ma AND ma_bv != $id";
} else {
    // Nếu không có biến id, chỉ thực hiện truy vấn mà không có điều kiện về id
    $sql = "SELECT * FROM bai_viet b, nhan_vien n WHERE b.ma_nv = n.ma limit 3";
}

// Thực hiện truy vấn SQL
// ...


              $result = $conn->query($sql);

              while($row = $result->fetch_assoc()) { 
              ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                    <div style="width: 100; /* Kích thước khung hình cố định */
    height: 200px;
    overflow: hidden; " class="blog__item__pic">
    <div style=" width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;" class="image-container">
        <img style="  object-fit: cover; /* Cắt và căn giữa ảnh */
    width: 100%;
    height: 100%;" src="img/<?php echo $row['hinh_minh_hoa'] ?>" alt="">
    </div>
</div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i><?php
$ngaydat = $row['ngay_dang']; // Ngày và giờ từ $row['ngaydat']
$ngaydat_formatted = date('H:i:s - d/m/Y ', strtotime($ngaydat)); // Định dạng lại ngày giờ
?>

<!-- Hiển thị ngày giờ đã định dạng -->
 <?php echo $ngaydat_formatted; ?></li>
                                <!-- <li><i class="fa fa-comment-o"></i> 5</li> -->
                            </ul>
                            <h5><a href="blog-details.php?id=<?php echo $row['ma_bv'] ?>"><?php
$tieu_de = $row['tieu_de'];

// Giới hạn tiêu đề tối đa 10 từ
$max_words = 34;
if (mb_strlen($tieu_de, 'UTF-8') > $max_words) {
    $tieu_de_gioi_han = mb_substr($tieu_de, 0, mb_strpos($tieu_de, ' ', $max_words, 'UTF-8'), 'UTF-8');
    echo $tieu_de_gioi_han . '...';
} else {
    echo $tieu_de;
}
?></a></h5>
                            <p><?php
$noi_dung = $row['noi_dung'];

// Tạo một biến đếm số từ
$word_count = 0;

// Tạo một biến lưu trữ nội dung đã giới hạn
$noi_dung_gioi_han = '';

// Tách nội dung thành các từ tiếng Việt
$tokenizer = strtok($noi_dung, " \n\t\r\0\x0B"); // Dấu cách và ký tự trắng

while ($tokenizer !== false) {
    // Kiểm tra số từ đã tìm thấy
    $word_count++;

    // Thêm từ vào nội dung giới hạn
    $noi_dung_gioi_han .= $tokenizer . ' ';

    // Nếu đã tìm thấy đủ 20 từ, thoát khỏi vòng lặp
 

    // Lấy từ tiếp theo
    $tokenizer = strtok(" \n\t\r\0\x0B");
}

// Loại bỏ khoảng trắng cuối chuỗi
$noi_dung_gioi_han = rtrim($noi_dung_gioi_han);

// Kiểm tra xem nội dung đã giới hạn có vượt quá 100 chữ cái không
if (mb_strlen($noi_dung_gioi_han, 'UTF-8') > 100) {
    $noi_dung_gioi_han = mb_substr($noi_dung_gioi_han, 0, 100, 'UTF-8');
}

echo '<p>' . $noi_dung_gioi_han . ' ...</p>';
?>
</p>
                        </div>
                    </div>
                </div>
                
                <?php  } ?>
            </div>
        </div>
    </section>