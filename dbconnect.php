<?php
	$con = mysqli_connect("localhost","root","safeer");
	mysqli_select_db($con,"mcadb") or die(mysqli_error($con));
	echo "connection established";
?>
