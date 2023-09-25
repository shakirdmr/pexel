	<?php session_start(); 
	require("../traffic_saver.php");
	require("head.php");
	?>
	<html>
	<head>
	<title>Register, start a journey</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="../@admin/css/main.css" />
	<link rel="icon" href="../@admin/graphics/favicon.png" type="image/png" sizes="16x16">
			<style>
			.eml{ 
			    width:90%;height:50px;
				border:2px solid #00bfff;
				padding:10px;
				border-radius:100px;
				outline:none;}
				
			.eml:focus
			{
					border:2px solid purple;
			}
			</style>
	</head>
	
	<body> 
	
	<div class="screencontroller">
	<center>  <br><br><br>
	
				<table style='width:100%;padding-left: 20px' cellspacing=10 >
					
					
					<tr><td>
					<b>It all startes with you Email,<br>
					 Enter email to start everything</b>
					<div style='margin:40px'/></div>
					</td> </tr> 
					
				<form action='1' method='POST'>
                <tr><td>
				<input type="email"  maxlength="50" 
				placeholder="Enter email address.." name="email"  class="eml">
				
				<tr><td>
				<input type="submit" class="box"
				style='background-color:#55acee;color:white; border:0px;
				border-radius:100px;
				 font-weight:bold;padding:0 20px 0 20px'
				 
				name="create_my_account" value="Sign Up"> 
				<br>				
				<?php
				if(isset($_SESSION["failed_email"]))
					echo  "<br /> <b style='color:black'>".$_SESSION["failed_email"];
				session_destroy();
				?>
				 
				  					
					 
					 </table>
				</body>
				</html>
		