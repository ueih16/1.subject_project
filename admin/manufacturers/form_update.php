<?php require_once '../check_super_admin_login.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php 
require_once '../connect.php';

$id = $_GET['id'];

$sql = "select * from manufacturers where id = '$id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
?>
<form method="post" action="process_update.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value = "<?php echo $each['id'] ?>">
	Tên nhà sản xuất
	<input type="text" name="name" value = "<?php echo $each['name'] ?>">
	<br>
	Đổi ảnh mới
	<input type="file" name="image_new">
	<br>
	Hoặc giữ ảnh cũ
	<img src="photo/<?php echo $each['image'] ?>" height = '100'>
	<input type="hidden" name="image_old" value="<?php echo $each['image'] ?>">
	<br>
	Số điện thoại
	<input type="text" name="phone_number" value = "<?php echo $each['phone_number'] ?>">
	<br>
	Địa chỉ
	<textarea name="address"><?php echo $each['address'] ?></textarea>
	<br>
	<button>Sửa</button>
</form>
</body>
</html>