<?php 

$term = $_GET['term'];

require_once 'admin/connect.php';
$sql = "select * from products where name like '%$term%'";
$result = mysqli_query($connect,$sql);
$arr = [];
foreach ($result as $each) {
	$arr[] =
	[
		'id' => $each['id'],
		'label' => $each['name'],
		'image' => $each['image'],
		'price' => number_format($each['price'], 0, '', ',').' VND'
	];
}
echo json_encode($arr);