<?php 

require_once '../check_super_admin_login.php';
require_once '../connect.php';

$id = $_POST['id'];

$name = $_POST['name'];
$image_new  = $_FILES['image_new'];
if ($image_new['size']>0) 
	{
		$folder = "photo/";
		$file_extension = explode('.', $image_new['name'])[1];
		$file_name = time() . '.' . $file_extension;
		$path_file = $folder . $file_name;

		move_uploaded_file($image_new["tmp_name"], $path_file);
	}
else
{
	$file_name = $_POST['image_old'];
}
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

$sql = "update manufacturers set
		name = '$name',
		image = '$file_name',
		phone_number = '$phone_number',
		address = '$address'
		where id = '$id'
		";
mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');