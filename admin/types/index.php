<?php require_once '../check_super_admin_login.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<style type="text/css">
	h1
	{
		text-align: center;
	}
</style>
<body>
<?php 
require_once '../connect.php';
require_once '../menu.php';
?>
<h1>
	<p align="center">
		Đây là khu vực quản lí thể loại sản phẩm
	</p>
</h1>
<?php 
$sql = "select * from types";
$result = mysqli_query($connect,$sql);
?>
<a href="form_insert.php">
	<p align="center">
		Thêm thể loại sản phẩm
	</p>
</a>
<table border="1" width="40%" align="center">
	<tr>
		<th>Mã</th>
		<th>Tên thế loại sản phẩm</th>
		<th>Sửa</th>
		<th>Xoá</th>
	</tr>
	<?php foreach ($result as $each): ?>
		<tr>
			<td><?php echo $each['id'] ?></td>
			<td><?php echo $each['name'] ?></td>
			<td><a href="form_update.php?id=<?php echo $each['id'] ?>">Sửa</a></td>
			<td><a href="process_delete.php?id=<?php echo $each['id'] ?>">Xoá</a></td>
		</tr>
	<?php endforeach ?>
</table>
</body>
</html>