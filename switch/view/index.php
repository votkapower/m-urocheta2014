<?php
$VIDEO_ID = trim(htmlspecialchars($_GET['id']));
if(is_tutorial($VIDEO_ID) == false)
{
 report("!!! Някой се опитва да отвори НЕ съществуващ урок/клип с ИД: ".$VIDEO_ID.". Ако смяташ, че това е грешка, а не опит за хак, просто го подмини. ");
 header("Location: ./?p=error&r=no-video");
 exit;
}

$q = mysql_query("SELECT * FROM `tutorials` WHERE `id`='$VIDEO_ID'");
$row = mysql_fetch_array($q);

$displayMsg = "";
if($row['show'] == 'false')
{
	if($_SESSION['user']['username'] == $row['author'] OR $_SESSION['user']['rank'] == "admin")
	{
	 $displayMsg = "Внимание! Тъй като виедото още не е удобрено - САМО ТИ го виждаш. Видеото ще бъде видимо за всички след като бъде удобрено :)";
	}
	else
		{
			header("Location: ./");
			exit;
		}
}

$doVote = trim(htmlspecialchars($_GET['vote'])); // true
$way = trim(htmlspecialchars($_GET['way']));
$get_ip = trim($_GET['ip']);
if($doVote == "true" AND ($way == 'up' or $way == 'down') AND $_SERVER['REMOTE_ADDR'] == $get_ip AND $_SESSION['is-logged'] == true)
{
    
	report("Потребител <b>".$_SESSION['user']['username']."</b> гласува за клип: '<a href=\"../?p=view&id=".$VIDEO_ID."\">".$row['title']."</a>' !  ");

	handle_video_voting($VIDEO_ID, $_SERVER['REMOTE_ADDR'], $way, 1); // гласуване на -> 1 ден
	
		
	$msg = mysql_real_escape_string("
	Здравей,
	
	  <b>".$_SESSION['user']['username']."</b>, току що ти изгледа и хареса урока <a href='./?p=view&id=".$VIDEO_ID."'>".substr($row['title'],0, 55)."..</a> :)
	  
	 * това е системно съобщение - моля, не отговаряйте.
	 
	 Поздрави,
	  от Екипа на сайта.
	");
	sendpm("Ново харесване твоя урок: \"".substr($row['title'],0, 50)."..\"", "system" ,$row['author'], $msg);
	
	
	header("Location: ./?p=view&id=".$VIDEO_ID);
	exit;
}




 // Качи гледанията на видеото със 1
mysql_query("UPDATE `tutorials` SET `views`=`views`+1 WHERE `id`='$VIDEO_ID'"); 


$code = "";
if($row['video-type'] == "youtube")
{
	$video_url = yourubeURLtoEmbedLink($row['video-url']);
	$code = '<iframe width="860" height="500" src="'.$video_url.'" frameborder="0" allowfullscreen></iframe>';
}
	else if( $row['video-type'] == 'vbox')
	{
		 $video_url = getVboxId($row['video-url']);
		 $code ='<iframe width="860" height="500" src="http://vbox7.com/emb/external.php?vid='.$video_url.'" frameborder="0" allowfullscreen></iframe>';
	 
	}
	else 
		{
		   $video_url = $row['video-url'];
		   $code ='<embed width="860" height="500" src="./player.swf" allowfullscreen="true" flashvars="file='.$video_url.'&autostart=false&image='.$row['image'].'"></iframe>';
		}
// ако клипа на потребителя НЕ е уробрен и тва е неговия клип .. просто му покажи че трябва да изчака за удобрение :)
if(strlen($displayMsg) > 3){ error($displayMsg); }
?>
<div style="font-size:18px;color:#276AAD;font-family:Arial;padding:5px;"><?php echo $row['title'];?></div>
<div style='margin-bottom:10px;font-size:11px;'>
 Урока е добавен от <a href="./?p=profile&=<?php echo $row['author'];?>"><?php echo $row['author'];?></a>, <?php echo  maketime($row['timestamp']);?>. 
 
  <span style="float:right;">Урока има <b><?php echo $row['views'];?></b> гледания и <b style='color:green;'><?php echo $row['votes'];?></b> харесвания </span>
