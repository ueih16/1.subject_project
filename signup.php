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
<form method="post" action="process_signup.php">	
	<h1>Form đăng ký</h1>
	Email
	<input type="text" name="email" id="email">
	<span id="error_email"></span>
	<br>
	Password
	<input type="text" name="password" id="password">
	<span id="error_password"></span>
	<br>
	Họ tên
	<input type="text" name="name" id="name">
	<span id="error_name"></span>
	<br>
	Số điện thoại
	<input type="number" name="phone_number" id="phone_number">
	<span id="error_phone_number"></span>
	<br>
	Địa chỉ
	<textarea name="address"></textarea>
	<br>
	<button onclick="return check()">Đăng ký</button>
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


		//phone number check
		let phone_number = document.getElementById('phone_number').value;
		if (phone_number.length == 0) {
			document.getElementById('error_phone_number').innerHTML = "Số điện thoại không được để trống!";
			check_flag = true;
		}
		else {
			let regex_phone_number = /^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/;
			if (regex_phone_number.test(phone_number) == false) {
				document.getElementById('error_phone_number').innerHTML = "Số điện thoại không hợp lệ!";
				check_flag = true;
			}
			else{
				document.getElementById('error_phone_number').innerHTML = "";
			}
		}

		//end check
		if (check_flag) {
			return false;
		}
	}
</script>
</html>