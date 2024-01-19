<?php
include "connect.php";
session_start(); // Start or resume the session

if (isset($_POST['edit'])) {
    if (isset($_SESSION['login'])) {
        $customer = $_SESSION['login'];
        $id = $customer['ma'];
    }

    $name = $_POST['name'];
    $sdt = $_POST['sdt'];
    $dc = $_POST['dc'];

    // Handle image upload
    $image_name = $_FILES['hinh']['name'];
    $image_tmp = $_FILES['hinh']['tmp_name'];

    // Check if an image was uploaded
    if (!empty($image_name)) {
        $image_path = "img/" . $image_name;

        // Move the uploaded image to a specific directory
        move_uploaded_file($image_tmp, $image_path);

        // Update the database with the new image path
        $sql = "UPDATE `khach_hang` 
                SET `ten`='$name', `hinh_kh`='$image_name', `dia_chi`='$dc', `so_dien_thoai`='$sdt' 
                WHERE `ma` =$id";

        mysqli_query($conn, $sql);
    } else {
        // No image was uploaded, update the database without changing the image
        $sql = "UPDATE `khach_hang` 
                SET `ten`='$name', `dia_chi`='$dc', `so_dien_thoai`='$sdt' 
                WHERE `ma` =$id";

        mysqli_query($conn, $sql);
    }

    header('location: profile.php');
}
?>
