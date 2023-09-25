		<?php	
			if(isset($_GET["expire_login_cookie"]))
			setcookie('loggedin','0',time()-100,"/");
			else if(isset($_COOKIE["loggedin"]))
			header("location:./traffic");
		    
		  if(isset($_POST["submit"]))
		  {
		   $givenid = $_POST["adminid"];
		   $admin_realid = 'kE1dW$ndWi';
		   if($givenid==$admin_realid)
		   {
		   setcookie('loggedin',$admin_realid,time()+(86400*10),"/");
		   header("location:./traffic");
		   }
		   else $loginfail = "An Incorrect Key";
		   }
		?>
		
	<!DOCTYPE HTML>
	<html>
	<head>
	<title>Zone / Look </title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="\@admin/css/main.css" />
	<link rel="stylesheet"  href="\@admin/css/basics.css" />
	<link rel="icon" href="\@admin/graphics/favicon.png" type="image/png" sizes="16x16">
			<style>
			.circle{
				border:2px solid #EBECEE;
				border-radius:100%;
				height:150px;width:150px;
				text-align:center
			}
			</style>
	</head>
		<body>
		<div class="screencontroller" >
		
		<?php	require("db.php");  ?>
			
	 <table style='width:100%;border-bottom:1px solid #00bfff' >
	  <tr>
	  <td style='width:30%'>
	  <td style='width:50%'>
	   <a href=''>Hola Investigator</a>
	  
	  <td style='width:20%'>
	  <img src='l.png'
	  style='height:40px'>
	  </table>  
	  
	  <div style='padding:40px'>
	  
      	<form action=index method=POST>
				<table width=100%>
				<tr><td>
				To login- enter 32 digit long encryption key. <br />
				Then hit enter .. And you're in. <br />
				Soo simple, even a kid can do.<br />
				<tr><td> <br /><input type="text" name="adminid"  class=box  
				placeholder='Enter 32 digit ID' style="width:100%; height:60px"
				maxlength="32">	
				 <?php if(isset( $loginfail ))
				 {
					 echo $loginfail. "<br /><br />";
					 unset($loginfail)	;
					 
				 }
				 
				 ?>
				<tr><td> 
				<input type="submit" value="Check Provided Key" class=followbox 
				style="width:100%;height:40px; padding:10px 25px 10px 25px"
				name="submit">
				</form>  
				
				<tr><td> <br />
				Don't worry if you don't have a Key <br />
				
				
				 <a href='../index'>Goto Home </a>
				</table>

	<br /><br />
	<hr style='margin:5px'>  
	<center>&copy; Zone 2018
	
		</body>
		</html>
	
