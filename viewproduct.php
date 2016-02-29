<?php
include 'head.html';
include 'isRegisterd.php';
include 'nav.html';
include 'product.php';
$param=$_GET['prodid'];
$current=new Product($param);
	$current->generateScript();
	$current->printWhole();
?>
 <script>
  window.addEventListener("beforeunload", function (e) { end();
    (e || window.event).returnValue = null ;
    return null;
    </script>