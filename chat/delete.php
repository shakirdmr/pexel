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
					 
					 if(isset($_POST["delete"]))
					 {
					 
					 $q = "update channels set owner='unknown'
					 where name='$channel'
					 AND owner='$username'";
					 mysqli_query($conn,$q);
					 
					 $q  ="update channels set reciever='unknown'
					 where name='$channel'
					 AND reciever='$username'";
					 mysqli_query($conn,$q);
					 
					  //Block
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
					 
					 <b>You chose to delete everything with this person.
					 Chat and media will be deleted too.
					 <br />And the contact will be removed permentatly from home.
					 
					 <br><br>
					 Press Delete button to delete all
					 <form action='' method='POST'>
					 <input type='submit' value='Delete' class=followbox name='delete'>
					 </form> ";
					 die();	

?>			
		