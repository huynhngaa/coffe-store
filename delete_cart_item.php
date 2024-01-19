<?php
session_start();

$response = array();

if (isset($_GET['ma'])) {
    $productId = $_GET['ma'];

    // Loop through the cart and remove the item with the matching product ID
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['ma'] === $productId) {
            unset($_SESSION['cart'][$key]);
            $response['success'] = true;
            $response['message'] = 'Item successfully removed from the cart.';
            break; // Exit the loop once the item is removed
        }
    }
}

$page = $_SERVER['HTTP_REFERER'];
header("Location: $page");

?>
