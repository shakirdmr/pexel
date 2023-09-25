<?php
		echo" <a href='direct?direct=$channel#last' class='channel_link'>
					
				<table style='width:100%;text-align:justify;padding:5px 0 0 5px'> 
		<tr><td style='width:30%'>";	
		$channel_photo = "../@admin/graphics/defaultSecure.png";
		echo"
		<a href='{$channel_photo}' class='profile'>
		<img src={$channel_photo} style='width:60px;height:60px' 
		class=circle></a> ";
			
		echo"<td style='width:80%'>
			<table  style='width:100%'> 
			<tr><td> <b style='color:black'>$channel</b> ";
					if($total_unseen_messages != 0)
					echo"
					<div class=circle style='width:17px;border:0;
					height:17px;font-size:10px;float:left;
					background-color:maroon;color:white'>
					$total_unseen_messages</div></b> ";
			echo"
			<h6 style='float:right'> $time_last_message </h6>
			<tr><td><h4>
			$last_message <img src='$action_path' width=15px></h4> ";
		

		echo"</table> </table> </a>
		<hr style='margin:0'>";
		
		?>