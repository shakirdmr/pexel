		<?php session_start(); ?>
		<html>
		<head>
		<title>Reset Password Pexel</title>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="assets/graphics/snap.png" type="image/png"  />
		<link rel="stylesheet"  href="../@admin/css/main.css" />
		<link rel="stylesheet"  href="../@admin/css/basics.css" />
		<link rel="icon" href="../@admin/graphics/favicon.png" type="image/png" sizes="16x16">
			
		</head>
		<body>
		<?php require("head.php"); ?>
		 
				<br /><br />
			    <table style="width:100%;text-align:juftify;padding-left:20px" >
				<tr><td>
				Enter username or email, that is linked to your account
				<tr><td>
			    <form action="find" method="POST" >
		
                <tr>	<td>
				 <input type="text" 
				 placeholder="username, email or name" 
				 name="query"  class="box " style='width:90%;height:50px'
				 autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
				 
				 <input type='hidden' name="step_one" value=1>
				
				<?php 
				if(isset($_SESSION["error_finding_account"]))
				echo "<br><br><div style='color:black;font-weight:bold'>"
		         .$_SESSION["error_finding_account"]."</div>";;
				?>
				
				<tr> <td><br />
				 <input type="submit" class="box" value="Reset this account"
				 style="background-color:#55acee;color:white; border:0px;
				 padding:0 20px 0 20px;font-weight:bold"		name="box">		</a>
				 
				</td> </tr> </table>
				</form>
			
			<?php 			//session_destroy(); ?>
			</body>	
			</html>