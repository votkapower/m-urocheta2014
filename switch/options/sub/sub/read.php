 <br /><br /> Четене на съобщение :  <br /><br />
<?php
$me = $_SESSION['user']['username'];
$my_ms = mysql_query("SELECT * FROM `user-pms` WHERE `to-user`='$me' AND `id`='$i'");
$r = mysql_fetch_array($my_ms);

mysql_query("UPDATE `user-pms` SET `readed`='true' WHERE `to-user`='$me' AND `id`='$i' ");

  if($r['readed']=='false'){ $status = "- <span style='color:#AD2B29;text-shadow:1px -1px 0px #FFF, 1px 1px 0px #666;font-size:10px;'>НОВО !</span>";}else{ $status = "";}
  
  $msg = nl2br(htmlspecialchars_decode($r['msg']));
  $msg  = str_replace('\"',"", $msg);
?>
 <div style='padding:10px;'>
  От: <a href="./?p=profile&u=<?php echo $r['from-user'];?>"><?php echo $r['from-user'];?></a>, изпратено <b><?php echo maketime($r['timestamp']);?></b> ( на <?php echo date("d.m.Y в H:iч.",$r['timestamp']);?>) <br /> <br />
  Тема: <?php echo $r['tema'];?></a> <?php echo $status; ?> <br/><br/> 
  Съобщение:
   <div style='margin:10px;padding:5px;border-bottom:1px solid #ccc;'>
	 <?php echo  $msg;?>
   </div>
	<div style='text-align:right;'>	
		<a href="./?p=pm&to=<?php echo $r['from-user'];?>">Отговори</a> /
		<a href="./?p=options&w=pms&a=delete&i=<?php echo $r['id'];?>">Изтрий</a>
	</div>
 </div>
