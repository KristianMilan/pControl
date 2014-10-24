<?php
include 'rb.php';
include 'dbconfig.php';
$category = R::dispense('category');
	$category->name = "lampki";
	$category->column = "1";
	R::store($category);
?>