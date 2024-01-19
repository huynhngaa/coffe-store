<?php
include "connect.php";
session_start();

$err = [];

if (isset($_POST['edit'])) {
    if (isset($_SESSION['login'])) {
        $customer = $_SESSION['login'];
        $id = $customer['ma'];
    }
    $old = md5($_POST['old']);
    $new = md5($_POST['new']);
    
    // Update the database with the new image path
    $sqllogin = "SELECT * FROM tai_khoan t , khach_hang k  WHERE t.makh= k.ma AND mat_khau='$old' AND role=1";
    $reslogin = mysqli_query($conn, $sqllogin);
    if (mysqli_num_rows($reslogin) != 1) {
        $sql = "UPDATE `tai_khoan` SET `mat_khau`='$new' WHERE  `ma` =$id";
        mysqli_query($conn, $sql);
        header('location: profile.php');
    }
}
?>
