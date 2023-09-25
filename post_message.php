<?php

  session_start();
  require("db.php");
  require("checkQuery.php");
  
  if(!isset($_COOKIE["username"]))
	  header("location:index");
  // ELSE
	  
  $username = 	$_COOKIE["username"];
  $channel = $_GET["channel"];
  $reciever = $_POST["reciever"];
  $time = time();
	
  $key = md5($channel);
  $message = addslashes(trim(encrypt($_POST["message"],$key)));

  if(isset($_FILES["file"]))
  { 
   if(!empty($_FILES["file"]["name"]))
   {
  $name = processOnFile($_FILES["file"],"name");
  $path = "traffic/media/".$name;
  $type = processOnFile($_FILES["file"],"type");

  $tmp_name = $_FILES["file"]["tmp_name"];
  $is_uploaded = move_uploaded_file($tmp_name,$path);
  
		$q = "insert into direct_message 
		(message,time,file_included,file_path,
		 sender,reciever,channel)
	    values('$message','$time','$type','$name','$username','$reciever','$channel')";
		mysqli_query($conn,$q);
   }
  else {
		$q = "insert into direct_message 
		(message,time,
		 sender,reciever,channel)
	    values('$message','$time','$username','$reciever','$channel')";
		mysqli_query($conn,$q);
      }}
  
	    $q = "update channels set last_message_time ='$time'
		where name='$channel'";
		mysqli_query($conn,$q);
		header("location:direct?direct=$channel#last"); 
		
		
		function processOnFile($file,$pro){
			
		$name=@crypt($file['name']);
		$name =preg_replace('/[^A-Za-z0-9]/','',$name); 
		
		$ex = explode(".",$file['name']);
		$type = $ex[1];
		$name .= ".$type";
		
		$photos=  ['jpeg','jpg','png','ico','bmp'];
		$videos=  ['mp4','3gp'];
		$audios = ['mp3','wav','ogg'];
		
		  if(in_array($type,$photos))
		  $type	 = "photo";
		  else if(in_array($type,$videos))
		  $type	= "video"; 
		  else if(in_array($type,$audios))
		  $type	= "audio"; 
		  else $type	= "file"; 
		 
		if($pro == 'name')
			return $name;
		
		else if($pro == 'type')
			return $type;
		}		
  ?>