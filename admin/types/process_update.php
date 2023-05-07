<?php 

require_once '../check_super_admin_login.php';
require_once '../connect.php';

$id = $_POST['id'];

$name = $_POST['name'];

$sql = "update types set
		name = '$name'
		where id = '$id'
		";
mysqli_query($connect,$sql);

mysqli_close($connect);