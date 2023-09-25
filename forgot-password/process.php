  <?php
   session_start();
     
   require("../db.php");

   $query = $_GET["user"];
   
   $q= "select * from users where username='$query' OR email='$query'";
   $qry = mysqli_query($conn,$q);
   
		   $query_arr = mysqli_fetch_array($qry);
		   
		   $email =  $query_arr['email'] ;
		   $username =  $query_arr['username'] ;
		   
	$code = substr(mt_rand(),0,6);
    $url = "../forgot_password/check_code?mail=$email&code=$code&username=$query";
	$to =  $email;
	$sub =  "Password Reset, $query";
		    $message = "
			<html><head>
			<title>Pexel</title></head><body>
			<br /><br />
			Pexel recieved a password reset request. <br /><br />
			Code is <br>
			<center><b> $code </b> </center><br />
			 Or just click the following link to contine to next step .
			 <a href='$url'>
			 
			click me.</a> <br />
			<br><br>
			Fast and secure <br>
			No need to download traffic <br>
			Stay anonymus <br>
			Chat anything <br><br>
			<address> Internet 24x7</address> 		";
			
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: Pexel <noreply@pexel.in>' . "\r\n";
		
	    $q = "insert into password_reset 
		(user,time,code) values('$username','".time()."','$code')";
		
		if(!mysqli_query($conn,$q))
		echo mysqli_error($conn);
	
		else {
		   if(    mail($to,$sub,$message,$headers) )  // send mail [MAIL]
		   header("location:check_code?email=$email");
		   else {
		   $_SESSION["error_finding_account"]  = "Sir, error occured in SERVER";
	       header("location:index?error=22146&reason=query_not_found");	
		       }
	            }       
	 ?>