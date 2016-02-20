<?php
include("dbconnect.php");
session_start();
$prod=$_GET['prod_id'];
$p=time()-$_SESSION['start'];
	$query=mysqli_query($con,"INSERT INTO time(user,prod,time) VALUES (48,$prod,$p)");
session_write_close();
?>