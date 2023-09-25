<?php
  require('traffic_saver.php');
  if(isset($_POST['feedback']))
  {
	  require('db.php');
				function ip(){
				$client  = @$_SERVER['HTTP_CLIENT_IP'];
				$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
				$remote  = $_SERVER['REMOTE_ADDR'];

				if(filter_var($client, FILTER_VALIDATE_IP))
				$ip = $client;
				else if(filter_var($forward, FILTER_VALIDATE_IP))
				$ip = $forward;
				else
				$ip = $remote;
			return $ip;
					}
	   
	   $time  = time();
	   $ip = ip();
	   $device  = $_SERVER["HTTP_USER_AGENT"];
	   $feedback =  $_POST['feedback'];
	     if(isset($_COOKIE['email']))
		 $email  = $_COOKIE['email'];
	   
	   $q ="insert into feedback values('$ip','$time','$device','$feedback','$email')";
	   if($qry= mysqli_query($conn,$q))
		   $done =1;
	   else echo mysqli_error($conn);
		
  }
?>
    <!DOCTYPE html>
    <html>
	<head>
	<title>Pexel, write us - love us</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet"  href="@admin/css/main.css" />
	<link rel="stylesheet"  href="@admin/css/basics.css" />
	<style>
	li {
		padding:10px;
	}
	</style>
	</head>
	<body>
			<div class="screencontroller">
	
	<table style='padding:10px 0 0 20px;width:100%'>
	<tr>
	   <td>
	   <img src='../@admin/graphics/plogo.png' width=50px><td>
	 <span style="font-size:30px;cursor:pointer;color:black">
	 <a href='../home'>
	  Pexel<td><h5>Feedback messenger<td style='width:80%'>
    </table> 
	<?php 
	
		echo "<body>
		<div style='padding:20px'>";
	 
		if(isset($_GET["faq"]))
		{?>
		<b>What you do ?</b><br />
		We provide you the ability to chat secretly to anyone without letting them know who you are <br /><br />
		
		<b>How to use it ?</b><br />
		Create a new account and search for someone whom you want to chat, it depends whether
		he has created an account or not and then chat to him .<br /><br />
		
		<b>Will they know who i am ?</b><br />
		No, none can know who is messaging them until you say them. <br /><br />
		
		<b>Can they reply to me messages ?</b><br />
		Yes, that's the beauty of Pexel, it lets you to chat with anyone and they can reply you back.<br /><br />
	   
 <?php } 
	  else if(isset($_GET["contact"]))
	  {?>
	   Contact us at <b><u>us@pexel.in</u></b>
	   <br style="margin:15px 5px 5px 5px"/>
	   
	   <br style="margin-bottom:15px"> Leave a feedback <br/>
	   <form action="about?contact" method="POST">
	   
	   <textarea class=box style="width:90%;height:80px;background:#fcfcfc;resize:none"
	   placeholder='Write your problem or any question ?' name='feedback'></textarea>
	   
	   <input type="submit" value="Submit it" class=followbox 
	   style="background:pink;color:black">
	   </form>
       <?php if(isset($done))  echo "We have received your feedback, we'll work on it soon.";?>
	   
	  <?php }
 else {?>
				
			  <b>Our mission</b>	<br />			
		       Anyone, anywhere can say anything to anyone.
			   
			   <p><b>
			   We believe that you can learn more if you raise questions that you hesitate to ask, either of shyness or being laughed at. So we decided to give you the power to talk to anyone, question or say anything without letting them know who you are until you want.</p>
			   </p>
		   <a href="about?contact">
		   <img src='../@admin/graphics/mobile.png' width=20px>
		   Contact or Talk to Us ? </a>
		       <table style='text-align:center'><tr><td>
			   <img src='@admin/graphics/secure.png' style='width:30%'>
			   <br>Secure and anonymus
			   <br><br><br>
			   
			   <tr><td>	
			   <img src='@admin/graphics/fast.png' style='width:30%'>
			   <br>Deliver in a  fastest way
			   <br><br><br>
			   
			   <tr><td>	
			   <img src='@admin/graphics/chat.png' style='width:30%'>
			   <br>Meant for conversation
			</table>
	
	<?php }
	echo "</div>";
   ?>					
	
				<center><h5 style='color:black'> Pexel &copy  2017
					  <br>feedback messenger
					 
	</body>
	</html>
   