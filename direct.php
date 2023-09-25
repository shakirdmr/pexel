<?php 
  session_start();
	if(!isset($_COOKIE['username']) OR !isset($_COOKIE['email']))
		header('location: index?login');   
          if(!isset($_GET["direct"]))
	        header("location:home");
  // ELSE 
	  
  ?>

		<!DOCTYPE HTML>
		<html>
		<head>
		<title>Pexel, Conversation</title>
		
		<meta name='viewport' content='width=device-width,initial-scale=1.0'
		charset='utf-8'	name='owner' content='direct' />
		<meta name='Direct' content='Message, Anonymously' />
		<link rel='stylesheet'  href='@admin/css/main.css' />

		<link rel='icon' href='@admin/graphics/favicon.png' type='image/png' sizes='16x16'>
		
		</head>
			<style>
			.msgbox{
			border:1px solid  #b2b3b5;border-radius:30px;
			  max-width:70%;padding:5px;margin:2px;padding:10px;
			  text-align:justify
			}
			</style>
		<body>

	    <center>

	<?php 
	
	//else
	$channel = $_GET["direct"];
	$username = $_COOKIE['username'];
	$email =  $_COOKIE['email'] ;
	
			require('db.php');
			require('checkQuery.php');
			require('traffic_saver.php');
			require('time.php');
			
	$query = "select * from channels where name='$channel'";
	$q = mysqli_query($conn,$query);
	$arr = mysqli_fetch_array($q);
	
	$owner = $arr["owner"];
	$reciever = $arr["reciever"];
	$block =   $arr["block"];
	
	  if($owner == $username)
	  {
	  $reciever_name = $reciever;
	  $msg_reciever = $reciever;
	  }
	  else {
		$reciever_name = $channel;
		$msg_reciever = $owner;
	  }
	  
	$query = "select * from traffic where 
	username ='$msg_reciever' ORDER BY date desc";	
	$q = mysqli_query($conn,$query);
	
	$arr = mysqli_fetch_array($q);
	$last_seen = date("h:i d M ",$arr["date"]);
	
	          $d1 = time();
	          $d2 = $arr["date"];
			  $diff = $d1-$d2;
			  $min = ($diff/60);
			    if($min <= 1)
				$last_seen = "online";
			    else if($d2 <0 OR empty($d2))
				$last_seen = "last seen unknown....";
			
	require('directhead.php');
	
	$query = "select * from direct_message where 
	channel='$channel' AND (
	sender='$username' OR reciever ='$username')
	ORDER BY time asc";	
	$q = mysqli_query($conn,$query);
				
				//set unseen as seen:
	$q_action = "UPDATE direct_message set action='seen' where   
	reciever ='$username' AND channel='$channel'";
	mysqli_query($conn,$q_action);
					
	$total_messages = mysqli_num_rows($q);
	
	
	if($total_messages == 0)
	echo "<br /> <b>no messages till now.<br>
	Is it all clear, start new below <br /><br />";
	
	else{	        
			   
			for($i=0; $i<$total_messages; $i++)
			{ 
			$arr = mysqli_fetch_array($q);
			$salt = md5($channel);
			$message = clean_direct_message_from_db(decrypt($arr["message"],$salt));
			
			$date = givetime($arr["time"]);
			$sender = $arr["sender"];
			$action =   $arr["action"];
			$file_included =   $arr["file_included"];
			$file_name = $arr["file_path"];
			$file_path ="../traffic/media/$file_name";
			
			if($action == 'seen')
			$action_path = "../@admin/graphics/seen.png";
			else $action_path = "../@admin/graphics/unseen.png";
						
						echo "<table style='width:100%'><tr>";
				   
				if($sender == $username)
				echo "<td class='msgbox'	style='float:right; clear:right;background:#f7f7f7'>";
				else 
				echo "<td class=msgbox  style='float:left; clear:left'>";
					
				    
					if($file_included == 'photo')
					echo"<a href='download?file=$file_name'>
				        <img src='$file_path' width=15px style='width:100%;border-radius:20px 20px 0 0;'>
						</a>";
				    
					else if($file_included == 'video')
					echo"<a href='download?file=$file_name'>
					     <video style='width:100%' controls
					      preload=metadata>
					      <source src='$file_path' > Video</source>
					      </video></a><br>";
				    
					else if($file_included == 'audio')
					echo"<a href='download?file=$file_name'>
					     <video style='width:100%' controls
					      preload=metadata>
					      <source src='$file_path' > Video</source>
					      </video></a><br>";
						  
					else if($file_included == 'file')	  
					    echo"<a href='download?file=$file_name'>
						   <img src='../@admin/graphics/download.png' width=15px>
				           Download File</a><br>";
				   
				   echo"<b>$message   &nbsp;&nbsp; </b>";
				   if($sender == $username)
					echo "<br><img src='$action_path' width=15px>";
				   
				   echo"$date</table>";
				   
			
				   
			}
                 		
			} // else on ln:77q
			 	
			
			if($block == 1)
				die("<b> It has been blocked here,<br /> nothing can be send.");
			?>
			
			
		<hr style='margin-bottom:80px;border:0'>
		
		<form action='post_message?channel=<?php echo $channel?>' 
		method='POST' enctype="multipart/form-data">
		
		<table style='width:100%;height:50px;
		position:fixed;background:white;bottom:0'>
		<tr>
		<td style='width:10%'>
			<label> <!-- Add a file -->
			
			<img src="../@admin/graphics/includeMedia.png"
			style='width:40px;bottom:0'/>
			<input type='file' name='file' id="logo" style='position:fixed;top:-200em'
			onchange="javascript:this.form.submit();" >	
			
			</label>
			
		<td style='width:60%'>
		    <input type=hidden name='reciever' value='<?php echo $msg_reciever; ?>'>

						<textarea name='message'  placeholder='write a message..' 
			style='width:100%;border:2px solid #00bfff;height:100%;
			border-radius:100px;padding-left:20px;outline:none;
			;margin-top:1px;resize:none'></textarea>
			</td>
			
		<td style='width:20%'>
		    <input type='image' src="../@admin/graphics/sendbutton.png"
			name='sub' value='send'  style='width:40px;float:right'/>
		</td></tr> </table>

		</form>
		</table>
		         <span id='last'> </span>
		<?php session_destroy(); 	?>
		</body>
		</html>