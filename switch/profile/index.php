<?php
$me = $_SESSION['user']['username'];
$GET_USER = trim(htmlspecialchars($_GET['u']));


$hhe = mysql_query("SELECT * FROM `users` WHERE `username`='$GET_USER'");
$is_valid_user = mysql_num_rows($hhe);
if($is_valid_user != 1)
{
  header("Location: ./?p=error&r=no-user");
  exit;
}


$r = mysql_fetch_array($hhe);

/*

Array
(
    [id] => 4
    [username] => voTkaPoweR
    [password] => 2aa97be009237d9c121ad5b58ef71877
    [email] => dimiter0@abv.bg
    [sex] => 1
    [years] => 0
    [desc] => 
    [website] => 
    [avatar] => http://www.demonpigeon.com/wp-content/uploads/2010/05/IronManAvatar.jpg
    [timestamp] => 1381683432
    [tutorials] => 0
    [rank] => admin
)

*/
$polText="Момче";
$textColor = "#206FB5";
if($r['sex'] == '2'){$polText="Момиче"; $textColor = "#B220A8"; }
$desc = nl2br($r['desc']);
?>

<div style="font-size:16px;">Профила на <span style='color:<?php echo $textColor;?>'><?php echo $r['username'];?></span></div>

<div style=" margin:10px;float:left;">
	<img style="display:block;background:#FFF;padding:5px;border:1px solid #CCC;" src="<?php echo $r['avatar'];?>" width='200' border='0' alt='Снимката на <?php echo $r['username'];?>'/>
	<?php
	 if($_SESSION['is-logged'] == true)
	 {
	?>
	<div>
	 Опции:
		<div style='padding:4px;'><a href="./?p=pm&to=<?php echo $r['username'];?>">+ Изпрати ЛС</a></div>
	</div>
	<?php
	}
	?>
</div>
<div style='float:left;margin-top:10px;width:620px;bordeR:0px solid #ccc'>
 
 <div style='margin-bottom:10px;'>
	Пол: <span style='color:<?php echo $textColor;?>'><?php echo $polText;?></span>, на <?php echo $r['years'];?>г.
 </div>
 
 <div style='margin-bottom:10px;'>
	Сайт: <?php if($r['website']){ echo "<a href='".$r['website']."'>".$r['website']."</a>";}else{ echo " няма даден ..";}?>
 </div>
 
 <div style='margin-bottom:10px;'>
	Имейл: <b><?php if($r['email']){ echo  $r['email'];}else{ echo " няма даден ..";}?></b>
 </div>
 
 <div style='margin-bottom:10px;'>
	Уроци: <b><?php echo $r['tutorials'];?></b>
 </div>

  
 <div>За мен:
	<div style='margin:10px;'><?php if(strlen($desc) > 5){echo $desc;}else{ echo " няма информация ..";}?></div>
 </div>
  

</div>

<div class='clear'></div>

 <div><b>Последни уроци:</b>
	<div style='margin-top:10px;'>
	<?php
		$sql = "SELECT * FROM `tutorials` WHERE `author`='$GET_USER'";
		$count = mysql_num_rows(mysql_query($sql));
		if($count >= 1)
		{
		    $sql.= " ORDER BY `timestamp` DESC LIMIT 3";
			tutorials($sql);
		}
		else
		   {
		    error("Нямам добавени уроци :(");
		   }
	?>
	 <div class='clear'></div>
	</div>
	
 </div>
 
 <div class='clear'></div>