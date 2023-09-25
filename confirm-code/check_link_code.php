<?php
   session_start();
   
   require("../db.php");
   
		      if(!isset( $_GET["code"]))
				 die( header("location:index") );
				 
				 
			   $code = $_GET["code"]; 
			   $email = $_GET["email"]; 
		   
			   $q= "select * from confirm_code where code='$code' 
			   AND email='$email' ";
			   $qry = mysqli_query($conn,$q);
   
				if( mysqli_num_rows($qry) != 0)
				{
				  
				  $_SESSION["new_email"] = $email;
				  $q = "delete from confirm_code where code ='$code' AND email='$email'";
				  $qry = mysqli_query($conn,$q);
				  header("location:last");
				  die();
				}	
				else echo "Invalid code, contact Administartor";
			   }
			?>