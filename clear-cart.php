<?php 
session_start();
unset($_SESSION['cart']);
$page = $_SERVER['HTTP_REFERER'];
header("Location: $page");

?>