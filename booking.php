<?php
session_start();
include "connect.php";

if (isset($_POST['book'])) {
    // Retrieve user information from the session (if logged in)
    if (isset($_SESSION['login'])) {
        $customer = $_SESSION['login'];
        $ma_khach_hang = $customer['ma'];
    }

    $ten_khach_hang = $_POST['ten'];
    $so_dien_thoai = $_POST['sdt'];
    $dia_chi = $_POST['diachi'];
    $xa = $_POST['xa'];
    $ship = $_POST['ship'];
    $tt = $_POST['tt'];
    $thanhtien = $_POST['thanhtien'];
    $ghi_chu = $_POST['ghichu'];

    // Insert the order into your database
    $sql = "INSERT INTO oder_online (ten_khach_hang, so_dien_thoai, dia_chi,x_ma, ghi_chu,hinhthuctt, thanhtien,ship, ma_khach_hang)
            VALUES ('$ten_khach_hang', '$so_dien_thoai', '$dia_chi','$xa', '$ghi_chu','$tt', '$thanhtien','$ship', '$ma_khach_hang')";
    mysqli_query($conn, $sql);

    // Get the ID of the inserted order
   

    // Insert order details (products and quantities) into chi_tiet_oder_online table
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['gia'])) {
            $ma_thucuong = $item['ma'];
            $don_gia = $item['gia'];
            $so_luong = $item['quantity'];
             $total_price = $item['quantity'] * $item['gia'];
            $sql = "INSERT INTO chi_tiet_order_online (madon, makh, mathucuong, don_gia, so_luong,thanh_tien)
                    VALUES (@@identity, '$ma_khach_hang', '$ma_thucuong', '$don_gia', '$so_luong',' $total_price')";
            mysqli_query($conn, $sql);
        }
    }

    // Clear the shopping cart (remove products from the session)
    unset($_SESSION['cart']);

    // Redirect to a thank you page or confirmation page
    header("Location: history.php");
    exit(); // Make sure to exit after redirection
}
?>
