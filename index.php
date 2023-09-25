	<?php session_start();   
	      if(isset($_COOKIE["username"]))
		  header("location: home");
	  
	require("traffic_saver.php");
	?>
	
	<html>
	<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8320107983667363",
    enable_page_level_ads: true
  });
</script>
	<title>Pexel, login or signup</title>
	
		<meta name="viewport" content="width=device-width,initial-scale=1.0"
		charset="utf-8"	name="owner" content="Direct" />
		<meta name="Pexel" content="Log In or Register" />
		<meta name="language" content="English">
		
		<link rel="stylesheet"  href="@admin/css/main.css" />
		<link rel="icon" href="@admin/graphics/favicon.png" type="image/png" sizes="16x16">
	<style>
	.box{
		border-radius:100px;
		outline:none;
	}
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
	</head>
	
	<body> 
	      <header id="header"> <div class="screencontroller">
	<table style='padding:10px 0 0 20px;width:100%'>
	<tr>
	   <td>
	   <img src='../@admin/graphics/plogo.png' width=50px><td>
	 <span style="font-size:30px;cursor:pointer;color:black">
	  Pexel<td><h5>feedback messenger<td style='width:80%'>
     </table></header>
	
	
	    <center>	
	<div class="screencontroller">
			
			<table style="width:100%;text-align:center">  
				
					<div style='margin:20px'/></div>
					</td> </tr> 
					
				<form action='check' method='POST'>
                <tr><td>
				
				<input type="text"  maxlength="50" 
				style='width:90%' autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
				id='email'  
				placeholder="@username, email" name="email"  class="box"
							<?php  if(isset(
							$_SESSION["login_username"] ))
							echo "value=".$_SESSION["login_username"]; 
							?> >      
				</td></tr>
                
				<tr>	<td><br>
				<input type="password" class="box" 
				maxlength="50" style='width:90%'
				placeholder="password, pin" name="password">				    
				</td></tr>
				<?php   if(isset( $_SESSION["invalidlogin"])){
				echo"	<tr><td><h4 style='color:black'>".$_SESSION["invalidlogin"];  
			       }		
			      ?>
				  
				  
				<tr>
				<td><br><input type="submit" class="box"
				style='background:#00bfff;color:white; 	
				font-weight:bold; width:90%'
				name="create_my_account" value="Log in"> 
				
				</form>
				</td>   <tr><td> 
			<a href='forgot-password/index' style='float:right;padding-right:20px'>
			<h5>forgot password</h5> </a> </tr> 
				
				<tr><td >
				     
					<a href='new-user/index'></br>
					     <input type="button" class="box"
						style='background:#55acee;color:white; 	
						font-weight:bold; width:50%;border-radius:100px'
						name="create_my_account" value="Create a new account">
					</a>
						
				<tr> <td><center><div style='background:#fafafa;height:200px'>
				<hr style='margin:100px 0 10px 0'>
				
					<table >
					<tr> 					<td>
					<a href='about?aboutus'>
					About us .  </a>
					<td><a href='about?contact'>Write us . </a>
					<td><a href='about?faq'>FAQ</a>
					
					<tr> 	<td><h5 style='color:black'> Pexel &copy  2017
					 <td colspan=2> <h5 style='color:black'>feedback messenger
					</table>
					</table>
					
					<?php session_destroy(); ?> 
				    </body>
 					</html>
		