<?php

function get_list_view_html($product) {

	$output = "";

	$output = $output . "<li>";
	// if(!$product["in_stock"]){
 //        $output = $output . '<img src="' . BASE_URL . 'img/sold_out.svg" class="sold">';
 //    } 
	$output = $output . '<a href="' . BASE_URL . 'shirts/' . $product["sku"] . '/">';
	$output = $output . '<img src="' . BASE_URL . $product["img"] . '" alt="' .  $product["name"] .'">';
	$output = $output . "<p>View Details</p>";
	$output = $output . "</a>";
	$output = $output . "</li>";

	return $output;
}

/* Returns the four most recent products, using the order of the elements in the array
 * @return  array           alist of the last four products in the array;
 *                          the most recent product is the last one in the array
 */
function get_products_recent() {
	require(ROOT_PATH . "inc/database.php");

	try {
		$results = $db->query("
			SELECT name, price, img, sku, paypal
			FROM products
			ORDER BY sku DESC
			LIMIT 4");

	} catch (Exception $e){
		echo "Data could not be retrieved from the database.";
	    exit;
	}

	$recent = $results->fetchAll(PDO::FETCH_ASSOC);
	$recent = array_reverse($recent);
	return $recent;
}

/* Looks for the search term in the product names
 * @param   string    $s     the search term
 * @return  array            alist of the products that contain the search term
 */
function get_products_search($s) {
	
	require(ROOT_PATH . "inc/database.php");

	try {
		$results = $db->prepare("
			SELECT name, price, img, sku, paypal 
			FROM products 
			WHERE name LIKE ?
			ORDER BY sku");

		$results->bindValue(1, "%" . $s . "%");
		$results->execute();

	} catch (Exception $e){
		echo "Data could not be retrieved from the database.";
	    exit;
	}

	$matches = $results->fetchAll(PDO::FETCH_ASSOC);

	return $matches;

}

function get_products_count(){
	require(ROOT_PATH . "inc/database.php");

	try {
		$results = $db->query("
			SELECT COUNT(sku)
			FROM products");

	} catch (Exception $e){
		echo "Data could not be retrieved from the database.";
	    exit;
	}

	return intval($results->fetchColumn(0));
}


/*-----------------------------------------------------------------------
 Load all of the shirts in array named $all.  Then, cycle through each
 shirt, checking the condtional to see if the shirt belongs in the subset,
 and add the shirt to $subset if this condition is met.Finally, return 
 the subset array.
-------------------------------------------------------------------------*/
function get_products_subset($positionStart, $positionEnd) {
	require(ROOT_PATH . "inc/database.php");

	$offset = $positionStart - 1;
	$rows = $positionEnd - $positionStart +1;


	try {
		$results = $db->prepare("
			SELECT name, price, img, sku, paypal 
			FROM products 
			ORDER BY sku
			LIMIT ?, ?");

		$results->bindParam(1, $offset, PDO::PARAM_INT);
		$results->bindParam(2, $rows,PDO::PARAM_INT);
		$results->execute();


	} catch (Exception $e){
		echo "Data could not be retrieved from the database.";
	    exit;
	}

	$subset = $results->fetchAll(PDO::FETCH_ASSOC);

	return $subset;
}


// function get_products_all() {
// 	$products = array();

	

// 	$products[105] = array(
// 		"name" => "Tiger Beer Shirt, Navy Blue",
// 		"img" => "img/shirts/tiger.png",
// 		"full_img" => "img/shirts/tiger_full.png",
// 		"price" => 10,
// 		"featured" => false,
// 		"paypal" => "GE7852K3FG3H6",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => true,
// 	);

// 	$products[106] = array(
// 		"name" => "Bia Hoi Shirt, Gray",
// 		"img" => "img/shirts/bia_hoi_shirt.png",
// 		"full_img" => "img/shirts/bia_hoi_shirt_full.png",
// 		"price" => 10,
// 		"featured" => true,
// 		"paypal" => "KA3LBHHTVK79A",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => true,
// 	);

// 	$products[107] = array(
// 		"name" => "Good Morning Vietnam, Navy Blue",
// 		"img" => "img/shirts/good_morning_vietnam.png",
// 		"full_img" => "img/shirts/good_morning_vietnam_full.png",
// 		"price" => 10,
// 		"featured" => false,
// 		"paypal" => "KA3LBHHTVK79A",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => false,
// 	);

// 	$products[108] = array(
// 		"name" => "Star Shirt, Red",
// 		"img" => "img/shirts/star_shirt.png",
// 		"full_img" => "img/shirts/star_shirt_full.png",
// 		"price" => 10,
// 		"featured" => false,
// 		"paypal" => "KA3LBHHTVK79A",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => false,
// 	);

// 	$products[101] = array(
// 		"name" => "Saigon Shirt, Red",
// 		"img" => "img/shirts/saigon_shirt.png",
// 		"full_img" => "img/shirts/saigon_shirt_full.png",
// 		"price" => 10,
// 		"featured" => true,
// 		"paypal" => "VJVYXMAXFMRB2",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => true,

// 	);

// 	$products[102] = array(
// 		"name" => "Vietnam Shirt, Green",
// 		"img" => "img/shirts/vietnam_shirt.png",
// 		"full_img" => "img/shirts/vietnam_shirt_full.png",
// 		"price" => 10,
// 		"featured" => true,
// 		"paypal" => "JEEDPXQGAG6VJ",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => true,
// 	);

// 	$products[103] =array(
// 		"name" => "Cheers Shirt, Blue",
// 		"img" => "img/shirts/cheers_shirt.png",
// 		"full_img" => "img/shirts/Yo.png",
// 		"price" => 10,
// 		"featured" => true,
// 		"paypal" => "PR3YHQ8QPD5SC",
// 		"sizes" => array("Small", "Medium", "Large", "X-Large"),
// 		"in_stock" => true,
// 	);

// 	$products[104] = array( 
// 		"name" => "No Honey, Pink",
// 		"img" => "img/shirts/honey_shirt.png",
// 		"full_img" => "img/shirts/honey_shirt_full.png",
// 		"price" => 10,
// 		"featured" => false,
// 		"paypal" => "H5654ZHN9PBA8",
// 		"sizes" => array("Small", "Medium"),
// 		"in_stock" => false,
// 	);

// 	/* Duplicating the product_id to have it in two places, allowing more flexibility*/
// 	foreach($products as $product_id => $product){
// 		$products[$product_id]["sku"] = $product_id;
// 	}

// 	return $products;

// }

/* Returns an array of product information for the product that matches the sku;
* returns a boolean false if no product matches the sku
* @param    int     $sku     the sku
* @return   mixed   array    list of all the product information matching the product
*                   bool     false if no product matches
*/
function get_product_single($sku){
	require(ROOT_PATH . "inc/database.php");

	try {
		$results = $db->prepare("SELECT name, price, img, fullimg, sku, paypal FROM products WHERE sku = ?");
		$results->bindParam((1),$sku);
		$results->execute();

	} catch (Exception $e) {
		echo "Data could not be retrieved from the database.";
	    exit;
	}

	$product = $results->fetch(PDO::FETCH_ASSOC);

	if ($product === false) {
		return $product;
	}

	$product["sizes"] = array();

	try{
		$results = $db->prepare("
			SELECT size 
		    FROM products_sizes ps 
		    INNER JOIN sizes s ON ps.size_id = s.id
		    WHERE product_sku = ?
		    ORDER BY `order`");
		$results->bindParam((1),$sku);
		$results->execute();

	} catch (Exception $e) {
		echo "Data could not be retrieved from the database.";
	    exit;
	}

	while($row = $results->fetch(PDO::FETCH_ASSOC)){
		$product["sizes"][] = $row["size"];
	}

	return $product;
}


?>