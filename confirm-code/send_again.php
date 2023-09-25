	<?php 
					require("../db.php");
						
						//Email
					 $email =  $_COOKIE["email"];			 
					
    //  	Message him code on his email ...  	
	$code = substr(mt_rand(),0,6);
	
	$website =  "http://pexel.in";
    $url = "$website/new-user/check_link_code?mail=$email&code=$code";
	$sub =  "Confirm your Pexel code";

	   	    echo$message = "
			<html><head>
			<title>Pexel</title></head>
			<body>
			<span style='font-size:25px;
			font-family:calibiri'>
			<br /><br />
			Dear,<br /> 
			Confirmation Code is <br><br>
			
			<center><b><span style='font-size:70px'> 
			$code </span></b> </center><br />
			 Or just click the following link :<br />
			 <a href='$url'>
			click me.</a> <br /><br />
			<br><br>
			
			Fast and secure, <br>
			Share feedback, <br>
			Stay anonymus, <br>
			Chat anything, <br><br>
			<address> Internet 24x7</address>. ";
				    
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: Pexel <noreply@pexel.in>' . "\r\n";
		
        $q = "insert into confirm_code
		(email,time,code) values('$email','".time()."','$code')";
		mysqli_query($conn,$q);
		  
	    if( @mail($email,$sub,$message,$headers) )
		{
		 header("location:index?mailSent");	
		}
		 else {
					 $_SESSION["failed_email"] = "server error 404..";
					 header("location:index?server_error");
		 }
		 
		 ?>