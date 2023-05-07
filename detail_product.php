<?php 
session_start();
if (empty($_GET['id'])) {
	$_SESSION['error'] = "Hãy chọn một sản phẩm để xem chi tiết!";
	header('location:index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<?php require_once 'style.php'; ?>
<body>
<div id='father_div'>
<?php require_once 'header.php'; ?>
<?php require_once 'detail.php'; ?>
<?php require_once 'footer.php';  ?>
</div>
</body>
</html>