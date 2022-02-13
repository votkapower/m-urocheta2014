<h2>Екип</h2>
<?php
$textColor = "#206FB5";
 $z = mysql_query("SELECT * FROM `users` WHERE `rank`='admin'");
 while($r = mysql_fetch_assoc($z))
 {
 $desc = nl2br($r['desc']);
?>
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
		 

		<div style='margin-bottom:10px;color:<?php echo $textColor;?>'><?php echo $r['username'];?></div>

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
<?php
}
?>

