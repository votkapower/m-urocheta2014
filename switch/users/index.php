<h2>Потребители</h2>	
<?php
 $allu = mysql_query("SELECT * FROM `users` ORDER BY `timestamp` DESC");
 while($r = mysql_fetch_array($allu))
 {
?>

		<div class="tutorial" style="width:180px;background: url('<?php echo $r['avatar']; ?>') center;">
			<div class="image"></div>
			<div class="overbar" style="width:180px;">
				<div class="title" style="width:170px;"><a href="./?p=profile&u=<?php echo $r['username']; ?>"><?php echo $r['username']; ?></a></div>
				<div class="stats" style="width:170px;">
					<span>0 урока</span>
				</div>
			</div>
		</div>
<?php
}
?>

<div class="clear"></div>