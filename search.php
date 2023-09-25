<?php 
  if(!isset($_COOKIE['username']) OR !isset($_COOKIE['email']))
	  header('location: index?login_first');
  // ELSE 
  ?>
	<!DOCTYPE HTML>
	<html>
	<head>
	<title>Search Pexel</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0"
    charset="utf-8"	name="owner" content="SNS" />
	<meta name="Start" content="Start, Log In or Register" />
	<link rel="stylesheet"  href="@admin/css/main.css" />
	<link rel="stylesheet"  href="@admin/css/basics.css" />
	<link rel="icon" href="@admin/graphics/favicon.png" type="image/png" sizes="16x16">
	</head>
	
	<body>
		<center>

		<?php
		if(!isset($_COOKIE['username']))
		require("../");
	    //ELSE
			
		require("traffic_saver.php");
		require("head.php");
		require("db.php"); 
		echo "<br />";
		require("checkQuery.php");
		$username = $_COOKIE["username"];
		
		if(isset($_POST['query']))	
		{
			 $query_for = $_POST["query"];
			 $query_for = clean_user_passed_data($query_for);
			 $date = time();
					
			$q = "insert into search values('$query_for','$username','$date')";
			if(!$query = mysqli_query($conn,$q))
				echo mysqli_error($conn);
			
			$q = "select * from users where
			(email LIKE '$query_for' OR name LIKE '%$query_for%' 
			or username LIKE '%$query_for%') 
			AND (username not like'%$username%' AND email not like'%$username%')";
			
			$query = mysqli_query($conn,$q);
			 
			 $tol = mysqli_num_rows($query);
			 if($tol ==0)
			 {
  			    echo "<center><img src='@admin/graphics/picabot.png'
			     class='avatar'><br />
			    <b>Nothing found, try again for this time <br /><br /><br />
				<h3 style='padding:0 20px 20px 20px'>You friend is not on the service tell him to join and then you can give him feedback without letting him know who you are.";
		         die();
			}
		    else {
			
		for($i=0; $i<$tol; $i++)
		{
			
		$arr = mysqli_fetch_array($query);
		$name = $arr["name"];	
		$eml=  $arr['email'];
		$found_id =  $arr['username'];
		$joined =  date("D M, Y",$arr['time']);
		
		if(isset($arr['photo']))
		$photo= "traffic/user_profile/".$arr['photo']; 
		else $photo= "@admin/graphics/default.png";
	
		echo"
		<a href='profile?user=$found_id' class='profile'>
		<table style='width:100%;height:60px;text-align:justify;border-bottom:1px solid #EEF0F1;padding-left:10px'> 
		<tr><td style='width:20%'>";	
		echo"
		<img src={$photo}	style='height:60px;width:60px' class=avatar ></a> ";
		
		echo "<td style='width:10%'><b>$name	";
		
		echo"<td style='width:70%'>
			<a href='launchChannel?direct=$found_id'>
			<input type='button' class='followbox' style='float:right;height:60%;width:60px;
			margin-right:20px'
			value='Chat'/></div>
		
		</table> </a>";
			}
			   /*Related users
			  $related = array();
			  
			 echo "<br>Related Users";
			 $q = "select * from users";
			 $query = mysqli_query($conn,$q); 
			 $tol_users =  mysqli_num_rows($query);
			  if($tol_users !=0)
			  {
				  $arr = mysqli_fetch_array($query);
				  $name = $arr["name"];	
				  $username =  $arr['username'];
				  
				  if(metaphone($name) == metaphone($name))
					  $related[] = $name;
				  else if(metaphone($name) == metaphone($username))
					  $related[] = $name;
			  } var_dump($related);
			   Related users*/
			   echo " <br><br> <form action=search method=POST >
				<center><table style='width:90%;padding-top:5px'>
				<tr><td colspan=2><h5 style='padding-left:20px'>Search again <tr><td>
		
		<input type=search name=query class=box style='width:100%;border:1px solid 		#00bfff;border-radius:100px;outline:none'
		placeholder='@username, name or email'>
		
		<td> <input type='image' value='find'
		src='@admin/graphics/search.png'
		name='submit' style='height:35px' >
		
		</form>
		</table>";
			die();
			}  
		}
			?>
			
		<form action=search method=POST >
	    <table style='width:90%'>
		<tr><td>
		
		<input type=search name=query class=box style="width:100%;border:1px solid #00bfff;border-radius:100px;outline:none"
		placeholder='@username, name or email'>
		
		<td> <input type='image' value='find'
		src='@admin/graphics/search.png'
		name='submit' style='height:35px;position:fixed;left:80%;top:5.7em'>
		
		</form>
		</table>
		
		<div style='margin-top:10px'></div>
		
		<?php
			$q = "select * from search where
			searcher = '$username' and query is not null order by time desc limit 5 ";
			$query = mysqli_query($conn,$q);
			$tol = mysqli_num_rows($query);
			
			echo"<br>";   
			   for($i=0; $i<$tol; $i++)
				{
				$arr = mysqli_fetch_array($query);
				$name =  strtolower( $arr["query"] );	
				$date=  date("d,M",$arr['time']);
				
				echo"<table style='width:100%;text-align:justify;font-size:30px;padding:0 40px 0 40px'>
				<tr> <td width=80%>
				<img src='@admin/graphics/search-icon.png' 
				style='height:20px' >
				<span style='font-size:20px'>$name
				
				<td><span style='font-size:10px'>$date </span></table>
				
				";
				}
				echo "</table><h5>some recent searches</h5> ";
			
		?>
		
			</body></html>