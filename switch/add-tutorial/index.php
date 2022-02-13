<?php
if($_SESSION['is-logged'] != true)
{
 report("Някой се опита да влезе в страницата за добавяне на уроци БЕЗ да е логнат! ");
 header("Location: ./");
 exit;
}

?>
<h2>Добавяне на урок</h2>

		 <form method='post' action="">
		  Заглавие на урока: <br/>
		 <input name="title"  value=""/> <br/><br/>
		 
		  Допълнителна информация: <span Style='font-size:10px;margin-left:100px;'>(до 500 символа)</span><br/>
		 <textarea name="desc" style='width:500px;height:200px;' ></textarea> <br/><br/>
	
		
		 
		  Линк до клипа: <span Style='font-size:10px;margin-left:100px;'>(от vBox7 или Youtube)</span><br/>
		 <input name="video" value="" /> <br/><br/>
		 
		 
		  Картинка на урока: <span Style='font-size:10px;margin-left:160px;'>(линк)</span><br/>
		 <input name="video-image" value="" /> <br/><br/>
			
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
		 <input name="video-files" value="" /> <br/><br/>
		 
		 
		 
		 
		 
		 <button name="post-my-new-tutorial">Добави урока</button><br/>
		
		</form>
		<?php
		if(isset($_POST['post-my-new-tutorial']))
		{
		  $title = trim(htmlspecialchars($_POST['title']));
		  $desc = trim(htmlspecialchars($_POST['desc']));
		  $video = trim(htmlspecialchars($_POST['video']));
		  $image = trim(htmlspecialchars($_POST['video-image']));
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
									
								
			 mysql_query("UPDATE `users` SET `tutorials` = `tutorials` + 1 WHERE `username`='$author'");
			 mysql_query("INSERT INTO `tutorials` (`title`,`desc`,`video-url`,`video-type`,`image`,`cat_id`,`author`,`timestamp`,`show`,`files`)
	  VALUES('$title','$desc','$video', '$type', '$image', '$cat', '$author', '$time', 'false', '$files')");
					 report($author." добави нов урок -> <b>\"".$title."\"</b> ");
					    ok("Готово ! Урока е добавен успешно и очаква уробрение :) ");
					  }
		 
		    
			
		}
		?>
		<br/><br/>
		<br/><br/>
		
			<div class="clear"></div>