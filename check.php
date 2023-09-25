	<?php
		session_start();
	
		$email=  strtolower(trim($_POST['email']));
	    $email = preg_replace('/^@/','',$email); 
		
		$password= $_POST['password'];
		
		if(empty($email) || empty($password))
		{
		 	$_SESSION["invalidlogin"] = "Empty username or password";
			header('location:index');
		}
        else 
		{ 	        $_SESSION["login_username"] = $email;
					require("db.php");
					$q="select * from users where email='$email' OR username='$email'";
					$qry= mysqli_query($conn,$q);
					$arr= mysqli_fetch_array($qry);
					$password_in_db = $arr['password'];   
					
					      $email_in_db = $arr['email'];      
					     $id_in_db = $arr['username'];      
						if($email != $email_in_db AND $email !== $id_in_db)
						{
						$_SESSION["invalidlogin"] = "No account found";
						header('location:index');
						}
						else
						{
						if(	password_verify($password,$password_in_db) )
						{
						setcookie('email',$email_in_db,time()+(8640*365));   // for 365 days
						setcookie('username',$id_in_db,time()+(8640*365));         // for 365 
						
						  $_SESSION["status"] = "online";
						  $q="UPDATE users set status='online' where username='$email'";
						  $qry= mysqli_query($conn,$q);  
						
						header('location:home');
						} 
						else  {
						$_SESSION["invalidlogin"] = 'Invalid password';
						header('location:index#email');
						}
						}
			} 
	?> 