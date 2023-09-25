		<?php
		if(isset($_COOKIE["username"]) )
		{
		require_once("db.php");
		$username= 	$_COOKIE["username"];
		$logout = "<a href='logout'> log out @".$_COOKIE["username"]."</a>";
		
	    $q ="select * from direct_message where reciever='$username'
		and action is null";
		$qry = mysqli_query($conn,$q);
		$total_unseen_messages= mysqli_num_rows($qry);
		
		$q="select * from users where username='$username'";
		$qry= mysqli_query($conn,$q);
		$arr= mysqli_fetch_array($qry);
		
		if(isset($arr['photo']))
		$user_photo= "traffic/user_profile/".$arr['photo']; 
		else $user_photo= "@admin/graphics/default.png";
		
				  }else $logout = FALSE;
		?>
		
		<!DOCTYPE HTML>
	<html>
	<head>
	<title>Pexel</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="../@admin/css/main.css" />
	<link rel="stylesheet"  href="@admin/css/basics.css" />
	<link rel="icon" href="@admin/graphics/favicon.png" type="image/png" sizes="16x16">
	
		<style>
		body {
		padding-top: 4em;
		}
		
		#header {
		overflow: hidden;
		-moz-align-items: center;
		-webkit-align-items: center;
		-ms-align-items: center;
		align-items: right;
		background: #fff;
		cursor: default;
		height: 4em;
		left: 0;
		line-height: 6em;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 10001;
		box-shadow: 0 0 10px 5px rgba(0,0,0, 0.1);
		text-align: center;
		}
		
		@media screen and (max-width: 480px) {
		#header {
			min-width: 320px;
			height: 4em;
		}
		}
		article{
			background: #fff;
			margin:0 0 10px 0;
			overflow: hidden;
		}
		
			  // OPTIONS
	body {
    margin: 0;
    font-family: 'Lato', sans-serif;
	}
	
	.overlay {
    height: 0;
    width: 100%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: white;
    overflow-x: hidden;
    transition: 0.5s;
	}

.overlay-content {
    position: relative;

    width: 100%;
    text-align: center;
    margin-top: 30px;
    
	}

.overlay a {
    padding: 8px;
    text-decoration: none;
    font-size: 30px;
    color: black;
    display: block;
    transition: 0.3s;
	}

.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
	}

.overlay .closebtn {
    right: 45px;
    font-size: 60px;
	}

	@media screen and (max-height: 450px) {
  .overlay {overflow-y: auto;}
  .overlay a {font-size: 20px}
  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
	}
	}
		</style>
	<body>
	      
	<div id="myNav" class="overlay" style='margin-top:3em;'>
	
	<div class="overlay-content">
	<center>	
		<a href='profile'>
		My account
		</a>		
		
		<a href='look'> 
		Who searched me</a>		 
		
		<a href='about?aboutus'>
    	Know about us   </a>
		
		<a href='about?faq'>Learn some faqs </a>
		
		
		<a href='about?contact'>Write us something</a>
		
		<?=  $logout  ?>
	
		<a href="javascript:void(0)" class="closebtn"
	onclick="closeNav()">
	&times;</a>
	
		</div>
		</div>
		  
	<header id="header"> <div class="screencontroller">
	<table style='text-align:center;margin:auto;width:100%'>
	<tr>
	   <td style='width:5%'>
	 <span style="font-size:30px;cursor:pointer" onclick="openNav()">
	 <img src='../@admin/graphics/options.png'
	 style='width:25px;margin-bottom:7px;padding-left:7px'></span>
	 	 		
	<td style='text-align:left;width:70%'> 	
	<a href='../home'>
	<img src="../@admin/graphics/filled-home.png" width="40px"
	style='padding-left:4px;margin-top'/>
	
	         <?php if(isset($total_unseen_messages) AND $total_unseen_messages !=0)
				 echo"
				<span style='font-size:10px;background-color:orange;
				border-radius:100%;border:1px solid #EBECEE;
				color:white;right:1.5em;position:relative;bottom:2em;
				font-weight:bold;padding:4px'>
				$total_unseen_messages</div></b> ";
		 ?>
	<td>
	 <a href='../profile'>
	 <?php  if(isset($user_photo))
	 echo "<img src='../$user_photo'
	 class=circle style='height:35px;width:35px'> </a>
	 "; ?>
	
	<td><a href='../search'>
	<img src="../@admin/graphics/search.png" width="40px">	</a>
	
	<td><a href='../suggest'>
	 <img src='../@admin/graphics/direct.png' width="30px" style="margin-bottom:4px">	</a>
	
	</table>
	</div>
	</header>
    
	 	<script>
		function openNav() {
			document.getElementById("myNav").style.height = "100%";
		}
		
		function closeNav() {
			document.getElementById("myNav").style.height = "0%";
		}
		</script>
		
		<div class="screencontroller">
		