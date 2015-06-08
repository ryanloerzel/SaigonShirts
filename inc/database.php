<?php

try{
	$db = new PDO("mysql: host=localhost; dbname=saigonshirts; port=3306", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
	echo "Connected!";

}catch (Exception $e) {
	echo "Could not connect to the database.";
	exit;
}

// try {
// 	$results = $db->query("SELECT name, price, img, sku, paypal FROM products ORDER BY sku ASC");
// } catch (Exception $e){
// 	echo "Data could not be retrieved from the database.";
// 	exit;

// }

// echo "<pre>";
// var_dump($results->fetchAll(PDO::FETCH_ASSOC));