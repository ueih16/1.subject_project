<?php 

require_once '../check_admin_login.php';

$name  = $_POST['name'];
$image  = $_FILES['image'];
$price  = $_POST['price'];
$description  = $_POST['description'];
$manufacturer_id  = $_POST['manufacturer_id'];
$type_id  = $_POST['type_id'];


$folder = "photo/";
$file_extension = explode('.', $image['name'])[1];
$file_name = time() . '.' . $file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($image["tmp_name"], $path_file);

require_once '../connect.php';
$sql = "insert into products(name,image,price,description,manufacturer_id,type_id)
	values('$name','$file_name','$price','$description','$manufacturer_id','$type_id')
	";
mysqli_query($connect,$sql);
mysqli_close($connect);
header('location:index.php');