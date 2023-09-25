<?php

  // SAVING TRAFFIC --
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
	$ip = $client;
    else if(filter_var($forward, FILTER_VALIDATE_IP))
	$ip = $forward;
    else
	$ip = $remote;
	
	    $current_page  = addslashes( $_SERVER["PHP_SELF"]);
        require("db.php");
		$user_ip = $ip;
		$date = time();
	
		if(isset($_COOKIE["username"]))
		$username = $_COOKIE["username"];
	    else $username = "0";
	  
	    $q= "insert into traffic values ('$user_ip','$date','$username','$current_page')";
		mysqli_query($conn,$q);			
	?>