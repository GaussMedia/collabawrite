 <?php
 //
function con_time_stamp($session_time) 
{ 
	
	$time_difference = time() - $session_time ; 
	$seconds = $time_difference ; 
	$minutes = round($time_difference / 60 );
	$hours = round($time_difference / 3600 ); 
	$days = round($time_difference / 86400 ); 
	$weeks = round($time_difference / 604800 ); 
	$months = round($time_difference / 2419200 ); 
	$years = round($time_difference / 29030400 ); 
	
	if($seconds <= 60)
	{
	return "$seconds second ago"; 
	}
	else if($minutes <=60)
	{
	if($minutes==1)
	{
	return "1 minute ago"; 
	}
	else
	{
	return "$minutes minutes ago"; 
	}
	}
	else if($hours <=24)
	{
	if($hours==1)
	{
	return "1 hour ago";
	}
	else
	{
	return "$hours hours ago";
	}
	}
	else if($days <=7)
	{
	if($days==1)
	{
	return "1 day ago";
	}
	else
	{
	return "$days days ago";
	}
	
	
	
	}
	else if($weeks <=4)
	{
	if($weeks==1)
	{
	return "1 week ago";
	}
	else
	{
	return "$weeks weeks ago";
	}
	}
	else if($months <=12)
	{
	if($months==1)
	{
	return "1 month ago";
	}
	else
	{
	return "$months months ago";
	}
	
	
	}
	
	else
	{
	if($years==1)
	{
	return "1 year ago";
	}
	else
	{
	return "$years years ago";
	}
	
	
	}
	
	
	
	}

?> 