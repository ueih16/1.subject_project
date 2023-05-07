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

$sql = "select * from types where id = '$id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
?>
<form method="post" action="process_update.php">
	<input type="hidden" name="id" value = "<?php echo $each['id'] ?>">
	Tên thể loại sản phẩm
	<input type="text" name="name" value = "<?php echo $each['name'] ?>">
	<br>
	<button>Sửa</button>
</form>
</body>
</html>