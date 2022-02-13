<?php
$q = mysql_query("SELECT * FROM `tutorials` WHERE `id`='$i' AND `author`='$me'");
$z = mysql_fetch_array($q);


$desc =  $z['desc'];
$desc = str_replace("&lt;br /&gt;","",$desc);
?>

		 <form method='post' action="">
		  Заглавие на урока: <br/>
		 <input name="title"  value="<?php echo $z['title'];?>"/> <br/><br/>
		 
		  Допълнителна информация: <span Style='font-size:10px;margin-left:100px;'>(до 500 символа)</span><br/>
		 <textarea name="desc" style='width:500px;height:200px;' ><?php echo $desc;?></textarea> <br/><br/>
	
		
		 
		  Линк до клипа: <span Style='font-size:10px;margin-left:100px;'>(от vBox7 или Youtube)</span><br/>
		 <input name="video" value="<?php echo $z['video-url'];?>" /> <br/><br/>
		 
		 <!----
		  Картинка на урока: <span Style='font-size:10px;margin-left:160px;'>(линк, ако няма остави го празно)</span><br/>
		 <input name="video-image" value="<?php echo $z['image'];?>" /> <br/><br/>
			--->
		 Категория на урока: <br/>
		 <select name='cat_id'>
			<?php
			 $rc = mysql_query("SELECT * FROM `cats` ORDER BY `name` ASC");
			 while($r = mysql_fetch_array($rc))
			 {
			  echo "<option value='".$r['id']."'>".$r['name']."</option>";
			 }
			?>
		 </select><br/><br/>
		 
		  Файловете от урока: <span Style='font-size:10px;margin-left:50px;'>(ако няма го остави празно)</span><br/>
		 <input name="video-files" value="<?php echo $z['files'];?>" /> <br/><br/>
		 
		 
		 
		 
		 
		 <button name="post-my-new-tutorial">Редактирай урока</button><br/>
		
		</form>
		<?php
		if(isset($_POST['post-my-new-tutorial']))
		{
		  $title = trim(htmlspecialchars($_POST['title']));
		  $desc = trim(htmlspecialchars($_POST['desc']));
		  $video = trim(htmlspecialchars($_POST['video']));
		  //$image = trim(htmlspecialchars($_POST['video-image']));
		  $cat = trim(htmlspecialchars($_POST['cat_id']));
		  $files = trim(htmlspecialchars($_POST['video-files']));
		  $author = $_SESSION['user']['username'];
		  $time = time();
		 
		  if(strlen($title) < 3 AND strlen($title) > 100)
		  {
		   error("Заглаеието трябва да е между 3 и 100 символа !");
		  }
		  else if( strlen($desc) > 500)
			  {
			   error("Описанието Не трябва да превишава 500 символа, изтрий ".(strlen($desc) - 500)." !");
			  }
			  else if( strlen($video) < 30)
				  {
				   error("Въведи линк до клипа от vbox / youtube!");
				  }
				   else
				      {
							 if(preg_match("/vbox7.com/",$video))
							 {
							   $type = "vbox";
							   $image =  v_url($video,"image");
							 }
							 else if( preg_match("/youtube.com/",$video))
								{
									 $type = "youtube";
									 $image = yt_image($video);
								}
								 else
									{
										 $type = "direct";
										 $image = "";
									}
									
								
					mysql_query("UPDATE `tutorials` SET `title`='$title',`desc`='$desc',`video-url`='$video',`video-type`= '$type',`image`='$image',`cat_id`='$cat',`show`='false',`files`='$files' WHERE `id`='".$z['id']."' AND `author`='$me'") or die(mysql_error());
					 report($author." си редактира урока -> <b>\"".$title."\"</b> ");
					    ok("Готово ! Урока е редактиран успешно  :) ");
					  }
		 
		    
			
		}
		?>
		<br/><br/>
		<br/><br/>