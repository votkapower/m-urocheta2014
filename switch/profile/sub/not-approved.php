 <br /><br /> Това са твоите уроци, които все още трябва да се удобрят ! <br /><br />
<?php
$me = $_SESSION['user']['username'];
$my_tuts = mysql_query("SELECT * FROM `tutorials` WHERE `author`='$me' AND `show`='false' ORDER BY `timestamp` DESC");
while($r = mysql_fetch_array($my_tuts))
{
 $i++;
 if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
 if($r['show']=='true'){ $status = "<span style='color:green;font-size:10px;'>удобрен</span>";}else{ $status = "<span style='color:darkred;font-size:10px;'>чака уробрение</span>";}
?>
 <div style='padding:10px;background: <?php echo $bg;?>;'>
	<?=$i;?>. <a href="./?p=view&id=<?php echo $r['id'];?>"><?php echo substr($r['title'],0, 300);?></a> <?php echo $status; ?>
		
 </div>
<?php
}
?>