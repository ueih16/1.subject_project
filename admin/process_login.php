<?php 

require_once 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "select * from admins where email = '$email' and password = '$password'";
$result = mysqli_query($connect,$sql);
if (mysqli_num_rows($result) == 1) {
	$each = mysqli_fetch_array($result);
	session_start();
	$_SESSION['level'] = $each['level'];
	$_SESSION['admin_name'] = $each['name'];
	header('location:root');
	mysqli_close($connect);
}
else{
	session_start();
	$_SESSION['error'] = "Thông tin đăng nhập chưa chính xác!";
	header('location:index.php');
	exit;
}
