<?php 
session_start();
if (empty($_SESSION['id'])) { ?>
	<h1 align="center">
		<?php echo "Bạn chưa đăng nhập, hãy đăng nhập để mua sắm"; ?>
	</h1>
<?php } elseif (empty($_SESSION['cart'])) { ?>
	<h1 align="center">
		<?php echo "Bạn chưa có món đồ nào trong giỏ hàng, mua sắm ngay thôi !"; ?>
	</h1>
<?php } else { ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<style type="text/css">
	a
	{
		text-decoration: none;
	}
</style>
<body>
<?php
require_once 'header.php';
$cart = $_SESSION['cart'];
$total = 0;
?>
<table border="1" width="100%">
	<tr>
		<th>Mã</th>
		<th>Tên</th>
		<th>Ảnh</th>
		<th>Giá</th>
		<th>Số lượng</th>
		<th>Tổng tiền</th>
		<th>Xoá</th>
	</tr>
	<?php foreach ($cart as $id => $each): ?>
		<tr>
			<td align="center"><?php echo $each['id'] ?></td>
			<td><?php echo $each['name'] ?></td>
			<td align="center"><img src="admin/products/photo/<?php echo $each['image'] ?>" height="100"></td>
			<td align="center"><?php echo number_format($each['price'], 0, '', ',') ?> VND</td>
			<td align="center">
				<a href="update_cart.php?id=<?php echo $each['id'] ?>&type=decre">
					-
				</a>
				<?php echo $each['quantity'] ?>
				<a href="update_cart.php?id=<?php echo $each['id'] ?>&type=incre">
					+
				</a>
			</td>
			<td align="center"><?php echo number_format(($each['price']*$each['quantity']), 0, '', ',') ?> VND</td>
			<?php $total += ($each['price']*$each['quantity']) ?>
			<td align="center">
				<a href="process_delete.php?id=<?php echo $each['id'] ?>">Xoá</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<h1>
	Tổng tiền hoá đơn: <?php echo number_format($total, 0, '', ',') ?> VND
</h1>
<?php 
	require_once 'admin/connect.php';
	$id = $_SESSION['id'];
	$sql = "select * from customers where id = '$id'";
	$result = mysqli_query($connect,$sql);
	$each = mysqli_fetch_array($result);
?>
<form method="post" action="process_checkout.php">
	Tên người nhận
	<input type="text" name="receiver_name" value="<?php echo $each['name'] ?>">
	<br>
	Số điện thoại người nhận
	<input type="number" name="receiver_phone_number" value="<?php echo $each['phone_number'] ?>">
	<br>
	Địa chỉ người nhận
	<textarea name="receiver_address"><?php echo $each['address'] ?></textarea>
	<br>
	<button>Đặt hàng</button>
</form>
</body>
</html>
<?php } ?>