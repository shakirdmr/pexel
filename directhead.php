		<?php
		if(isset($_COOKIE["username"]) )
		{
		require("db.php");
		$username= 	$_COOKIE["username"];
		$logout = "<a href='logout'> log Out ".$_COOKIE["username"]."</a>";
		
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
		height: 3em;
		left: 0;
		line-height: 0;
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
		</style>
	<body>
	
	<header id="header"> <div class="screencontroller">
	<table style='text-align:center;margin-top:10px;width:100%' >
	<tr>
		 		
	<td style='width:20%'> 	
	<a href='../home'>
	<img src="../@admin/graphics/filled-home.png" width="40px"
	style='padding-left:10px'/>
	
	         <?php if(isset($total_unseen_messages) AND $total_unseen_messages !=0)
				 echo"
				<span style='font-size:10px;background-color:orange;
				border-radius:100%;border:1px solid #EBECEE;
				color:white;right:1.5em;position:relative;bottom:2em;
				font-weight:bold;padding:4px'>
				$total_unseen_messages</span></b> ";
		 ?>
	<td style='width:70%;text-align:justify;padding-left:20px'> 	
	<h5><?= $reciever_name ?></h5>
	<?= $last_seen  ?></h5>
	<td>
	<img src="../@admin/graphics/refresh.png" width="30px"
	onclick='location.reload();'>	</a>
	
	<td><a href='../chat/chatOptions?channel=<?php if(isset($channel)) echo $channel; ?>'>
	 <img src='../@admin/graphics/setting.png' width="40px">	</a>
	
	</table>
	</div>
	</header>

		<div class="screencontroller">
		