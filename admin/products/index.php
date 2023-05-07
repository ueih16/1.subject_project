<?php 
require_once '../check_admin_login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<style type="text/css">
	h1
	{
		text-align: center;
	}
</style>
<body>
	<?php require_once '../menu.php'; ?>
	<h1>
		<p align="center">
			Đây là khu vực quản lí sản phẩm
		</p>
	</h1>
	<?php 

	require_once '../connect.php';


	$search_product = '';
	
	if (isset($_GET['search_product'])) {
		$search_product = $_GET['search_product'];
	}
	$page = 1;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}

	$sql_product_number = "select count(*) from products
							join manufacturers on manufacturers.id = products.manufacturer_id
							join types on types.id = products.type_id
							where products.name like '%$search_product%'
							or manufacturers.name like '%$search_product%'
							or types.name like '%$search_product%'
							";
	
	$array_product_number = mysqli_query($connect,$sql_product_number);
	$result_product_number = mysqli_fetch_array($array_product_number);
	$product_number = $result_product_number['count(*)'];
	$product_per_page = 5;
	$page_number = ceil($product_number / $product_per_page);
	$pass = $product_per_page*($page-1);

	$sql = "select products.*,
			manufacturers.name as manufacturer_name,
			types.name as type_name
			from products
			join manufacturers on manufacturers.id = products.manufacturer_id
			join types on types.id = products.type_id
			where products.name like '%$search_product%'
			or manufacturers.name like '%$search_product%'
			or types.name like '%$search_product%'
			limit $product_per_page offset $pass
			";
	$result = mysqli_query($connect,$sql);
	?>
	<a href="form_insert.php">Thêm sản phẩm</a>
	<table border="1" width="100%">
		<caption>
			<form>
				<input type="search" name="search_product" value="<?php echo $search_product ?>">
				<button>Search</button>
			</form>
		</caption>
		<tr>
			<th>Mã</th>
			<th>Tên</th>
			<th>Ảnh</th>
			<th>Giá</th>
			<th>Tên nhà sản xuất</th>
			<th>Thể loại</th>
			<th>Sửa</th>
			<th>Xoá</th>
		</tr>
		<?php foreach ($result as $each): ?>
			<tr>
				<td align="center"><?php echo $each['id']; ?></td>
				<td>
					<a href="detail.php?id=<?php echo $each['id'] ?>">
						<?php echo $each['name']; ?>
					</a>
				</td>
				<td align="center"><img src="photo\<?php echo $each['image'] ?>" height='100'></td>
				<td align="center"><?php echo $each['price']; ?></td>
				<td align="center"><?php echo $each['manufacturer_name']; ?></td>
				<td align="center"><?php echo $each['type_name']; ?></td>
				<td align="center">
					<a href="form_update.php?id=<?php echo $each['id'] ?>">
						Sửa
					</a>
				</td>
				<td align="center">
					<a href="process_delete.php?id=<?php echo $each['id'] ?>">
						Xoá
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
	<div align="center">
		<?php for ($i=1; $i <= $page_number ; $i++) { ?>
			<a href="?page=<?php echo $i ?>&search_product=<?php echo $search_product ?>">
				<?php echo $i ?>
			</a>
		<?php } ?>
	</div>
</body>
</html>