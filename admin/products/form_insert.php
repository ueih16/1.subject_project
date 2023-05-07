<?php require_once '../check_admin_login.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
require_once '../connect.php';
$sql = "select * from manufacturers";
$result = mysqli_query($connect,$sql);

$sql = "select * from types";
$types = mysqli_query($connect,$sql);
?>
<form method="post" action="process_insert.php" enctype="multipart/form-data">
	Tên sản phẩm
	<input type="text" name="name">
	<br>
	Ảnh
	<input type="file" name="image">
	<br>
	Giá
	<input type="text" name="price">
	<br>
	Mô tả
	<textarea name="description"></textarea>
	<br>
	Nhà sản xuất
	<select name="manufacturer_id">
		<?php foreach ($result as $each): ?>
			<option value="<?php echo $each['id'] ?>">
				<?php echo $each['name'] ?>
				</option>
		<?php endforeach ?>
	</select>
	<br>
	Thể loại sản phẩm
	<select name="type_id">
		<?php foreach ($types as $each): ?>
			<option value="<?php echo $each['id'] ?>">
				<?php echo $each['name'] ?>
				</option>
		<?php endforeach ?>
	</select>
	<br>
	<button>Thêm sản phẩm</button>
</form>
</body>
</html>