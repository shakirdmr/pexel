	<?php session_start(); ?>
		<html>
		<head>
		<title>Password Reset</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet"  href="../@admin/css/main.css" />
		<link rel="stylesheet"  href="../@admin/css/basics.css" />
		<link rel="icon" href="../@admin/graphics/favicon.png" type="image/png" sizes="16x16">
			
		</head>
		<body> 
        
  <?php
   
   require("../db.php");
   require("head.html");
   
		   if(!isset($_GET["email"]))
			die("username not present in URL box ");
		
		   $username = $_GET["email"];
		   
		   $q= "select * from users where username='$username' OR email='$username'";
		   $qry = mysqli_query($conn,$q);
		   $user_arr = mysqli_fetch_array($qry);
			
		   if(isset($user_arr['photo']))
		   $photo= "../traffic/user_profile/".$user_arr['photo'];
		   else $photo= "../@admin/graphics/default.png";
		   
		   
		   $email =  $user_arr['email'] ;
		      
		   $name =  $user_arr['name'] ;
		   $username_db =  $user_arr['username'] ;
		   
		   echo"<table  style='text-align:justify; width:100%' cellpadding=20px >
		   <tr>";	
		   echo"<tr><td>
		   <img class='avatar' src=$photo width=100px
		   alt='$photo'>
		   
		   <b>@$username_db </b><br>";
		   
		   echo "<tr><td> we have sent mail to <b> $email </b>.
		   Enter code that you see in mail or click link in mail
		   to continue.";
		   
		    echo " 
				<form action='check_given_code' method='POST'>
                <tr><td>
				Confirmation code<br><br>
				<input type='tel'  style='width:70%;height:50px'
				placeholder='XXXXXX' name='code'  class='box' 
				maxlength=6>
				 
				 <input type='hidden' name='entering_code' value=1>
				 <input type='hidden' name='username' value='$username_db'>	
				 
				 <tr><td>
				 <input type='submit' class='box' value='Confirm'
				 style='width:70%;background-color:#55acee;color:white; border:0px;
				 font-weight:bold;padding:0 20px 0 20px'		name='next'>	
				";
				
			
				if(isset($_SESSION["error_confirming_code"]))
				echo "<br><br><div style='background:red; color:white'>"
		        .$_SESSION["error_confirming_code"]."</div>";;
				
			echo "<tr><td><a href='send_again?username=$username'> 
			Didn't recieved code ? <br>
			We can send again.Click below<br>  
			<b>Send Again </b></a>";	
			
			session_destroy();
			
			?>