<?php 
  if(!isset($_COOKIE['username']) OR !isset($_COOKIE['email']))
	  header("location:../index?login");
  // ELSE 
  
  session_start();	  
  if(!isset($_SESSION["options_for_channel"]) )
	 header("location:../home");
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
					 
					 if(isset($_POST["block"]))
					 {
					 
					 $q  ="update channels set block=1
					 where name='$channel' AND block=0
					 AND (owner='$username' OR reciever='$username')";
					 
					   if(mysqli_query($conn,$q))
					     header("location:../home");  
					   else
					     echo "<b>".mysqli_error($conn);
					     die("<b> Header Error </b>");
					   
					 }
						     require("../head.php");			 
					 echo "<p style='text-align:justify;padding:20px'> <br />
					 <a href='chatOptions?channel=$channel'>
					 
					 <img src='../@admin/graphics/back.png' width=20px> 
					  see options again
					 </a><br><br>
					 
					 <b>You are choosing to Block everything with this contact.
					 You will not be able to chat on this contact again
					 but all data will be kept, you can get it anytime. 
					 
					 <br><br>
					 To continue Press Block button to delete all
					 <form action='' method='POST'>
					 <input type='submit' value='Block' class=followbox name='block'>
					 </form> ";
					 die();	

?>			
		