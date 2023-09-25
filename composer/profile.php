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
		else $photo= "@admin/graphics/default.png";
		
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
		echo "<span>".$arr['name']." </span><br />@$username";	
		echo "	<br /> Joined ".date("d F,y",$date)."</table><hr style='margin:0'>";
		
		
				echo "<tr><td colspan=3> 
				<center  style='padding:5px'>email <b>";
				if(!isset($_GET['user']))
				echo"$email";
				else echo "Hidden";
				
				
		echo"<table style='width:100%;text-align:justify'   cellpadding=20px>
		
		<tr><td>
		<h3> $tol_m </h3>Messages
		
		<td>
		<h3> $tol_sent</h3> Sent
		
		<td> <h3> $tol_recieved </h3> Recieved
		
		<tr><td colspan=3>
		<h3> $tol_searchs </h3> Searches";
		
		if($verify !='TRUE')
			echo "<tr><td colspan=3><b><center>This is an unconfirmed account</b>";
		
	     if(isset($_GET["user"]))	
			 die();
		 
		echo "<tr><td colspan=3> <hr style='margin:0px 0px 5px 0'>
		<!--<a href='edit?reset_my_account'>
		Reset home screen</a><br>-->
					
		<a href='edit?change_photo'>
				    <h3>Change Photo  </a>
		<a href='edit?change_password'><br>
				    Change Password  </a>
		<a href='edit?delete_permenantly'><br>
				    Delete account permenantly [?] </a>";					
		?>