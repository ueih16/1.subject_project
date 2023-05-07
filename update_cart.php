<?php 

session_start();

if (empty($_SESSION['id'])) {
	$_SESSION['error'] = "Bạn chưa đăng nhập, vui lòng đăng nhập!";
	header('location:index.php');
	exit();
}

$type = $_GET['type'];
$id = $_GET['id'];


if ($type == "incre") {
	$_SESSION['cart'][$id]['quantity'] ++;
}
elseif ($type == "decre") {
	if($_SESSION['cart'][$id]['quantity'] > 1){
		$_SESSION['cart'][$id]['quantity'] --;
	}
	else{
		unset($_SESSION['cart'][$id]);
	}
}

header('location:view_cart.php');
