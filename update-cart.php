<?php
session_start();
include "connect.php";

// Check if the 'addtocart' button is clicked
if (isset($_POST['addtocart'])) {
   
    if (isset($_SESSION['cart'])) {
        $product_id = $_POST['pdt_id'];
        $quantity = intval($_POST['soluong']); // Convert to integer
        
        // Check if the product with the same ID is already in the cart
        $product_exists = false;
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['ma'] == $product_id) {
                // Product is already in the cart, update the quantity
                $_SESSION['cart'][$key]['quantity'] += $quantity;
                $product_exists = true;
                break; // Exit the loop since the product was found
            }
        }

        if (!$product_exists) {
            // Product is not in the cart, add it
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array(
                'ten' => $_POST['pdt_name'],
                'gia' => $_POST['pdt_price'],
                'hinh_anh' => $_POST['pdt_img'],
                'ma' => $_POST['pdt_id'],
                'quantity' => $quantity
            );
        }
    } else {
        // Cart is empty, add the product
        $_SESSION['cart'][0] = array(
            'ten' => $_POST['pdt_name'],
            'gia' => $_POST['pdt_price'],
            'hinh_anh' => $_POST['pdt_img'],
            'ma' => $_POST['pdt_id'],
            'quantity' => intval($_POST['soluong'])
        );
    }

    // Redirect back to the current page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit(); // Make sure to exit after redirection
}
?>
