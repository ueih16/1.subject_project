<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php 

require_once '../menu.php';
require_once '../connect.php';
$sql = "select orders.*, customers.name, customers.phone_number, customers.address from orders
		join customers on customers.id = orders.customer_id";
$result = mysqli_query($connect,$sql);
?>
<h1 align="center">Đây là khu vực quản lý đơn hàng</h1>
<table border="1" width="100%">
	<tr>
		<th>Id</th>
		<th>Thời gian đặt</th>
		<th>Thông tin người đặt</th>
		<th>Thông tin người nhận</th>
		<th>Trạng thái</th>
		<th>Tổng tiền</th>
		<th>Xem chi tiết</th>
		<th>Duyệt</th>
		<th>Huỷ</th>
	</tr>
	<?php foreach ($result as $each): ?>
		<tr>
			<td align="center"><?php echo $each['id'] ?></td>
			<td align="center"><?php echo $each['created_at'] ?></td>
			<td>
				<?php echo $each['name'] ?>
				<br>
				<?php echo $each['phone_number'] ?>
				<br>
				<?php echo $each['address'] ?>
			</td>
			<td>
				<?php echo $each['receiver_name'] ?>
				<br>
				<?php echo $each['receiver_phone_number'] ?>
				<br>
				<?php echo $each['receiver_address'] ?>
			</td>
			<td align="center">
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
			</td>
			<td align="center"><?php echo number_format($each['total'], 0, '', ',') ?> VND</td>
			<td align="center">
				<a href="detail.php?id=<?php echo $each['id'] ?>">Xem</a>
			</td>
			<?php if ($each['status'] == 0): ?>
			<td align="center">
				<a href="update.php?id=<?php echo $each['id'] ?>&status=1">X</a>
			</td>
			<td align="center">
				<a href="update.php?id=<?php echo $each['id'] ?>&status=2">X</a>
			</td>
			<?php endif ?>
		</tr>
	<?php endforeach ?>
</table>
</body>
</html>