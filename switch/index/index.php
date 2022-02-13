<div id="left-col">

				<div id="top-tutorials">
					<div class="text-title"></div>
						
						<?php
						 $sql_top = "SELECT * FROM `tutorials` WHERE `show`='true' ORDER BY `votes` DESC LIMIT 2";
						 tutorials($sql_top, 270, 180, "votes-author");
						?>

					<div class="clear"></div>
				</div>

				<div id="popular-tutorials">
					<div class="text-title"></div>

					<?php
						 $sql_famouse = "SELECT * FROM `tutorials` WHERE `show`='true' ORDER BY `views` DESC LIMIT 6";
						 // tuka NE sa 270x180 - просто подавам сойностите по подразбиране за да  не ми са налага да пиша аз др .. 
						 tutorials($sql_famouse, 270, 180, "views-author");
					?>


					<div class="clear"></div>

				</div>


				<div id="top-users">
					<div class="text-title"></div>
				
					<?php
					$top_users = mysql_query("SELECT * FROM `users` ORDER BY `tutorials` DESC LIMIT 4");
					while($r = mysql_fetch_array($top_users))
					{
					?>

					<div class="tutorial" style="background: url('<?php echo $r['avatar'];?>') center;"> 
						<div class="image"></div>
						<div class="overbar">
							<div class="title"><a href="./?p=profile&u=<?php echo $r['username']; ?>"><?php echo $r['username']?></a></div>
							<div class="stats">
								<span></span>
								<span><a href="#"><?php echo $r['tutorials']?> урока</a></span>
							</div>
						</div>
					</div>
					<?php
				    }
					?>

				</div>


			</div>

			<div id="right-col">
				

				<div id="last-tutorials">
					<div class="text-title"></div>

					
					<?php
						 $sql_last = "SELECT * FROM `tutorials` WHERE `show`='true' ORDER BY `timestamp` DESC LIMIT 4";
						 // tuka NE sa 270x180 - просто подавам сойностите по подразбиране за да  не ми са налага да пиша аз др .. 
						 tutorials($sql_last, 270, 180, "views-author");
					?>


					
				</div>


			</div>
			<div class="clear"></div>