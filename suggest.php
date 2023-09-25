	<!DOCTYPE HTML>
	<html>
	<head>
	<title>Suggest Pexel</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="@admin/css/main.css" />
	<link rel="stylesheet"  href="@admin/css/basics.css" />
	<link rel="icon" href="@admin/graphics/favicon.png" type="image/png" sizes="16x16">
	</head>
		
	<body bgcolor=#fbfbfb>
	
		<center>
		
		<?php
		if(!isset($_COOKIE['username']))
		header("location:../");
	    //ELSE
			
		require("traffic_saver.php");
		require("head.php");
		require("db.php"); 
		require("checkQuery.php");
		
		$username = $_COOKIE["username"];
		
			echo "<h4 style='margin-bottom:5px'> Suggestions </b></h4>";
			
			$q = "select * from users where
			username not LIKE '$username' order by time,photo asc";
			
			$query = mysqli_query($conn,$q);
			 
			 $tol = mysqli_num_rows($query);
			 if($tol ==0)
			 {
  			    echo "<br /><img src='@admin/graphics/picabot.png'
			     class='avatar'><br />
			    <b>Nothing found, try again for this time</b> <br /><br /><br />";
		         die();
			}
		    else {
			
		for($i=0; $i<$tol; $i++)
		{
			
		$arr = mysqli_fetch_array($query);
		$name = $arr["name"];	
		$eml=  $arr['email'];
		$found_id =  $arr['username'];
		$joined =  date("D M, Y",$arr['time']);
		
		if(isset($arr['photo']))
		$photo= "traffic/user_profile/".$arr['photo']; 
		else $photo= "@admin/graphics/default.png";
	
		echo"
		<a href='profile?user=$found_id' class='profile'>
		
		<table style='width:100%;height:60px;text-align:justify;border-bottom:1px solid #EEF0F1;padding-left:10px' > 
		<tr><td style='width:20%'>";	
		echo"
		<img src={$photo}	style='height:60px;width:60px' class=avatar ></a> ";
		
		echo "<td style='width:20%'><b>$name<td style='width:40%'>	";
		
		$q = "select * from channels where owner='$username' AND reciever ='$found_id'";
			$qr_new = mysqli_query($conn,$q);
			$any_new = mysqli_num_rows($qr_new);
		  
		echo"<td style='width:10%'>";
			if($any_new != 0)
			echo"				
			<a href='launchNewChannel?direct=$found_id'>
			<input type='button' class='followbox' style='float:right;height:60%;width:60px;
			margin-right:20px;'
			value='New'/></a>";
		
		echo"<td style='width:10%'>
			<a href='launchChannel?direct=$found_id'>
			<input type='button' class='followbox' style='height:60%;width:60px;
			margin-right:20px;background:#55acee'
			value='Chat'/></a></div></table>";
			}
			}
			
			?>