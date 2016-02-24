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
	$query=mysqli_query($con,"INSERT INTO wishlist(user_id_wish,product_id_wish) VALUES ($user_id,$prod_id)");
mysqli_close($con);
?>