<?php 

session_start();

if (empty($_SESSION['id'])) {
	$_SESSION['error'] = "Bạn chưa đăng nhập, vui lòng đăng nhập!";
	header('location:index.php');
	exit();
}

$cart = $_SESSION['cart'];

$customer_id = $_SESSION['id'];
$receiver_name = $_POST['receiver_name'];
$receiver_phone_number = $_POST['receiver_phone_number'];
$receiver_address = $_POST['receiver_address'];
$total = 0;
$status = 0;

foreach ($cart as $id => $each) {
	$total += ($each['price']*$each['quantity']);
}

require_once 'admin/connect.php';
$sql = "insert into orders(customer_id, receiver_name, receiver_phone_number, receiver_address, status, total)
		values('$customer_id', '$receiver_name', '$receiver_phone_number', '$receiver_address', '$status', '$total')";

$result = mysqli_query($connect,$sql);
$sql = "select max(id) from orders where customer_id = '$customer_id'
	";
$result = mysqli_query($connect,$sql);
$order_id = mysqli_fetch_array($result)['max(id)'];

foreach ($cart as $product_id => $each) {
	$quantity = $each['quantity'];
	$sql = "insert into order_product(order_id,product_id,quantity)
			values('$order_id','$product_id','$quantity')
			";
	mysqli_query($connect,$sql);
}
mysqli_close($connect);
echo "Đặt hàng thành công";