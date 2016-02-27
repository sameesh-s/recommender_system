<?php
include 'dbconnect.php';
include 'user.php';
function addMinutes($min1,$min2)
	{
	$prv_min = intval($min1);
	$prv_seconds = $min1 - $prv_min; 
	$next_min = intval($min2);
	$next_seconds = $min2 - $next_min;
	$seconds = $prv_seconds + $next_seconds;
	$remain = ($seconds * 100) % 60 ;
	$total_min =intval($seconds / .60) +  $next_min + $prv_min + ((($seconds * 100) % 60)/ 100 ) ;
	return $total_min;
	}
$prod=$_GET['prod_id'];
$cur_user = new User();
$user = $cur_user->getUserId();	
if($user>0)
{
session_start();
	$start=$_SESSION['start'];
	$te1=$start->format('Y-m-d H:i:s');
	session_write_close();
$end= new DateTime();
	$last_access=$end->format('Y-m-d H:i:s');
$interval = $start->diff($end);
$min=$interval->format('%i.%S');
$min=floatval($min)+ $interval->format('%h')*60;
        $query="select time from time where user = ".$user." AND prod = ".$prod." ";
        $rslt=mysqli_query($con,$query);
        $update=0;
        if(! $rslt )
            {die('Could not get data: ' . mysql_error());
    		} 
        while($row=mysqli_fetch_row($rslt))
            {	$update=1;
            	$prv_time=$row[0];
            	$min = addMinutes($min ,$prv_time);
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
			{$query="UPDATE time 
			SET time=".$min.", last_access='".$last_access."' 
			WHERE user=".$user." AND prod=".$prod." ";
			}
        $rslt=mysqli_query($con,$query);
mysqli_close($con);
}
?>