 <?php
  $a = trim(htmlspecialchars($_GET['a']));
  if($a == "read")
  {
    $i = trim(htmlspecialchars($_GET['i']));
	include "sub/read.php";
	exit;
  }
  
  if($a == "delete")
  {
    $i = trim(htmlspecialchars($_GET['i']));
	include "sub/delete.php";
	exit;
  }
 ?>
 
 <br /><br /> Това са твоите получени лични съобщения ! <br /><br />
<?php
$me = $_SESSION['user']['username'];
$my_tuts = mysql_query("SELECT * FROM `user-pms` WHERE `to-user`='$me'  ORDER BY `timestamp` DESC");
if(mysql_num_rows($my_tuts) == 0)
{
 error("Няма нови съобщения ...");
}

while($r = mysql_fetch_array($my_tuts))
{
 $i++;
 if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
  if($r['readed']=='false'){ $status = "- <span style='color:#AD2B29;text-shadow:1px -1px 0px #FFF, 1px 1px 0px #666;font-size:8px;'>НОВО !</span>";}else{ $status = "";}
?>
 <div style='padding:10px;background: <?php echo $bg;?>;'>
	<?=$i;?>. <a href="./?p=options&w=pms&a=read&i=<?php echo $r['id'];?>"><?php echo substr($r['tema'],0, 100);?></a> ,  <b><?php echo maketime($r['timestamp']); ?></b>   <?php echo $status; ?>
		<span style='float:right;'><a href="./?p=options&w=pms&a=read&i=<?php echo $r['id'];?>">Прочети</a>  / <a href="./?p=options&w=pms&a=delete&i=<?php echo $r['id'];?>">Изтрий</a></span> 
 </div>
<?php
}
?>