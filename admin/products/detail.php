<?php 	
require_once '../check_admin_login.php';
$id = $_GET['id'];
require_once '../connect.php';
require_once '../menu.php';
$sql = "select * from products where id = '$id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<h1>
	<?php echo $each['name'] ?>
</h1>
<img src="photo\<?php echo $each['image'] ?>" height="300">
<p>
	<?php echo $each['description'] ?>
</p>
Giá: $<?php echo $each['price'] ?>
<br>
<table border="1" width="25%">
	<tr>
		<td align="center"><a href="form_update.php?id=<?php echo $each['id'] ?>">Sửa sản phẩm</a></td>
		<td align="center"><a href="process_delete.php?id=<?php echo $each['id'] ?>">Xoá sản phẩm</a></td>
	</tr>
</table>
</body>
</html>