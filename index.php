<?php

session_start();

if (isset($_COOKIE['remember'])) {
	$token = $_COOKIE['remember'];
	require_once 'admin/connect.php';
	$sql = "select * from customers where token = '$token'";
	$result = mysqli_query($connect,$sql);
	$number_rows = mysqli_num_rows($result);
	if ($number_rows == 1) {
		$each = mysqli_fetch_array($result);
		$_SESSION['id'] = $each['id'];
		$_SESSION['name'] = $each['name'];
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
</head>
<?php require_once 'style.php'; ?>
<body>
<div id='father_div'> 
<?php require_once 'header.php'; ?>
<?php require_once 'products.php'; ?>
<?php require_once 'footer.php';  ?>
</div>
</body>
</html>