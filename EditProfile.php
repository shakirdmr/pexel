<!DOCTYPE HTML>
		<html>
		<head>
		<title>Pexel Edit</title>
				
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='SNS' />
		<meta name='Start' content='Start, Log In or Register' />
		<link rel='stylesheet'  href='@admin/css/main.css' />
		<link rel='stylesheet'  href='@admin/css/basics.css' />
		<link rel='icon' href='@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
		</head>
		<body>
	
<?php
						if(!isset($_COOKIE['email']) )
						header("location:index.php");	
						else $email = $_COOKIE["email"];
					

					require("db.php");
					require("time.php");
					$date = timenow() ;
					
			
				if(isset($_POST["update_changes"]))
				{
					///// UPDATING INFOO//
					$name= trim( $_POST['new_name']);
					if(empty($name))
					$failed_name= "<b class='warn'>Name is required</b>";	
					else if(!preg_match ( "/^[a-z A-Z]*$/",$name) )
					$failed_name= "<b class='warn'> Invalid characters in name </b>";
					if(strlen($name)<4 )
					$failed_name= "<b class='warn'>Names are not soo short.</b>";
					else if(strlen($name)>15 )
					$failed_name= "<b class='warn'>Names can't bee soo long.</b>";
				
					
					//gender
					if(!empty($_POST["new_gender"]))
					$gender=  $_POST['new_gender']  ;			 
					else $gender=  NULL  ;			 
					
					/*Uname
					$uname =  trim($_POST['new_username']);
					
					if(empty($uname))
					$failed_unname= "<b class='warn'>Username is required</b>";	
					else if(!preg_match ( "/^[a-z A-Z]*$/",$uname) )
					$failed_uname= "<b class='warn'> Invalid characters in usernamename </b>";
					if(strlen($name)<4 )
					$failed_uname= "<b class='warn'>username too short.</b>";
					else if(strlen($uname)>25 )
					$failed_uname= "<b class='warn'>username can't bee soo long.</b>";
				
				$txt = $uname;
				$qry = mysqli_query($conn," 	SELECT * FROM users WHERE username LIKE '$txt'  ")
		        OR mysqli_error($conn);
		        $any = mysqli_num_rows($qry);
				if($any !=0)
		        { 
		   	    $ct = 1;
				while($ct !=0)
				{
				$sgst= $txt.substr(mt_rand(),0,2);
				$qry = mysqli_query($conn,"SELECT * FROM users WHERE username LIKE '$sgst'");
				if( mysqli_num_rows($qry) ==0 ){
				$new_username = $sgst;
				goto outt;
				} }	}		
				else 
				$new_username = $txt;
				$username = strtolower($username);
				
			    outt:
					uname*/
					
			if(!isset( $failed_name))
			{	
			mysqli_query($conn,"update users set name='$name', gender='$gender'
			where email='$email'");
			
			header("location:profile?account_updated");
			}	}
				?>

		<?php
					require("head.php");		
		$q="select * from users where email='$email'";
		
		$qry= mysqli_query($conn,$q);
		$arr= mysqli_fetch_array($qry);
		$name = $arr['name'];
		$password = $arr['password'];
		$name = $arr['name'];
		
		$id = $arr['username'];
		$dt = $arr['time'];
		$gender = $arr['gender'];
		
		if(isset($arr['photo'])){
		$photo= "../traffic/user_profile/".$arr['photo']; ; }
		else $photo= "graphics/default.png";
		
		echo "<center><div style='width:100%;padding-left:20px'>";
		echo"<table  style='width:80%'cellpadding=5 > ";
			
				 
		echo"<tr> <td><img src='$photo' class='avatar'>   
		<tr><td>
		<span><b>@$username</b></span><br />";
		?>	
		
				<form action="EditProfile" method="POST">
				 
                <tr><td>Email</td></tr><tr><td>
				<input type="email" style='background:#f1f1f1' disabled
				class="box" value="<?php echo $email?>">      
				</td></tr>
                
				<tr><td> Name, type new</td></tr><tr><td>
				<input type="name" class="box"
				name="new_name"
				value="<?php echo $name ?>"
					<?php 
					if(isset( $failed_name))
					echo"<br /><br>$failed_name"; ?>
					</td></tr>
					
				
				<tr><td>Username, new below</td></tr><tr><td>
				<input type="text" style='background:#f1f1f1' disabled
				class="box" value="<?php echo $id?>" name='new_username'> 
				    <?php 
					if(isset( $failed_uname))
					echo"<br />$failed_uname"; 	?>
				</td></tr>
								
				</td></tr>
				<tr><td>Gender, change below</td></tr><tr><td>
				<select name="new_gender" style="width:50%" class="box"
				style='background:white'>
				
				<?php if(empty($gender))
					echo '<option> Choose Below</option>
					<option  value="male"> Male</option>
					<option value="female"> Female</option>	';	
					else if($gender == 'male')
					echo '<option  value="male"> Male</option>
					<option value="female"> Female</option>';
					else if($gender == 'female')
					echo '<option value="female"> Female</option>
					<option  value="male"> Male</option>';
					else 
					echo '<option> Choose Below</option>
					<option  value="male"> Male</option>
					<option value="female"> Female</option>	';		
					?>
				</select></td></tr>

				<tr><td><input type="submit" class="followbox"
				class="create" 	name="update_changes" value="Update account"> 
				</form>	</td>  </tr>     
				</table> 

				</body> </html>