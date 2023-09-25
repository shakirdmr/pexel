		<!DOCTYPE HTML>
		<html>
		<head>
		<title>Pexel</title>
				
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='SNS' />
		<meta name='Start' content='Start, Log In or Register' />
		<link rel='stylesheet'  href='@admin/css/main.css' />
		<link rel='stylesheet'  href='@admin/css/basics.css' />
		<link rel='icon' href='@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
			<style>
			.messengersTable:hover{
				background:#f9f9f9;
			}
			.channel_link{
					color: #5B6167;
			}
			.channel_link:hover{
					text-decoration:none;
			}
			
			</style>
		</head>
		<body>
		

	<?php 
	$username = $_COOKIE['username'];
	$email =  $_COOKIE['email'] ;
	
			require_once('db.php');
			require_once('checkQuery.php');
			require_once("traffic_saver.php");

		
  date_default_timezone_set("asia/kolkata");
  
	if(!isset($_GET["direct"]))
	header("location:home");	

	// Else >
		$direct_channel_with = $_GET["direct"];
	   if(isset($_POST["confirm_new"]))
	   {
	$username = $_COOKIE['username'];
	$email =  $_COOKIE['email'] ;
	   
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
	   }
	   
	   	require_once('head.php');
	   ?>
	<div style='margin:20px'>   
	  <h4>Are you sure you want to create a new contact with <b style='color:black'> <?=$direct_channel_with ?></b>. <br />
	  
	  It means that you will get new contact on Home and <b style='color:black'> <?=$direct_channel_with ?></b> will get a new feedback contact. 
		<h5>You are still hidden, anynonymus and  secure.  </h5>
		
		<?php
		
		$q="select * from users where username='$direct_channel_with'";
		$qry= mysqli_query($conn,$q);
		$arr= mysqli_fetch_array($qry);
		
		
		if(isset($arr['photo']))
		$photo= "traffic/user_profile/".$arr['photo']; 
		else $photo= "@admin/graphics/default.png";
	
		$name = $arr['name'];

			
		echo" 
			 <table  style='text-align:justify; width:100%;border-top:1px solid #EEF0F1;
			 padding:20px 10px 10px 10px'>
			 <tr>";	
		echo"<tr><td style='width:20%'>";	
		echo"
		<a href='profile?user=$direct_channel_with'>
		<img src={$photo}	style='height:60px;width:60px' class=avatar ></a> ";
		
		echo "<td style='width:20%'><b>$name<td style='width:40%'>	";
		
		echo"<td style='width:10%'>
			<form action='?direct=$direct_channel_with' method=POST>
			<input type='submit' class='followbox' style='width:100%;
			padding:5px 10px 5px 10px;' name='confirm_new'
			value='Create New'/></form></a>";
		
		?>