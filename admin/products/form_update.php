<?php 
require_once '../check_admin_login.php';
?>
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

$sql = "select * from products where id = '$id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);

$sql = "select * from manufacturers";
$manufacturers = mysqli_query($connect,$sql);

$sql = "select * from types";
$types = mysqli_query($connect,$sql);
?>
<form method="post" action="process_update.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
	Tên sản phẩm
	<input type="text" name="name" value = "<?php echo $each['name'] ?>">
	<br>
	Đổi ảnh mới
	<input type="file" name="image_new">
	<br>
	Hoặc giữ ảnh cũ
	<img src="photo/<?php echo $each['image'] ?>" height = '100'>
	<input type="hidden" name="image_old" value="<?php echo $each['image'] ?>">
	<br>
	Giá
	<input type="number" name="price" value = "<?php echo $each['price'] ?>">
	<br>
	Mô tả
	<textarea name="description"><?php echo $each['description'] ?></textarea>
	<br>
	Nhà sản xuất
	<select name="manufacturer_id">
		<?php foreach ($manufacturers as $manufacturers): ?>
			<option value="<?php echo $manufacturers['id'] ?>"
				<?php if ($each['manufacturer_id'] == $manufacturers['id']) { ?>
					selected
				<?php } ?>>
				<?php echo $manufacturers['name'] ?>
			</option>
		<?php endforeach ?>
	</select>
	<br>
	Thể loại sản phẩm
	<select name="type_id">
		<?php foreach ($types as $types): ?>
			<option value="<?php echo $types['id'] ?>"
				<?php if ($each['type_id'] == $types['id']) { ?>
					selected
				<?php } ?>>
				<?php echo $types['name'] ?>
			</option>
		<?php endforeach ?>
	</select>
	<br>
	<button>Sửa</button>
</form>
</body>
</html>