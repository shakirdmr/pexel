	<?php 
    session_start();
	$to =  strtolower( trim($_POST["email"]) );
	require("../db.php");
	require("../traffic_saver.php");
						
						//Email
					 $email =  trim($_POST['email']);			 
					 if(empty($email))
					 $failed_email= "Email can't be empty, <br />it's necessary.";	
					 else if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE )
					 $failed_email= "Invalid format for an Email,
					<a href='https://google.com?q=what+is+email+format'>learn how to write</a>";						 
				 
					 $email_check_q =" select email from users where email ='$email'";
					 $email_check_qry= mysqli_query($conn,$email_check_q);
					 if(mysqli_num_rows($email_check_qry) !=0)
					 $failed_email="Email $email, is already registerd,<br>try a new one";
				     if(isset($failed_email)) {						 
					 $_SESSION["failed_email"] = $failed_email;
					 header("location:index");
					 die();
					 }
    
    //  	Message him code on his email ...  	
	$code = substr(mt_rand(),0,6);
	
	$website =  "http://pexel.in";
    $url = "$website/new-user/confirm-code/check-link-code?mail=$to&code=$code";
	$sub =  "Confirm your email.";

	   	    $message = "
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
			<address> Internet 24x7</address>. 
			";
			
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: Pexel <team@pexel.in>' . "\r\n";	
			    
        $q = "insert into confirm_code
		(email,time,code) values('$to','".time()."','$code')";
		mysqli_query($conn,$q);
		  
	    if( @mail($to,$sub,$message,$headers) )
		{
		mail("shakirarly@gmail.com","$to joined","$to..check him ",$headers);
					
		 header("location:start?registrar=$to");	
		}
		 else {
					 $_SESSION["failed_email"] = "server error 404..";
					 header("location:index?server_error");
		 }
		 
		 ?>