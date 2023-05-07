<?php 	
session_start();

if (isset($_COOKIE['remember'])) {
	$token = $_COOKIE['remember'];
	require_once 'admin/connect.php';
	$sql = "select * from customers where token = '$token'";
	$result = mysqli_query($connect,$sql);
	$number_rows = mysqli_num_rows($result);
	if ($number_rows == 1) {
		header('location:index.php');
	}
	
}
if (isset($_SESSION['error'])) {
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="post" action="process_signin.php">	
	<h1>Form đăng nhập</h1>
	Email
	<input type="text" name="email" id="email">
	<span id="error_email"></span>
	<br>
	Password
	<input type="text" name="password" id="password">
	<span id="error_password"></span>
	<br>
	Ghi nhớ mật khẩu
	<input type="checkbox" name="remember">
	<br>
	<button onclick="return check()">Đăng nhập</button>
</form>
</body>
<script type="text/javascript">
	function check()
	{
		let check_flag = false;

		//email check
		let email = document.getElementById('email').value;
		if (email.length === 0) 
		{
			document.getElementById('error_email').innerHTML = "Email không được để trống!";
			check_flag = true;
		}
		else {

			let regex_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
			if (regex_email.test(email) == false) {
			document.getElementById('error_email').innerHTML = "Email không hợp lệ!";
			check_flag = true;
			}
			else{
				document.getElementById('error_email').innerHTML = "";
			}
		}

		//password check
		let password = document.getElementById('password').value;
		if (password.length == 0) {
			document.getElementById('error_password').innerHTML = "Password không được để trống!";
			check_flag = true;
		}
		else {
			let regex_password = /^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/;
			if (regex_password.test(password) == false) {
				document.getElementById('error_password').innerHTML = "Password phải bao gồm ít nhất 6 ký tự, ít nhất 1 ký tự viết hoa, 1 ký tự viết thường và 1 số!";
				check_flag = true;
			}
			else{
				document.getElementById('error_password').innerHTML = "";
			}
		}

		//end check
		if (check_flag) {
			return false;
		}
	}
</script>
</html>