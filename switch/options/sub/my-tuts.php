<?php
$me = $_SESSION['user']['username'];
$ac = trim(htmlspecialchars($_GET['ac']));
 if($ac == "edit")
 {
   $i = (int)$_GET['i'];
   $check = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials` WHERE `author`='$me' AND `id`='$i'"));
   if($check == 1)
   {
      include "tuts/edit.php";
	  exit;
   }
   else
      {
	   header("location: ./?p=option&w=my-tuts");
	   exit;
	  }
 }
?>
 <br /><br /> Това са твоите уроци, удобрени и не удобрени ! <br /><br />
 <?php

$my_tuts = mysql_query("SELECT * FROM `tutorials` WHERE `author`='$me' ORDER BY `timestamp` DESC");
while($r = mysql_fetch_array($my_tuts))
{
 $i++;
 if($i%2==0){$bg = "#FFF";}else{$bg="transparent";}
  if($r['show']=='true'){ $status = "<span style='color:green;font-size:10px;'>удобрен</span>";}else{ $status = "<span style='color:darkred;font-size:10px;'>чака уробрение</span>";}
?>
 <div style='padding:10px;background: <?php echo $bg;?>;'>
	<?=$i;?>. <a href="./?p=view&id=<?php echo $r['id'];?>"><?php echo substr($r['title'],0, 300);?></a> <?php echo $status; ?>
		<span style='float:right;'><a href="./?p=options&w=my-tuts&ac=edit&i=<?php echo $r['id'];?>">Редактирай</a>  / <a href="./?p=options&w=my-tuts&ac=edit&i=<?php echo $r['id'];?>">Изтрий</a></span> 
 </div>
<?php
}
?>