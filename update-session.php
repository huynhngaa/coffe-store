<?php
session_start();

if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = intval($_POST['quantity']);

    // Update the session data based on the product ID
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['ma'] == $productId) {
                $_SESSION['cart'][$key]['quantity'] = $quantity;
                break;
            }
        }
    }

    // Send a success response
    echo "Session data updated successfully";
} else {
    // Send an error response if the parameters are missing
    http_response_code(400);
    echo "Bad Request";
}
?>