</div>
<div style="height:500px;border:1px solid #ccc;box-shadow:0 0px 3px #000;">
	<?php echo $code; ?>
</div>

	
		<div style='margin:5px;'>
			<?php
			 if(canIvote($_SERVER['REMOTE_ADDR'],$VIDEO_ID) == true)
			 {
			?>
					Гласувай за урока ако ти е хаерсал: <a href="./?p=view&id=<?php echo $VIDEO_ID;?>&vote=true&ip=<?php echo $_SERVER['REMOTE_ADDR'];?>&way=up">Харесва ми</a> 
			<?php
			 }
			 else
				{
				 echo " Благодаря за гласа ! Ще може да гласуваш пак след 24 часа :)";
				}
			?>
		</div>
	


<?php 
// ако има описание .. покажи гО
if( strlen($row['desc']) > 5)
{ 
 $dd = str_replace("&lt;br /&gt;","",$row['desc']);
?>
	<div style='margin:10px;'>
		<b style='maring:7px;font-size:15px;'> Инфо:</b> <br />
		<div style='margin-left:10px;'><?php echo nl2br($dd) ;?></div>
	</div>

<?php 
}


// ако има файлове .. покажи ги
if( strlen($row['files']) > 5)
{
?>
	<div style='margin:10px;'>
		<b style='maring:7px;font-size:15px;'> Файловете:</b> <br />
		<div style='margin-left:10px;'><a href="<?php echo $row['files'];?>"><?php echo $row['files'];?></a></div>
	</div>
<?php 
}

if($_SESSION['is-logged'] == true)
{
?>

		<div style='margin:10px;'>
		 <b>Имаш мнение ? Изкажи го :</b>
		</div>
		<form method='post' action="">
			<textarea name='my-comment' style='width:840px;height:100px;margin-bottom:10px;' maxlength='500'><?php if( strlen($_POST['my-comment']) > 20){ echo $_POST['my-comment'];}?></textarea>
				<button type='submit' name='send-my-comment'>Изпрати коментара</button>
			<br />
		<?php
		 if(isset($_POST['send-my-comment']))
		 {
			$comment = trim(htmlspecialchars($_POST['my-comment']));
			
			if(strlen($comment) < 10)
			{
				error("Това не е мнение, това е спам!");
			}
			else if(strlen($comment) > 500)
			{
				error("Това не е мнение, това е РОМАН! Моля, намали си малко дължината на коментара !");
			}
			else 
			   {
				  $username = $_SESSION['user']['username'];
				  $time = time();
				  
				   report("Потребител <b>".$_SESSION['user']['username']."</b> коментира за клип: '<a href=\"../?p=view&id=".$VIDEO_ID."\">".$row['title']."</a>' !");
				   
				  mysql_query("INSERT INTO `tutorials-comments` (`username`,`comment`,`timestamp`,`video_id`)VALUES('$username', '$comment', '$time','$VIDEO_ID')");
				 
				  
				  	$msg = mysql_real_escape_string("
						Здравей,
						
						  <a  href='./?p=profile&u=".$_SESSION['user']['username']."'>".$_SESSION['user']['username']."</a>, току що ти изгледа и <a href='./?p=view&id=".$VIDEO_ID."'>коментира урока</a>. Цъкни <a href='./?p=view&id=".$VIDEO_ID."'>тук</a> за да видиш коментара :)
						  
						 * това е системно съобщение - моля, не отговаряйте.
						 
						 Поздрави,
						  от Екипа на сайта.
						");
						sendpm("Нов коментар на урок ".substr($row['title'],0, 50)."..", "system" ,$row['author'], $msg);
				  
				  ok("Коментара ти е добавен успешно :)");
			   }
		 }
		?>
		</form>

<?php
}
?>