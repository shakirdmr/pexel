<?php			
			if(!isset($_COOKIE["loggedin"]))
			header("location:index");
		?>
		
	<!DOCTYPE HTML>
	<html>
	<head>
	<title>Pexel -Dashboard</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="arly" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="\@admin/css/main.css" />
	<link rel="stylesheet"  href="\@admin/css/basics.css" />
	<link rel="icon" href="\@admin/graphics/favicon.png" type="image/png" sizes="16x16">
			<style>
			.circle{
				border:2px solid #EBECEE;
				border-radius:100%;
				height:150px;width:150px;
				text-align:center;
				color:black;
				font-weight:bold;
			}
			</style>
	</head>
		<body><center>
		<div class="screencontroller" >
		
		<?php	require("db.php");  ?>
	 <table style='width:100%;border-bottom:1px solid #00bfff;text-align:center;
	 padding-left:10px'>
	  <tr>
	  
	  <td colspan=2>
	   <a href='traffic'>Hola Investigator</a>
	  

	  <img src='l.png'
	  style='height:40px'>
	  </table>
	  <?php
		  	date_default_timezone_set("asia/kolkata");
		  
			$t1 = date("Y-m-d ")."00:00:00";
			$time = strtotime($t1);
			
			$qry = mysqli_query($conn," SELECT * FROM traffic where date > '$time'
			order by date desc LIMIT 100");	
			$tol = mysqli_num_rows($qry);
			
			echo "<table style='text-align:justify;color:black'>";
			for($i=0; $i<$tol; $i++)
			{
				$arr = mysqli_fetch_array($qry);
				$ip  = $arr["ip"];
				$date  = date("h:i:sa", $arr["date"]);
				$user  = $arr["username"];
				$page  = $arr["page"];
				
				echo "<tr><td>
				[$date] <td>[$user] <td>[$page]<tr><td colspan=3>  <hr style='margin:5px'>";
			}
		   