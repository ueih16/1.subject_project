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
?>
<h1 align="center">Thống kê sản phẩm</h1>
Chọn thời gian
<input type="date" value="<?php echo date('y-m-d') ?>">
<input type="month">
<input type="week" name="">
<select>
	<?php for($i = date('Y') ; $i >= 1970 ; $i--) {?>
		<option>
			<?php echo $i ?>
		</option>
	<?php } ?>
</select>
<?php 
$sql = "select sum(total) as sum from orders where status = 1";
$result = mysqli_query($connect,$sql);
?>
<h1>Doanh thu: <?php echo number_format(mysqli_fetch_array($result)['sum'], 0, '', ',') ?> VND</h1>
<?php 
$sql = "select * from types ";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
?>
<table border="1" width="23%" align="center">
	<tr>
		<th>Mã</th>
		<th>Tên</th>
		<th>Số lượng sản phẩm</th>
	</tr>
	<?php foreach ($result as $each): ?>
		<?php
		$id = $each['id'];
		$sql = "select count(*) from products where type_id = '$id'";
		$products = mysqli_query($connect,$sql);
		$quantity = mysqli_fetch_array($products)['count(*)'];
		?>
		<tr>
			<td><?php echo $each['id'] ?></td>
			<td><?php echo $each['name'] ?></td>
			<td><?php echo $quantity ?></td>
		</tr>
	<?php endforeach ?>
</table>
<?php 
$sql = "select * from manufacturers ";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
?>
<table border="1" width="33%" align="center">
	<tr>
		<th>Mã NSX</th>
		<th>Tên NSX</th>
		<th>Số lượng sản phẩm</th>
	</tr>
	<?php foreach ($result as $each): ?>
		<?php
		$id = $each['id'];
		$sql = "select count(*) from products where manufacturer_id = '$id'";
		$products = mysqli_query($connect,$sql);
		$quantity = mysqli_fetch_array($products)['count(*)'];
		?>
		<tr>
			<td><?php echo $each['id'] ?></td>
			<td><?php echo $each['name'] ?></td>
			<td><?php echo $quantity ?></td>
		</tr>
	<?php endforeach ?>
</table>
<?php 
$sql = "select count(*) from customers";
$result = mysqli_query($connect,$sql); 
?>
<h1 align="center">Thống kê khách hàng</h1>
<h3>Số lượng khách hàng: <?php echo mysqli_fetch_array($result)['count(*)'] ?></h3>
<?php 
$sql = "select customers.id, customers.name, sum(orders.total) as total_paid from customers 
		join orders on orders.customer_id = customers.id 
		group by orders.customer_id 
		order by total_paid desc";
$result = mysqli_query($connect,$sql);
$best_customer = mysqli_fetch_array($result);
?>
<h3>Khách hàng tiềm năng</h3>
<table border="1" width="40%">
	<tr>
		<th>Mã</th>
		<th>Tên</th>
		<th>Số tiền đã chi</th>
	</tr>
	<tr align="center">
		<td><?php echo $best_customer['id'] ?></td>
		<td><?php echo $best_customer['name'] ?></td>
		<td><?php echo number_format($best_customer['total_paid'], 0, '', ',') ?> VND</td>
	</tr>
</table>
<br>
<h1 align="center">Thống kê bán hàng</h1>
<?php 
$sql = "select products.id, products.name, manufacturers.name as manufacturer_name, types.name as type_name ,IFNULL(sum(quantity),0) as sale from products 
		left join order_product on order_product.product_id = products.id 
		left join orders on orders.id = order_product.order_id 
		join manufacturers on manufacturers.id = products.manufacturer_id 
		join types on types.id = products.type_id 
		where orders.status = 1 or orders.id is null
		group by products.id
		order by sale DESC";
$result = mysqli_query($connect,$sql);
$best = mysqli_fetch_array($result);
$sql = "select products.id, products.name, manufacturers.name as manufacturer_name, types.name as type_name ,IFNULL(sum(quantity),0) as sale from products 
		left join order_product on order_product.product_id = products.id 
		left join orders on orders.id = order_product.order_id 
		join manufacturers on manufacturers.id = products.manufacturer_id 
		join types on types.id = products.type_id 
		where orders.status = 1 or orders.id is null
		group by products.id
		order by sale asc, id ASC;";
$worst = mysqli_fetch_array(mysqli_query($connect,$sql));
?>
<h3>Sản phẩm bán chạy nhất</h3>
<table border="1" width="100%">
	<tr>
		<th>Mã SP</th>
		<th>Tên SP</th>
		<th>Tên NSX</th>
		<th>Thể loại</th>
		<th>Đã bán</th>
	</tr>
	<tr>
		<td><?php echo $best['id'] ?></td>
		<td><?php echo $best['name'] ?></td>
		<td><?php echo $best['manufacturer_name'] ?></td>
		<td><?php echo $best['type_name'] ?></td>
		<td><?php echo $best['sale'] ?></td>
	</tr>
</table>
<h3>Sản phẩm bán kém nhất</h3>
<table border="1" width="100%">
	<tr>
		<th>Mã SP</th>
		<th>Tên SP</th>
		<th>Tên NSX</th>
		<th>Thể loại</th>
		<th>Đã bán</th>
	</tr>
	<tr>
		<td><?php echo $worst['id'] ?></td>
		<td><?php echo $worst['name'] ?></td>
		<td><?php echo $worst['manufacturer_name'] ?></td>
		<td><?php echo $worst['type_name'] ?></td>
		<td><?php echo $worst['sale'] ?></td>
	</tr>
</table>
<h3>Danh sách sản phẩm</h3>
<table border="1" width="100%">
	<tr>
		<th>Mã SP</th>
		<th>Tên SP</th>
		<th>Tên NSX</th>
		<th>Thể loại</th>
		<th>Đã bán</th>
	</tr>
	<?php foreach ($result as $each): ?>
		<tr>
			<td align="center"><?php echo $each['id'] ?></td>
			<td><?php echo $each['name'] ?></td>
			<td><?php echo $each['manufacturer_name'] ?></td>
			<td align="center"><?php echo $each['type_name'] ?></td>
			<td align="center"><?php echo $each['sale'] ?></td>
		</tr>
	<?php endforeach ?>
</table>
</body>
</html>