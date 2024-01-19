<?php
session_start();

// Clear the cart by setting it to an empty array
$_SESSION['cart'] = array();
