<?php
include 'head.html';
include 'isRegisterd.php';
include 'nav.html';
include 'product.php';
$param=$_GET['prodid'];
$current=new Product($param);
	$current->printBasic();
?>