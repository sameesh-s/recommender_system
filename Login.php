<?php
include "dbconnect.php";
include "user.php";
/*
$query="select user_id from user where email = '".$_POST['email']."' AND pwd = '".$_POST['pwd']."'";
$rslt=mysqli_query($con,$query);
   if(! $rslt ) {
      die('Could not get data: ' . mysql_error());
   } 
   while($row=mysqli_fetch_row($rslt)) {
   			session_start();
				$_SESSION['username']=$_POST['email'];
				//$_SESSION['user_id']=$row[0];
				session_write_close ();
			}  
mysqli_close($con);
*/
/*echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';*/
$username = $_POST['email'];
$password = $_POST['pwd'];
$cur_user = new User();
	$cur_user->signIn($username, $password);
header("Location: test.php");
?>