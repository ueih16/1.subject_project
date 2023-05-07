<?php 

session_start();

if (empty($_SESSION['id'])) {
	$_SESSION['error'] = "Bạn chưa đăng nhập, vui lòng đăng nhập!";
	header('location:index.php');
	exit();
}

$id = $_GET['id'];
unset($_SESSION['cart'][$id]);
header('location:view_cart.php');