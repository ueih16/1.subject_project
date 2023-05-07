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
	<?php require_once '../menu.php'; ?>
	<h1>
		<p align="center">
			Đây là khu vực quản lí nhà sản xuất
		</p>
	</h1>
	<?php 
	require_once '../connect.php';
	$sql = "select * from manufacturers";
	$result = mysqli_query($connect,$sql);
	?>
	<a href="form_insert.php">Thêm nhà sản xuất</a>
	<table border="1" width="100%">
		<tr>
			<th>Mã</th>
			<th>Tên</th>
			<th>Ảnh</th>
			<th>Số điện thoại</th>
			<th>Địa chỉ</th>
			<th>Sửa</th>
			<th>Xoá</th>
		</tr>
		<?php foreach ($result as $each): ?>
			<tr>
				<td align="center"><?php echo $each['id']; ?></td>
				<td><?php echo $each['name']; ?></td>
				<td align="center"><img src="photo\<?php echo $each['image'] ?>" height='100'></td>
				<td align="center"><?php echo $each['phone_number']; ?></td>
				<td align="center"><?php echo $each['address']; ?></td>
				<td align="center">
					<a href="form_update.php?id=<?php echo $each['id'] ?>">
						Sửa
					</a>
				</td>
				<td align="center">
					<a href="process_delete.php?id=<?php echo $each['id'] ?>">
						Xoá
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>