
<?php

require_once("../config.php");
require_once(ROOT_PATH . '/inc/products.php'); ?><?php

if (empty($_GET["pg"])){
	$current_page = 1;
} else {
	$current_page = $_GET["pg"];
}
$current_page = intval($current_page);

$total_products = get_products_count();
$products_per_page = 8;
$total_pages = ceil($total_products / $products_per_page);

if ($current_page > $total_pages){
	header("Location: ./?pg=" . $total_pages);
}

if ($current_page < 1){
	header("Location: ./");
}

$start = (($current_page - 1) * $products_per_page) + 1;

$end = $current_page * $products_per_page;

if($end > $total_products){
	$end = $total_products;
}


$products = get_products_subset($start, $end);


$pageTitle = "Full Catalogue of Shirts";
$section = "shirts";
include(ROOT_PATH . '/inc/header.php'); ?>

<div class="shirts_page">

    <div class="container">

		<h1>Full Catalogue of Shirts</h1>

		<?php include(ROOT_PATH . "inc/partial-list-navigation.html.php"); ?>

		<ul class="products">
			<?php foreach($products as $product){
					echo get_list_view_html($product);	          
				} 
			?>
		</ul>

		<?php include(ROOT_PATH . "inc/partial-list-navigation.html.php"); ?>
	</div>
</div>


<?php include(ROOT_PATH . '/inc/footer.php'); ?> 
