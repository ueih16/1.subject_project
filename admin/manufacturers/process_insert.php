<?php 

require_once '../check_super_admin_login.php';
require_once '../connect.php';

$name = $_POST['name'];
$image = $_FILES['image'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

$folder = "photo/";
$file_extension = explode('.', $image['name'])[1];
$file_name = time() . '.' . $file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($image["tmp_name"], $path_file);

$sql = "insert into manufacturers(name,image,phone_number,address)
		values('$name','$file_name','$phone_number','$address')
		";
mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');