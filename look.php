	<!DOCTYPE HTML>
	<html>
	<head>
	<title>Who searched me</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="@admin/css/main.css" />
	<link rel="stylesheet"  href="@admin/css/basics.css" />
	<link rel="icon" href="@admin/graphics/favicon.png" type="image/png" sizes="16x16">
	</head>
	
	<body>
		<center>
		
		<?php
		if(!isset($_COOKIE['username']))
		require("../");
	    //ELSE
		
		require("head.php");
		require('traffic_saver.php');
		require("db.php"); 
		echo "<h3>Following searched you<br><br>";
		
		$username = $_COOKIE["username"];		
		
		// Users own info
		$q="select * from users where username='$username'";
		$qry= mysqli_query($conn,$q);
		$arr= mysqli_fetch_array($qry);
		
		$name = $arr['name'];
		$email = $arr['email'];
		// Users own info
		
		// Looking in DB for user
		$q = "select * from search where query='$name' OR query='$email' 
		OR query='$username'  order by time desc";
		$qry= mysqli_query($conn,$q);
		$total_searchers = mysqli_num_rows($qry);
		// Looking in DB for user
		
		// Searchers info..
		for($i= 0 ; $i<$total_searchers; $i++)
		{
			$arr= mysqli_fetch_array($qry);	
			$username = $arr['searcher'];
			$search_date =date("h:m m/d",$arr['time']);
			
				 $q_searcher = "select * from users where username='$username' ";
				 $qry_searcher = mysqli_query($conn,$q_searcher);   
				 $arr_searcher = mysqli_fetch_array($qry_searcher);	
			      
				 if(isset($arr_searcher["photo"]))
				 $photo = "../traffic/user_profile/".$arr_searcher["photo"];
				 else $photo = "../@admin/graphics/default.png";
				 
			     $email_searcher =  $arr_searcher["email"];
				 $joined = date("D,m,Y h:m",$arr_searcher["time"]);
			     
			 echo "
		     <table style='width:100%;text-align:justify'> 
			 <tr><td style='width:30%'>
			 
			 <div class=avatar style='width:80px'>
			 <img src={$photo}	 width=80px></div>
			
			<td style='width:80%'>
			<table  style='width:100%'> 
			<tr><td> <b style='color:black'>
			username<h5>$username</h5> 
			
			<td> <b style='color:black'>
			searched <h5>$search_date</h5></b> 
		";
			echo"</table> </table> 
			<hr style='margin:0'>";
		}
		// Searchers info..
		
		?>
		
		</body>
		</html>