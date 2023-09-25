	    <?php session_start(); ?>
		<html>
		<head>
		<title>Password Reset</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	
		<link rel="stylesheet"  href="../@admin/css/main.css" />
		<link rel="icon" href="../@admin/graphics/favicon.png" type="image/png" sizes="16x16">
		</head>
		
		<body> 
	   
  <?php
			
			require("../db.php");	
			require("head.html");
			
			if(!isset($_SESSION["change_password"]) )
				header("location:index");
			
		   $username = $_SESSION["change_password"];
		   $code = $_SESSION["code"];
  
		   	 if(isset($_POST["update_password"]))
				 {
					 $new = $_POST["new_password"];
					 $confirm_new = $_POST["confirm_new_password"];
					 			    		 
				if(empty($confirm_new) or empty($new))
				$err = "<b class='warn'>Provide a password, it's necessary</b>";
			    
				else if($new != $confirm_new)
				$err = "<b class='warn'>Passwords don't match, make them same</b>";	
			
				else if(strlen($new)<4 ) 
				$err = "<b class='warn'>Password should be atleast greater than four digits</b>";
			    
			  else {
			  $new = password_hash( $new,PASSWORD_DEFAULT);
			  mysqli_query($conn,"update users set password='$new' where username='$username'");
			  
			  mysqli_query($conn,"delete from password_reset where user='$username'
			  AND code='$code'");
			  
			  $q= mysqli_query($conn,"select * from users where username='$username'");
			  $ar = mysqli_fetch_array($q);
			  $unm = $ar["username"];
			  $eml = $ar["email"];
			  
			  setcookie('username',$unm,time()+(8640*365),"/");  
			  setcookie('email',$eml,time()+(8640*365),"/");  
			  header('location:../home'); 
			       }
				 }
				 
   
			echo "<b><center> We got it all right for you, <br>
			It's time, type a new password </center></b><br>"; 	 
			
			echo "
			<form action='change_password' method='POST' enctype='multipart/form-data'>
			 <table style='width:100%;padding-left:20px'>
			 
			<tr><td>New
			<tr><td>
			<input type='password' name='new_password' style='width:90%;height:50px'
			class='box' placeholder='Enter a good one this time'> 
			<input type='hidden' value='update_password'>
			<tr><td>	<br>Confirm
			<tr><td>
			<input type='password' name='confirm_new_password'
			style='width:90%;height:50px'
			class='box' placeholder='Enter same as above'>";
			     
						if(isset( $err))
					    echo "<center><br>$err</cennter><br><br>"; 
			
			echo"
			<tr><td>
			<input type='submit' class='box'
			name='update_password' value='Change password'
			style='width:90%;height:50px;
			font-weight:bold; background:white'> 
			
			</form></table>";
			
			die();	
			
			?>
			
			</body>
			</html>