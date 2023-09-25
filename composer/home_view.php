<?php
		
	
     $query = "select * from users where username ='$username'";
	 $q = mysqli_query($conn,$query);
	 $arr = mysqli_fetch_array($q);
	 $verify = $arr["verify"];	
	 
	   if($verify != 'TRUE')
		   echo "<a href='../confirm-code/index' style='text-decoration:none'>
				<table style='margin-top:5px'>
				<tr><td style='border-radius:100px;border:2px solid red;
				padding:5px 15px 5px 15px;background:#fafafa;color:black'>
				Confirm email, click here. </table></a>";
	 
	$query = "select * from channels where owner ='$username'
		      OR reciever='$username' ORDER BY last_message_time desc";
		
	$q = mysqli_query($conn,$query);
	$total_messangers = mysqli_num_rows($q);
	
	if($total_messangers == 0)
	{
	echo '<br /> <div style="padding:20px"><b>
	      No messages for you still.<br /> 
		  Search for anyone and share your feedback Seceretly.
	      </div>';
		
	    echo "
		<form action=search method=POST >
	    <table>
		<tr><td>
		<input type=search name=query class=box 
		placeholder='name, @username, or email'>
		<td> <input type='image' value='find'
		src='@admin/graphics/search.png'
		name='submit' style='height:35px' >
		</table>
		</form><br /><br /><br />";
	}
	else {
		 for($i=0;  $i<$total_messangers; $i++)
		{
				$arr = mysqli_fetch_array($q);
				$channel = $arr["name"];	
				$time_created = $arr["time"];
				$time_created = date("D, M d",$time_created);
				$reciever = $arr["reciever"];
				$sender = $arr["owner"];
			      
					  $query = "select * from direct_message where channel='$channel' 
					  AND (
			          sender='$username' OR reciever='$username')
					  ORDER BY time desc";
					  $q_msg = mysqli_query($conn,$query); 
			  		  $arr_msg = mysqli_fetch_array($q_msg);
					  
					  $msg = decrypt($arr_msg["message"],md5($channel));
					  $msg = htmlentities($msg);
					  $last_message = 	substr($msg,0,50)."...";
					  
					  $action = $arr_msg["action"];
					  if($action == 'seen')
						$action_path = "@admin/graphics/seen.png";
					  else $action_path = NULL;
					  
					  $query = "select * from direct_message where channel='$channel' 
					  AND (
			          reciever='$username') AND action is null";
					  $q_msg = mysqli_query($conn,$query); 
					  $total_unseen_messages = mysqli_num_rows($q_msg);
					  
					  
					  $q_photo = "select * from users where username='$reciever'";
					  $q_photo = mysqli_query($conn,$q_photo); 
					  $arr_photo = mysqli_fetch_array($q_photo);
					  
					  if(isset($arr_photo["photo"]))
					  $channel_photo = "../traffic/user_profile/".$arr_photo["photo"];
					  else
				  	  $channel_photo = "../@admin/graphics/default.png";
					  
					  
					  $query = "select * from channels where name='$channel'";
					  $q_msg = mysqli_query($conn,$query); 
			  		  $arr_msg = mysqli_fetch_array($q_msg);
					  $time_last_message = $arr_msg["last_message_time"];
					  $time_last_message = date("h:i M,d",$time_last_message);
						  
				 if($sender == $username)
					 require("sender.php");
				 else require("reciever.php");
				 
				}
	}
	   				 echo "
					 <a href='http://learn.pexel.in'><img src='@admin/graphics/banner.png' style='width:80%;padding-top:5px
					;border-radius:100px'></a>";
				
				 echo "<br /><h4>say anyone, everything.";
	?>
	
	</body>
 	</html>
	
	