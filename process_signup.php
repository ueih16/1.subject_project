<?php 

session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

require_once 'admin/connect.php';

$sql = "select count(*) from customers where email = '$email'";
$result = mysqli_query($connect,$sql);
$number_rows = mysqli_fetch_array($result)['count(*)'];

if ($number_rows == 1) {
	$_SESSION['error'] = "Trùng email rồi, vui lòng thử lại !";
	header('location:signup.php');
	exit;
}
else{
	$sql = "insert into customers(email,password,name,phone_number,address)
			values('$email','$password','$name','$phone_number','$address')
			";
	mysqli_query($connect,$sql);
	$sql = "select id from customers
			where email = '$email'
			";
	$result = mysqli_query($connect,$sql);
	$id = mysqli_fetch_array($result)['id'];

	$_SESSION['id'] = $id;
	$_SESSION['name'] = $name;

	mysqli_close($connect);
	header('location:index.php');
}