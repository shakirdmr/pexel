	<html>
	<head>
	<title>Pexel Register</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Direct" content="Change password" />
	<link rel="stylesheet"  href="../@admin/css/main.css" />
	<link rel="stylesheet"  href="../@admin/css/basics.css" />
	<link rel="icon" href="@admin/graphics/favicon.png" type="image/png" sizes="16x16">
			<style>
			.xx{
				border:2px solid #00bfff;
				padding:10px;
				border-radius:100px;
				outline:none;
			}
			</style>
	</head>
	
	<body> 
	
<?php
   require("../db.php");
   require("../traffic_saver.php");
   require("head.php");
   
		if(!isset($_GET['registrar']))
		 header("location:index?registrar_undefined");
	     else $email  = $_GET["registrar"];
   
   if(isset($_POST["create"]))
   {
	   $name  =  $_POST["name"];
	   $password=  $_POST['password']  ;			 
		  
		            if(empty($name))
					$failed_name= "<b class='warn'>Name is required</b>";	
					else if(!preg_match ( "/^[a-z A-Z]*$/",$name) )
					$failed_name= "<b class='warn'> Invalid characters in name </b>";
					if(strlen($name)<4 )
					$failed_name= "<b class='warn'>Names are not soo short.</b>";
					else if(strlen($name)>15 )
					$failed_name= "<b class='warn'>Names can't bee soo long.</b>";
				
				 		//Password	
					if(empty($password))
					$failed_password="<b class='warn'>Password is required to login.</b>";
					else if(strlen($password)<4 ) 
					$failed_password="<b class='warn'>Password length should be greater than 4 digits</b>";
					else addslashes(
					$password =password_hash( $password,PASSWORD_DEFAULT)
					);
					
				if(isset($failed_name) OR isset($failed_password))	
				  goto out_to_form;
			  
			      //username	
				$txt = preg_replace('/ /','',$name);
				$qry = mysqli_query($conn," 	SELECT * FROM users WHERE username LIKE '$txt'  ")
		        OR mysqli_error($conn);
		        $any = mysqli_num_rows($qry);
				if($any !=0)
		        { 
		   	    $ct = 1;
				while($ct !=0)
				{
				$sgst= $txt.substr(mt_rand(),0,2);
				$qry = mysqli_query($conn,"SELECT * FROM users WHERE username LIKE '$sgst'");
				if( mysqli_num_rows($qry) ==0 ){
				$username = $sgst;
				goto outt;
				} }	}		
				else 
				$username = $txt;
			
			    outt:
				
				$username = strtolower($username);
				$q= "insert into users (name,email,password,username,time)
				values('$name','$email','$password','$username','".time()."')";
			        if(! mysqli_query($conn,$q))
					echo mysqli_error($conn);
					else {
					setcookie('username',$username,time()+(8640*365),"/");  
					setcookie('email',$email,time()+(8640*365),"/");  
					header('location:../home');
					die();
					  }
   }
			out_to_form:
            ?>
			<br /><br />
				<table style='width:100%;padding:20px'>
				<tr>	<td style='padding-left:10px'>Enter full name
				<tr>	<td>
			    <form action='start?registrar=<?= $email ?>' method='POST'>
			    <input type="name" class="xx" style='width:90%;height:50px'
				placeholder="full Name here" name="name"   maxlength="15">
				<br> 
				 <?php if(isset($failed_name))
					   echo $failed_name;
				   ?>
				</td></tr>
				
				<tr>	<td style='padding-left:10px'>Enter a strong password
				
				<tr>	<td>
				<input type="password" class="xx" maxlength="50"
				placeholder="Password" name="password" style='width:90%;height:50px'>
				<br>
				<?php if(isset($failed_password))
					   echo $failed_password;
				   ?>
				   
				<tr>	<td><br>
				<input type="submit" class="xx" style='width:20%;
				font-weight:bold; background:#00bfff;color:white'
				 name="create" value="Done"> 
				 
				</form>
				</table>