<?php 

session_start();

if (empty($_SESSION['id'])) {
	$_SESSION['error'] = "Bạn chưa đăng nhập, vui lòng đăng nhập!";
	header('location:index.php');
	exit();
}
if (empty($_GET['id'])) {
	$_SESSION['error'] = "Vui lòng thêm một sản phẩm vào giỏ hàng";
	header('location:index.php');
	exit;
}
$id = $_GET['id'];

if (empty($_SESSION['cart'][$id])) {
	require_once 'admin/connect.php';
	$sql = "select * from products where id = '$id'";
	$result = mysqli_query($connect,$sql);
	if (mysqli_num_rows($result) == 0) {
		$_SESSION['error'] = "Sản phẩm không tồn tại, vui lòng chọn sản phẩm khác!";
		header('location:index.php');
		exit;
	}
	else{
		$each = mysqli_fetch_array($result);
		$_SESSION['cart'][$id]['id'] = $id;
		$_SESSION['cart'][$id]['name'] = $each['name'];
		$_SESSION['cart'][$id]['image'] = $each['image'];
		$_SESSION['cart'][$id]['price'] = $each['price'];
		$_SESSION['cart'][$id]['quantity'] = 1;
		$_SESSION['noti'] = "Thêm vào giỏ hàng thành công";
		header('location:index.php');
	}

} else {
	$_SESSION['cart'][$id]['quantity']++;
	$_SESSION['noti'] = "Thêm vào giỏ hàng thành công";
	header('location:index.php');
}



