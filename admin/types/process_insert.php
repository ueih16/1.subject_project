<?php 

require_once '../check_super_admin_login.php';
require_once '../connect.php';

$name = $_POST['name'];

$sql = "insert into types(name)
		values('$name')
		";
mysqli_query($connect,$sql);

mysqli_close($connect);