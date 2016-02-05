<?php
echo "<div class='container'><div class='row'>";
session_start();
if(!isset($_SESSION['username']))
	{
	echo "<a href='Login.html'>Login</a><a href='Register.html'>&nbsp|&nbspRegister</a>";
	}
else
	{
	echo "<a href='Account.php'>";
	echo $_SESSION['username'];
	echo "</a><a href='Wishlist.html'>&nbsp|&nbspWishlist</a>";
	}
echo "</div></div>";
?>