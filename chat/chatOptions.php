<?php 
  if(!isset($_COOKIE['username']) OR !isset($_COOKIE['email']))
	  header('location:../index?login');
  // ELSE 
  ?>

		<!DOCTYPE HTML>
		<html>
		<head>
		<title>Edit Chat Pexel</title>
		
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='Arly' />
		<meta name='chatOptions' content='Edit Chat' />
		<link rel='stylesheet'  href='../@admin/css/main.css' />
		<link rel='stylesheet'  href='../@admin/css/basics.css' />
		<link rel='icon' href='../@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
		 <style>
		 .icon{width:30px}
		 <style>
		</head>
		
		<body>
		
	    <center>
	<?php 
	if(!isset( $_GET['channel'] ))
	header('location:../index');
	
	//Else 
	session_start();	
	$_SESSION["options_for_channel"] = $_GET['channel'] ;
	require("../head.php");


				 
			echo "<table style='width:100%;padding-left:10px'
				   cellspacing=20px>
				  <tr><td><hr>
					 <a href='../direct?direct={$_SESSION["options_for_channel"]}'>
					 <img src='../@admin/graphics/back.png' width=20px align=top> 
					 Go back to chat 
					 </a><hr>
					 
				  <tr><td>
				  <img src='../@admin/graphics/delete-chat.png' class=icon>
				  <a href='clear'> Delete all chat .</a>
				  
				  <tr><td>
				  <img src='../@admin/graphics/block-chat.png' class=icon>
				  <a href='block'> Block this contact.</a>
				  
				  <tr><td>
				  <img src='../@admin/graphics/clear-chat.png' class=icon>
				  <a href='delete'> Delete this contact [?]</a>
				  
				  </table> ";
?>			