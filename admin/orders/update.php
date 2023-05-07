<?php 

require_once '../check_admin_login.php';
$id = $_GET['id'];
$status = $_GET['status'];

require_once '../connect.php';

$sql = "update orders set status = '$status' where id = '$id'";
mysqli_query($connect,$sql);

mysqli_close($connect);

header('location:index.php');