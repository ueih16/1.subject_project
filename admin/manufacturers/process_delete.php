<?php 
require_once '../check_super_admin_login.php';
require_once '../connect.php';

$id = $_GET['id'];

$sql = "delete from manufacturers where id = '$id'
		";
mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');