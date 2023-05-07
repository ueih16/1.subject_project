<?php 
require_once 'admin/connect.php';


$page = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
$search_product = '';
	
	if (isset($_GET['search_product'])) {
		$search_product = $_GET['search_product'];
	}

$sql_product_number = "select count(*) from products
						join manufacturers on manufacturers.id = products.manufacturer_id
						where products.name like '%$search_product%'
						or manufacturers.name like '%$search_product%'
						";
$array_product_number = mysqli_query($connect,$sql_product_number);
$result_product_number = mysqli_fetch_array($array_product_number);
$product_number = $result_product_number['count(*)'];

$product_per_page = 6;

$page_number = ceil($product_number / $product_per_page);

$pass = $product_per_page*($page-1);

$sql = "select products.*, manufacturers.name as manufacturer_name from products
		join manufacturers on manufacturers.id = products.manufacturer_id
		where products.name like '%$search_product%'
		or manufacturers.name like '%$search_product%'
		limit $product_per_page offset $pass
		";
$result = mysqli_query($connect,$sql);
?>
<div id='middle_div'>
	<caption>
		<form>
			<input type="search" id="project" name="search_product" value="<?php echo $search_product ?>">
			<button>Search</button>
 			<input type="hidden" id="project-id">
		</form>
	</caption>
	<?php foreach ($result as $each): ?>
		<div class="each_product">
			<div class="each_header">
				<h2>
					<p align="center">
						<?php echo $each['name'] ?>
					</p>
				</h2>
			</div>
			<div class="each_center"></div>
			<p align="center">
				<img src="admin\products\photo\<?php echo $each['image'] ?> " height="170">
			</p>
			<br>
			<?php echo number_format($each['price'], 0, '', ',') ?> VND
			<br>
			Thương hiệu: <?php echo $each['manufacturer_name'] ?>
			<br>
			<a href="detail_product.php?id=<?php echo $each['id'] ?>">
				Xem chi tiết >>>
			</a>
			<?php if (isset($_SESSION['id'])): ?>
			<br>
				<a href="add_to_cart.php?id=<?php echo $each['id'] ?>">
					Thêm vào giỏ hàng
				</a>
			<?php endif ?>
		</div>
	<?php endforeach ?>
	<div class="pagination" align="center">
		<?php for ($i=1; $i <= $page_number ; $i++) { ?>
			<a href="?page=<?php echo $i ?>&search_product=<?php echo $search_product ?>">
				<?php echo $i ?>
			</a>
		<?php } ?>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $( "#project" ).autocomplete({
        source: "search.php",
        focus: function( event, ui ) {
          $( "#project" ).val( ui.item.label );
          return false;
        },
        select: function( event, ui ) {
          var productId = ui.item.id;
          window.location.href = "detail_product.php?id=" + productId;

          return false;
        }
      })
      .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append(` <div>
          ${item.label}
          <br>
          <img src="admin/products/photo/${item.image}" height="50">
          ${item.price}
          </div>`)
        .appendTo( ul );
      };

    });
  </script>