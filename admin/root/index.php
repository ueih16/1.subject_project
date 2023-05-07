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
		require_once '../menu.php';
		session_start();
		$name = $_SESSION['admin_name'];
	?>
	<h1>
		Đây là khu vực quản lí của ADMIN, xin chào <?php echo $name ?>
	</h1>
</body>
</html>