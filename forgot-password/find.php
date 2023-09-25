<?php    session_start();  ?>

		<html>
		<head>
		<title>Reset Password Pexel</title>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet"  href="../@admin/css/main.css" />
		<link rel="stylesheet"  href="../@admin/css/basics.css" />
		
			
		</head>
		<body>
		<center>
		
  <?php     
   require("../db.php");
   require("head.html");

   $query = $_POST["query"];
   if(empty($query))
   {
	$_SESSION["error_finding_account"]  = "Give a value..";
	header("location:index?query_empty");	
   }
   
   $q= "select * from users where username='$query' OR email='$query' OR name like'%$query%'";
   $qry = mysqli_query($conn,$q);
   $tol_found = mysqli_num_rows($qry);
   
   if($tol_found == 0)
   {
	   echo "No matches found anywhere";
	   die();
   }
   else 
     {
			echo"We found below, <br>click reset to access your account <br /><br />";
			for($i=0; $i<$tol_found;  $i++){
				
		   $query_arr = mysqli_fetch_array($qry);
		   $email =  $query_arr['email'] ;
		   $name =  $query_arr['name'] ;
		   $username =  $query_arr['username'] ;
		   $photo = "../traffic/user_profile/".$query_arr["photo"];
		   
			echo"
			<a href='process?user=$email' class='profile'>
			
			<table style='width:100%;height:60px;text-align:justify;border-bottom:1px solid #EEF0F1;padding-left:10px' > 
			<tr><td style='width:30%'>";	
			echo"
			<img src={$photo}	style='height:60px;width:60px' class=avatar ></a> ";
		
			echo "<td style='width:10%'><b>$name	";
		
			echo"<td style='width:60%'>
			<input type='button' class='followbox' style='float:right;height:60%;width:60px;
			margin-right:20px'
			value='Reset'/></div>
			</table> </a>";
			
		   }
		   
	 }
	 
	 ?>