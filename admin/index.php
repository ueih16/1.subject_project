<?php 	
session_start();
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
<form method="post" action="process_login.php">
	<h1>FORM ĐĂNG NHẬP ADMIN</h1>
	Email
	<input type="text" name="email">
	<br>
	Mật khẩu
	<input type="text" name="password">
	<br>
	<button>Đăng nhập</button>
</form>
</body>
</html>