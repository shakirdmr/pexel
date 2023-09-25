		<?php 
						if(!isset($_COOKIE['email']) )
						header("location:index");
		?>		
		
		<!DOCTYPE HTML>
		<html>
		<head>
		<title>Pexel, Profile</title>
		
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='SNS' />
		<meta name='Profile' content='Check metadata of your account' />
		<link rel='stylesheet'  href='../@admin/css/main.css' />
		<link rel='stylesheet'  href='../@admin/css/basics.css' />
		<link rel='icon' href='@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
		
		</head>
		<body>
	    <center>	
	
		<?php  		
		$email =  $_COOKIE['email'] ;
	
		require'head.php';
		require'traffic_saver.php';
		require("db.php");
	     
	    if(isset($_GET["user"]))
		$username = $_GET["user"];
	    else
		$username = $_COOKIE['username'];
	
		$q="select * from users where username='$username'";
		$qry= mysqli_query($conn,$q);
		$arr= mysqli_fetch_array($qry);
		
		
		if(isset($arr['photo']))
		$photo= "traffic/user_profile/".$arr['photo']; 
		else $photo= "../@admin/graphics/default.png";
		
		$p_id = $arr['username'] ;
		$profile_email  = $arr['email'];
		$password = $arr['password'];
		$name = $arr['name'];
		$email = $arr['email'];
		$date = $arr['time'];
		$verify = $arr['verify'];
		
				
		$q="select * from direct_message where sender='$username'";
		$qry_m= mysqli_query($conn,$q);
		$tol_sent = mysqli_num_rows($qry_m);
		
		$q="select * from direct_message where reciever='$username'";
		$qry_m= mysqli_query($conn,$q);
		$tol_recieved = mysqli_num_rows($qry_m);
		
		$tol_m = $tol_sent+$tol_recieved;
		
		$q="select * from search where query='$username'";
		$qry_m= mysqli_query($conn,$q);
		$tol_searchs = mysqli_num_rows($qry_m);
		
		echo"<table  style='text-align:justify; width:100%' cellpadding=20px><tr>";	
		echo"<tr><td>
		<a href='$photo'>
		<img class='avatar' src={$photo}
		style='border:3px solid #55acee'>
		</a> <td colspan=2>";
		echo "<span>".$arr['name'].
		  " </span><br /><b>@$username</b>
		 <br /> Joined ".date("d F,y",$date);
		 
		 if(!isset( $_GET["user"]))
		echo "<br><a href='EditProfile'><input type='button' value='Edit Profile' class=followbox></a>";
	
	echo"</table>";
		    if(isset($_GET["account_updated"]))
			echo "<div><h4 style='color:black'>Account infromation updated</h4></div>";
		
			echo"<hr style='margin:0'>
		<table style='width:100%;text-align:justify;padding:20px'   cellpadding=20px >
		
		<tr><td>
		<h3> $tol_m </h3>Messages
		
		<td>
		<h3> $tol_sent</h3> Sent
		
		<td> <h3> $tol_recieved </h3> Recieved
		
		<tr><td colspan=3>
		<h3> $tol_searchs </h3> Searches";
		
		if($verify !='TRUE')
			echo "<tr><td colspan=3><b><center><h5 style='color:maroon'>This is an unconfirmed account</b>";
		
	     if(isset($_GET["user"]))	
			 die();
		 
		echo "<tr><td colspan=3> <hr style='margin:0px 0px 5px 0'>
		<!--<a href='edit?reset_my_account'>
		Reset home screen</a><br>-->
		
		<h5>
		<a href='edit?change_photo'>
				 Change Photo  </a> |
		<a href='edit?change_password'>
				    Change Password  </a> 
		<a href='edit?delete_permenantly'><br>
				    Delete account permenantly [?] </a>";					
		?>