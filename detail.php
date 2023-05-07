
<style type="text/css">
	.each_product
		{
			width : 33.22%;
			border: 1px solid black;
			height: 350px;
			float: left;
		}
	.each_header
		{
			width : 100%;
			border: none;
			height: 23%;
			float: left;

		}
	a
	{
		text-decoration: none;
	}
</style>
<?php 
$id = $_GET['id'];
require_once 'admin/connect.php';
$sql = "select * from products where id = '$id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
?>
<div id='middle_div'>
	<h1 align="center">
		<?php echo $each['name'] ?>
	</h1>
	<p align="center">
		<img src="admin\products\photo\<?php echo $each['image'] ?>" height="200">
	</p>
	<br>
	<p>
		<?php echo $each['description'] ?>
	</p>
	<br>
	<?php echo number_format($each['price'], 0, '', ',') ?> VND
</div>