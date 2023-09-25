  <?php
   session_start();
     
   require("../db.php");
 
   $user =  $_GET["username"];
   
   $q= "select * from password_reset where user='$user'";
   $qry = mysqli_query($conn,$q);
   
   if( mysqli_num_rows($qry) == 0)
   {
	   $_SESSION["error_finding_account"]  = "no account found";
	   header("location:index?error=22146&reason=user_not_found");
   }
   else 
     {
		   $user_arr = mysqli_fetch_array($qry);
		   $code =  $user_arr['code'];
		   
		   $q_email= "select * from users where username='$user'";
		   $qry_email = mysqli_query($conn,$q_email);
		   $user_arr_email = mysqli_fetch_array($qry_email);
		   $email =  $user_arr_email['email'] ;
		   
    $url = "../forgot_password/check_code?mail=$email&code=$code&username=$user";
	$to =  $email;
	$sub =  "Password Reset, $user";
		  $message = "
			<html><head>
			<title>HTML email</title></head><body>
			<br /><br />
			Password Reset request accepted. <br /><br />
			Code is <br>
			<center><b> $code </b> </center><br />
			 Or just click the following link to contine to next step .
			 <a href='$url'>
			click me.</a> <br /><br />
			Password Reset. <br>
			Love #sns.
			<address> 22 mini road, laclchowk </address> 
			";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <company@sns.com>' . "\r\n";
	
		   if(    mail($to,$sub,$message,$headers) )  
		   header("location:check_code?&username=$user?send_code_again=TRUE");
	   
		   else {
		   $_SESSION["error_finding_account"]  = "Sir, error occured in SERVER";
	       header("location:index?error=22146&reason=user_not_found");	
		       }
			   
	            }  
				?>