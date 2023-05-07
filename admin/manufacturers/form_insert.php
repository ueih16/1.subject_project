<?php require_once '../check_super_admin_login.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="post" action="process_insert.php" enctype="multipart/form-data">
	Tên nhà sản xuất
	<input type="text" name="name">
	<br>
	Ảnh
	<input type="file" name="image">
	<br>
	Số điện thoại
	<input type="text" name="phone_number">
	<br>
	Địa chỉ
	<textarea name="address"></textarea>
	<br>
	<button>Thêm nhà sản xuất</button>
</form>
</body>
</html>