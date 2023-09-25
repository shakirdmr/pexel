<?php 

  if(!isset($_COOKIE['username']) OR !isset($_COOKIE['email']))
	  header('location: index?login');
  // ELSE 
  ?>

		<!DOCTYPE HTML>
		<html>
		<head>
		<title>Pexel, the secret feedback</title>
				
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='SNS' />
		<meta name='Start' content='Start, Log In or Register' />
		<link rel='stylesheet'  href='@admin/css/main.css' />
		<link rel='stylesheet'  href='@admin/css/basics.css' />
		<link rel='icon' href='@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
			<style>
			.messengersTable:hover{
				background:#f9f9f9;
			}
			.channel_link{
					color: #5B6167;
			}
			.channel_link:hover{
					text-decoration:none;
			}
			
			</style>
		</head>
		<body>
		
	    <center>
	<?php 
	$username = $_COOKIE['username'];
	$email =  $_COOKIE['email'] ;
	
			require('db.php');
			require('checkQuery.php');
			require('head.php');
			require("composer/home_view.php");
			require("traffic_saver.php");
?>			
			