<?php 
  if(!isset($_COOKIE['username']) OR !isset($_COOKIE['email']))
	  header('location:../index?login');
  // ELSE 
  
  session_start();	  
  if(!isset($_SESSION["options_for_channel"]) )
	 header('location:../home');
  else $channel = $_SESSION["options_for_channel"];
  $username = $_COOKIE["username"];
  
  ?>

		<!DOCTYPE HTML>
		<html>
		<head>
		<title>Edit Chat Pexel</title>
		
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='SNS' />
		<meta name='chatOptions' content='Edit chat' />
		<link rel='stylesheet'  href='../@admin/css/main.css' />
		<link rel='stylesheet'  href='../@admin/css/basics.css' />
		<link rel='icon' href='../@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
		</head>
		
		<body>
		
	    <center>
	<?php 
				     require("../db.php");
					 
					 if(isset($_POST["clear_all"]))
					 {
					 $q = "update direct_message set sender='unknown'
					 where channel='$channel'
					 AND sender='$username'";
					 mysqli_query($conn,$q);
					 
					 $q  ="update direct_message set reciever='unknown'
					 where channel='$channel'
					 AND reciever='$username'";
					 
					   if(! (mysqli_query($conn,$q))	)
						   echo "<b>".mysqli_error($conn);
					   else header("location:../home");
					   die("<b><br />Header Error");
					   
					 }
			require("../head.php");		 
					 echo "<p style='text-align:justify;padding:20px'> <br />
					 <a href='chatOptions?channel=$channel'>
					 <img src='../@admin/graphics/back.png' width=20px> 
					  Go back to options 
					 </a><br><br>
					 
					 <b>
					 Note* all the chat you did, including all the media and text will be permenantly deleted and can never be recovered.
					 
					 <br /><br>Press Clear button to continue 
					 <br /> 
					 <form action='' method='POST'>
					 
					 <input type='submit' value='Clear' class=followbox name=clear_all>
					 
					 </form> ";
					 die();

?>			
			