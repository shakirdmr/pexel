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
		<body>
		<div class="screencontroller" >
		
		<?php	require("db.php");  ?>
	 <table style='width:100%;border-bottom:1px solid #00bfff;text-align:center;
	 padding-left:10px'>
	  <tr>
	  
	  <td colspan=2>
	   <a href=''>Hola Investigator</a>
	  

	  <img src='l.png'
	  style='height:40px'>
	  
	  <tr>
	  <td style='width:50%'>

	  
	    <div class='circle'>
		<br /><br />
			<?php 
		  $qry = mysqli_query($conn," SELECT * FROM traffic");
		  $total_users = mysqli_num_rows($qry);
		  echo $total_users ;
			?>
		<br> Hits
		</div>
		
		<td>
	    <div class='circle'>
		<br /><br />
		 <?php
		 	$qry = mysqli_query($conn," SELECT * FROM users");
			$total_users = mysqli_num_rows($qry);
	
			echo $total_users 
		 ?>
		 <br>Registered
		 <tr><td>
			
		<div class='circle'>
		<br /><br />
		 <?php
		    $t1 = date("Y-m-d ")."00:00:00";
			$time = strtotime($t1);
		 	$qry = mysqli_query($conn,"SELECT * FROM traffic where date >= '$time'");
			$total_users = mysqli_num_rows($qry);
			
			echo $total_users 
		 ?>
		<br> Today Hits 
		</div>

		<td>	
		<div class='circle'>	
		<br /><br />
		 <?php
				$dt = date("Y-m-d ")."00:00:00";
				$date = strtotime($dt);
				$qry = mysqli_query($conn," SELECT * from direct_message 
				where time > '$date'");
		  
				echo $total_messages_today = mysqli_num_rows($qry);
		 ?>
		<br> Today Messages 
		</div>
		
	  </div>
	 <tr><td style='width:50%'>
	 <?php
		  $qry = mysqli_query($conn," SELECT * from direct_message 
		  order by time desc");
		  $total_messages = mysqli_num_rows($qry);
	 ?>
	     	<div class='circle'>
		<br /><br />
		 <?= $total_messages 		 ?>
		<br> Total Messages 
		</div>
		
		<td>
	 <?php 
		 $qry = mysqli_query($conn,"SELECT DISTINCT username FROM traffic where date >'$time' 
		 AND username not like'%.%'");
		 $tol_checked_in = mysqli_num_rows($qry); 
	 ?>
	     	<div class='circle'>
		<br /><br />
		 <?= $tol_checked_in 		 ?>
		<br> Checked In 
		</div>
	 
	 <tr><td>
	<ul><li><hr>
	<a href='checkchannel'> Block channel</a>
	
	<li> <a href='livet'>Live Traffic</a>
	</ul>
	
	<br /><br />
	<hr style='margin:5px'>  
	<center>&copy; Zone 2018
	
		</body>
		</html>

		