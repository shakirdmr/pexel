	<!DOCTYPE HTML>
	<html>
	<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="@admin/css/basics.css" />		
	<title>Direct</title>
	</head>
	<body>
<?php
					if(!isset($_COOKIE['username']) )
					header("location:index.php");	
				
					require("head.php");
					require("db.php");
					$username = $_COOKIE["username"];
					
					$date = time();
			if($_SERVER["QUERY_STRING"] == "delete_permenantly")	
			{	
		     $f  = fopen("composer/delete_permenantly.txt","a+");
			 fwrite($f,"$username on ".date("Y-m-d H:i:sa"));
			           echo "<p style='font-weight:bold;text-align:justify;
					   margin:20px 20px 0 20px'> 
					    Dear user,  <br />
						we have requested to delete your account permenantly.
						It will be done very soon. Your all chats will be deleted and you will be able to chat again by creating a new account.</p>";
			 
			}
			else if($_SERVER["QUERY_STRING"] == "change_password")	
			{
				 if(isset($_POST["update_password"]))
				 {
					 $old = $_POST["old_password"];
					 $new = $_POST["new_password"];
					 $confirm_new = $_POST["confirm_new_password"];
					 
				if(empty($new) OR empty($confirm_new) or empty($old))
				echo  "<b class='warn'>Provide a password </b>";
				else if(strlen($new)<4 ) 
				echo "<b class='warn'>Make password length greater than 4 digits</b>";
			    else {
					   $ret = change_password($old,$new,$confirm_new);
					  if($ret== 1) 
					  echo "Invalide old pass,
						    try again and give correct	";  
					  else if($ret== 2) 
					  echo "New passwords not matching";  		  
					  else if($ret == 3)
					  echo "Passsword Changed Successfully..";
				     }
				 }
				echo "
			<form action='edit?change_password' method='POST' enctype='multipart/form-data'>
			<br><br>
			 <table style='width:100%;padding-left:20px'>
			 
			<tr><td>
			<input type='password' name='old_password'
			style='width:90%;height:50px'
			class='box' placeholder='present password'>
			<br><br>
			
			<tr><td>
			<input type='password' name='new_password'
			style='width:90%;height:50px'
			class='box' placeholder='new password'> 
			
			<tr><td>
			<input type='password' name='confirm_new_password'
			style='width:90%;height:50px'
			class='box' placeholder='type new password again'>
			
			<tr><td>
			<input type='submit' class='box'
			class='create' 	name='update_password' value='Change'
			style='height:50px;
			font-weight:bold; background:white'> 
			
			</form>";
			
			die();	
			}				
			else if($_SERVER["QUERY_STRING"] == "change_photo")	
			{?>
		
		    <br /><br >
			<table style='width:100%;padding-left:20px'><tr><td>
			
			<form action='edit' method='POST' enctype='multipart/form-data'>
			
			<input type='hidden' name='	MAX_FILE_SIZE' value='2097152'>
			
			<span><b>New photo, </span> to help people find you
			<br>			<br>			
			<tr><td>
			<div style='width:300px;height:300px;border-radius:100%' class=avatar>
			<center>
			<img id='blah' style='width:300px'>			 </div>
			
			<tr><td>
			<input type="file"   name="photo" accept="image/*"			onchange="document.getElementById('blah').src =window.URL.createObjectURL(this.files[0])"> 
			<br><br>
			<tr><td>
			<input type='submit' value='Upload'  name='upload'>			</form> </table>
			<?php die();}
			
					if(isset($_FILES['photo']))
					{
					function nameimage($n)		
					{
					$n = trim($n);
					$n= @crypt($n);
					$n= preg_replace('/\./','',"$n"); 	
					$n= preg_replace('/\$/','',"$n"); 	
					$n= preg_replace('/\//','',"$n"); 	
					$n= preg_replace('/[a-mN-Z5-9]/','',"$n"); 	
					$n= $n."_profile";
				
					if($_FILES['photo']['type'] == "image/jpeg")
					$n =$n.".jpg";
					else if($_FILES['photo']['type'] == "image/png")
					$n =$n.".png";
					else $n = 0;
					return $n;
					}
					
				$np = nameimage( $_FILES['photo']['name'] ); 
				if($np == 0)
				header("location:profile.php");
				$path = "traffic/user_profile/$np";			 
				
				if (move_uploaded_file($_FILES['photo']['tmp_name'],$path)  ) 
				{
					
					$q="UPDATE users SET photo='$np' where username='$username'";
					mysqli_query($conn,$q); 
					header("location:profile");
					die();
				}
				else
				echo $_FILES["photo"]["error"]."<hr />";
				}
				else  if(isset($_GET["reset_my_account"]))
				{
					echo"<div style='margin:40px 20px 10px 20px'>
					<h4>You account will be taken to the fresh form in home view. 
					All files and messages will be cleared and you will feel a new account.
					Except some data will be kept.
							<br /><br /><form action='?reset_my_account_part2' method='post'>
							
						<input type='submit' value='Reset home screen' name='reset'
						style='background-color:#55acee;color:white; border:0px;
						;border-radius:100px;font-weight:bold;padding:2px 20px 2px 20px;
						outline:none'>
						</form>";
				}
				else  if(isset($_GET["reset_my_account_part2"]))
				{
					$q = "update channels set owner = 'unknown' where owner like'%$username%'";
					mysqli_query($conn,$q);
					
					$q = "update channels set reciever = 'unknown' where reciever like'%$username%'";
					mysqli_query($conn,$q);
					
							header("location:../home");
					 
				}
		
function change_password($old,$new,$confirm_new)
		{
			$old = $old; $new = $new;	$confirm_new = $confirm_new;
			GLOBAL $id;
			GLOBAL $conn;
			GLOBAL $username;
			
			$q = "select password from users where username='$username'";
			$qry = mysqli_query($conn,$q);
			$arr = mysqli_fetch_array($qry);
			$db_pass = $arr["password"];
			  
			 if($new != $confirm_new)
			 return 2;
			 else if( password_verify($old,$db_pass) )
			 {
			  $new = password_hash( $new,PASSWORD_DEFAULT);
			  mysqli_query($conn,"update users set password='$new' where username='$username'");
			  return 3;
			 }
			 else return 1;
		}	
		
		
		?>
		