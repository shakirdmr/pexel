		<?php
		
		require("../db.php");
		require("../head.php");
        $email = $_COOKIE["email"];
				
	 
		 		      if(isset($_POST["code"])){
			   $code = $_POST["code"]; 
		        
			   $q= "select * from confirm_code where code='$code' 
			   AND email='$email' ";
			   $qry = mysqli_query($conn,$q);
   
				if( mysqli_num_rows($qry) != 0)
				{
				  $q = "delete from confirm_code where code ='$code' AND email='$email'";
				  $qry = mysqli_query($conn,$q);
				  
				  $q = "update users set verify='TRUE' where email='$email'";
				  $qry = mysqli_query($conn,$q);
				  
				  header("location:../home");
				  die();
				}	
				else $invalid_code = TRUE;
			  }
		 
			?>
			    		<html>
		<head>
		<title>Pexel Register</title>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet"  href="../@admin/css/main.css" />
		<link rel="icon" href="../@admin/graphics/favicon.png" type="image/png" sizes="16x16">
		
		</head>
		<body>
		
			    <br /><br />
			    <table style='width:100%;padding-left: 20px' cellspacing=10>
				<form action='' method='POST'>
                <tr><td><br /><br />
				Confirmation code 
				<tr><td>
				<input type='tel'  style='width:90%;height:50px'
				placeholder='6 digit code' name='code'  class='box' 
				maxlength=6  <?php
							 if(isset($code))
						    echo $code;  ?> >
				  
				  <?php
				    if(isset($invalid_code))
						echo "<br>you gave an invalid code,<br /> double check it and try again";
				  ?>
				  
				 <tr><td>				
				 <input type='submit' class='box' value='Check code'
				 style='background-color:#55acee;color:white; border:0px;
				 font-weight:bold;padding:0 20px 0 20px'		name='next'>	
				 </form>
				 
				 <br><br><br>
			     Didn't recieved code ?<br>
				 Just click below
				 <a href='send_again?request_code_again=send-new&email=<?= $email ?>'> 
				 
				 <h4>'request code again'.</a>
				 <tr><td>
				 </table>	
				 
				 <?php	if(isset($_GET['mailSent']))
				{
				echo "<center><a href='../confirm-code/index' style='text-decoration:none'>
				<div style='border-radius:100px;border:1px solid red;width:80%;
				padding:5px 15px 5px 15px;background:#fafafa;color:black'>
				
				Wait some time to get email,<br /> 
				than even check Spam in your email. </div></a>";
				}?>
				 
	</body>		
	</html>		