<?php

 function givetime($date)
 {  
    date_default_timezone_set("asia/kolkata");
	$t2= $date;    
	$t1=time();
	 //$t1= strtotime( date("Y-m-d H:i:s",time()) );code reducion hahhaa
	 
	$sec= $t1-$t2;
	$min = floor($sec/60);
	$hr= floor($min/60);
	
		$value = NULL;
		if($sec>=0 && $sec<30)
		$value = "just now..";
		else if($sec>=30 && $sec<60)
		$value = "$sec sec";
		else if($sec>=60 && $sec<3600)
		$value = $min."m ago";
		else if($sec>=3600)
		$value = date("h:i d M",$date);
		
		return $value;							
 }
 function timenow()
 {
		date_default_timezone_set("asia/kolkata");
		return date("Y-m-d H:i:s");
 }
?>