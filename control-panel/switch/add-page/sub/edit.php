<?php
 $html = stripcslashes(file_get_contents("../switch/".$f."/index.php"));
 $html = str_replace("<br />","\n",$html);
?>
	
<form method='post' action="">
 URL: <b><?php echo $f; ?></b><br /><br />
 Съдържание: <br />
 <textarea name='html' style='width:750px; height:300px;'><?php echo ($html);?></textarea><br /><br />
 <button name='change-page' type='submit'>Промени</button>
</form>
<br />
		
		<?php
		 If(isset($_POST['change-page']))
		 {
	
			   $html = trim($_POST['html']);
			   $url = "../switch/".$f;
			   if( file_exists($url."/index.php"))
			   {
				 $kl = @fopen($url."/index.php","w+");
				 @fwrite($kl, htmlspecialchars_decode(stripcslashes($html)));
				 fclose($kl);
				 
				 report("Админ <b>".$_SESSION['user']['username']."</b> направи промени по страницата - <a href='../?p=".$f."'>".$f."</a> ! ");
				 ok("Страницата успешно променена !");
			   }
		 }
		?>
		
		
<br/>

 <a href="./?p=add-page"><div style='text-align:center; background:#fafafa;padding:10px;'>Добави нова</div></a>