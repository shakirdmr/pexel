	<?php
	   require'db.php';	
	 function clean_user_passed_data($t)
	{
	  $t = preg_replace('/^@/','',$t); 
	  return preg_replace('/[^A-Za-z0-9\@.]/','',$t); 
	  // if anything else than A-Za-z0-9\ @# replace with blank
	}	  
	   

	function clean_direct_message_from_db($t)
	{
	$t = trim($t);
	$t = wordwrap($t,30,"\n");
	$t = htmlentities($t);
	$t = preg_replace('/\ /','&nbsp;',$t); 
	$t = preg_replace('/\n/','<br />',$t); 
	$t= stripslashes($t);
	return $t;
	}
	
     function encrypt($string,$key){
	 $str = base64_encode( mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB));
	 return $str;
	 }
	 
	 
	function decrypt($string,$key){
			$str = mcrypt_decrypt( MCRYPT_RIJNDAEL_256,$key,base64_decode($string),MCRYPT_MODE_ECB );
			return $str;
			}
			