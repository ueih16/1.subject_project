<?php 

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
if (isset($_POST['remember'])) {
	$remember = true;
}
else
{
	$remember = false;
}

require_once 'admin/connect.php';

$sql = "select count(*) from customers where email = '$email' and password = '$password'";
$result = mysqli_query($connect,$sql);
$number_rows = mysqli_fetch_array($result)['count(*)'];

if ($number_rows == 1) {
	$sql = "select * from customers where email = '$email' and password = '$password'";
	$result = mysqli_query($connect,$sql);
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$name = $each['name'];
	if ($remember == true) {
		$token = uniqid('user_',true);
		$sql = "update customers
				set 
				token = '$token'
				where id = '$id'
				";
		mysqli_query($connect,$sql);
		setcookie('remember',$token,time() + 60*60*24*30);
	}
	else{
		$_SESSION['id'] = $id;
		$_SESSION['name'] = $name;
	}
	mysqli_close($connect);
	$_SESSION['success'] = "Đăng nhập thành công";
	header('location:index.php');
	exit;
}
else{
	$_SESSION['error'] = "Thông tin đăng nhập chưa đúng, vui lòng kiểm tra lại!";
	mysqli_close($connect);
	header('location:signin.php');
}