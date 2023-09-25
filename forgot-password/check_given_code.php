  <?php
   session_start();
   require("../db.php");
   
		$username = $_POST["username"];
		$code = $_POST["code"];
        $q= "select * from password_reset where code='$code' 
		AND user='$username' ";
	   $qry = mysqli_query($conn,$q);
	   
       if( mysqli_num_rows($qry) == 0)
		{
	    $_SESSION["error_confirming_code"] = "incorrect code, try again";
	    header("location:check_code?email=$username&error=22146&reason=incorrect_code");	
		}
        else 
        {
			 $q= "delete from password_reset where code='$code' 
			 AND user='$username' ";
			 $qry = mysqli_query($conn,$q);
			 
		$_SESSION["change_password"] = $username;
		$_SESSION["code"] = $code;
	    header("location:change_password");	
	    }
	
	 ?>