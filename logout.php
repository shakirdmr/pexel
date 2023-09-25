		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
	
<?php                
						if(!isset($_COOKIE["username"])) 
							header("location:index");
						
					  require("db.php");
					  require('traffic_saver.php');
					  require("head.php");
					  
					  $username = $_COOKIE["username"];
					  setcookie('email',"df",time()-200);
					  setcookie('username',"df",time()-200);
					  setcookie('password',"df",time()-200);
					  
					  $q="UPDATE users set status='offline' where username='$username'";
					  mysqli_query($conn,$q);
					  
					  header("refresh:0.3;url=index");
?>
<center><img src='@admin/graphics/loading.gif' width="200px"><br />
  <b>
  <br><br>
  Getting You Out ..<br />
  Keep patience
  