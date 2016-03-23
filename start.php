<?php
session_start();
	//$_SESSION['start']=date('Y-m-d H:i:s');
	$_SESSION['start']= new DateTime();
session_write_close();
?>