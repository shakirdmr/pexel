<?php 
  date_default_timezone_set("asia/kolkata");
  
	if(!isset($_GET["direct"]))
	header("location:home.php");	

	// Else >
	require('db.php');
	
	$direct_channel_with = $_GET["direct"];
	$username = $_COOKIE['username'];
	$email =  $_COOKIE['email'] ;
	   
	   //Check if channel created >>
		$q = "select * from channels where owner='$username' AND reciever ='$direct_channel_with' order by time desc";
		$qr = mysqli_query($conn,$q);
		$any_channel = mysqli_num_rows($qr);
		
		if($any_channel != 0)
		{    
			$ar = mysqli_fetch_array($qr);
			$channel  =$ar["name"];
			header("location:direct?direct=$channel#last");
			die();
		}
		// Else
			
		if(mysqli_query($conn,$q))
		$time = time();
		$channel_name = "feed".substr(mt_rand(),0,6);			
			
		$q = "insert into channels (name,time,owner,reciever)
	    values('$channel_name','$time','$username','$direct_channel_with')";
	
			
		if(mysqli_query($conn,$q))
		{					
					$q = "update channels set last_message_time ='$time'
					where name='$channel_name'";
					mysqli_query($conn,$q);
				
				header("location:direct?direct=$channel_name"); 
		}
	    else echo mysqli_error($conn);
  ?>