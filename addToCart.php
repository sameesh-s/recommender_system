<?php
include "dbconnect.php";
	session_start();
	$query="select user_id from user where email = '".$_SESSION['username']."'";
	session_write_close ();
	$rslt=mysqli_query($con,$query);
   	if(! $rslt ) 
   		{
    	die('Could not get data: ' . mysql_error());
   		} 
   while($row=mysqli_fetch_row($rslt)) {
				$user_id=$row[0];
			} 
	$prod_id=$_GET['prod_id'];
	$query=mysqli_query($con,"INSERT INTO cart_line(user_id_cart,product_id_cart,quantity) VALUES ($user_id,$prod_id,1)");
mysqli_close($con);
?>