<?php
include 'dbconnect.php';
include 'user.php';

$prod=$_GET['prod_id'];
$cur_user = new User();
$user = $cur_user->getUserId();	
if($user>0)
{
session_start();
	$start=$_SESSION['start'];
	$_SESSION['start'] = 0;
	session_write_close();
$end= new DateTime();
	$last_access=$end->format('Y-m-d H:i:s');
$interval = $start->diff($end);
$min=$interval->format('%h')*60;
$min=$min+$interval->format('%i');
$min=$min+($interval->format('%S')/100);


        $query="select time from time where user = ".$user." AND prod = ".$prod." ";
        $rslt=mysqli_query($con,$query);
        $update=0;
        if(! $rslt )
            {die('Could not get data: ' . mysql_error());
    		} 
        while($row=mysqli_fetch_row($rslt))
            {	$update=1;
            	$prv_time=$row[0];
            	$prod = ($interval->format('%S'));
            	$min = $min + $prv_time;
            	$prv_time = $prv_time * 100;
            }  

        if($update==0)
        	{$query="INSERT INTO time(user,prod,time,last_access) VALUES (
			$user,
			$prod,
			$min,
			'$last_access')
			";
			}

		else
			{$query="INSERT INTO time(user,prod,time,last_access) VALUES (
			$prv_time,
			$prod,
			$min,
			'$last_access')
			";
			}
        $rslt=mysqli_query($con,$query);
mysqli_close($con);
}
?>