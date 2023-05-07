<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php 
$order_id = $_GET['id'];
require_once '../menu.php';
require_once '../connect.php';
$sql = "select order_product.*, products.image, products.name, products.price, orders.total, orders.status
		from order_product
		join products on products.id = order_product.product_id
		join orders on orders.id = order_product.order_id
		where order_id = '$order_id'
		";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
$total = 0;
?>
<h1 align="center">Xem chi tiết đơn hàng</h1>
<h1>Mã đơn hàng: <?php echo $order_id ?></h1>
<table border="1" width="100%">
	<tr>
		<th>Ảnh</th>
		<th>Tên sản phẩm</th>
		<th>Giá</th>
		<th>Số lượng</th>
		<th>Tổng tiền</th>
	</tr>
	<?php foreach ($result as $each): ?>
		<tr>
			<td align="center">
				<img src="../products/photo/<?php echo $each['image'] ?>" height="130">
			</td>
			<td><?php echo $each['name'] ?></td>
			<td align="center"><?php echo number_format($each['price'], 0, '', ',') ?> VND</td>
			<td align="center"><?php echo $each['quantity'] ?></td>
			<td align="center">
				<?php echo number_format($each['price']*$each['quantity'], 0, '', ',')?> VND
			</td>
		</tr>
	<?php endforeach ?>
</table>
<h1>Tổng tiền hoá đơn: <?php echo number_format($each['total'], 0, '', ',') ?></h1>
<h1>
	Tình trạng: 
	<?php 
	switch ($each['status']) {
		case '0':
			echo "Chờ duyệt";
			break;
		case '1':
			echo "Đã duyệt";
			break;
		case '2':
			echo "Đã huỷ";
			break;
	}
	?>
</h1>
<?php if ($each['status'] == 0): ?>
	<table border="1" width="20%">
		<tr align="center">
			<th>
				<a href="update.php?id=<?php echo $order_id ?>&status=1">
					Duyệt
				</a>
			</th>
			<th>
				<a href="update.php?id=<?php echo $order_id ?>&status=2">
					Huỷ
				</a>
			</th>
		</tr>
	</table>
<?php endif ?>
</body>
</html>