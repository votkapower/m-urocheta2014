<?php
 $q = mysql_query("SELECT * FROM `tutorials` WHERE `id`='$id'");
 $r = mysql_fetch_array($q);
?>
	 <form method='post' action="">
		  Заглавие на урока: <br/>
		 <input name="title"  value="<?php echo nl2br($r['title']); ?>"/> <br/><br/>
		 
		  Допълнителна информация: <span Style='font-size:10px;margin-left:100px;'>(до 500 символа)</span><br/>
		 <textarea name="desc" style='width:500px;height:200px;' ><?php echo nl2br($r['desc']); ?></textarea> <br/><br/>
	
		
		 
		  Линк до клипа: <span Style='font-size:10px;margin-left:100px;'>(от vBox7 или Youtube)</span><br/>
		 <input name="video" value="<?php echo nl2br($r['video-url']); ?>" /> <br/><br/>
		 
		 
		  Картинка на урока: <span Style='font-size:10px;margin-left:160px;'>(линк)</span><br/>
		 <input name="video-image" value="<?php echo nl2br($r['image']); ?>" /> <br/><br/>
			
		 Категория на урока: <br/>
		 <select name='cat_id'>
			<?php
			 $rc = mysql_query("SELECT * FROM `cats` ORDER BY `name` ASC");
			 while($rа = mysql_fetch_array($rc))
			 {
			  if( $r['cat_id'] == $ra['id']) { $sel = " selected ";}else{ $sel = "";}
			  echo "<option value='".$rа['id']."' ".$sel." >".$rа['name']."</option>";
			 }
			?>
		 </select>
		 <br/><br/>
		 
		  Файловете от урока: <span Style='font-size:10px;margin-left:50px;'>(ако няма го остави празно)</span><br/>
		 <input name="video-files" value="<?php echo $r['files']; ?>" /> <br/><br/>
		 
	
		 
		 
		Удобрен: <br/>
		 <select name='show'>
				<option value="true" <?php if($r['show']=='true'){ echo "selected";}?>>ДА</option>
				<option value="false" <?php if($r['show']=='false'){ echo "selected";}?>>НЕ</option>
		 </select>
		 
		  <br/><br/>
		  
		  
		 <button name="change-tutorial">Промени урока</button><br/>
		
		</form>
		
		<?php
		 If(isset($_POST['change-tutorial']))
		 {
		  $title = trim(htmlspecialchars($_POST['title']));
		  $desc = trim(htmlspecialchars($_POST['desc']));
		  $video = trim(htmlspecialchars($_POST['video']));
		  $image = trim(htmlspecialchars($_POST['video-image']));
		  $cat = trim(htmlspecialchars($_POST['cat_id']));
		  $files = trim(htmlspecialchars($_POST['video-files']));
		  $show = trim(htmlspecialchars($_POST['show']));
		  $author = $r['author'];
		  $time = time();
		  
		  if( empty($title) OR empty($video) OR empty($image))
		  {
		   error("Следните полета: заглавие, линк до видеото и снимка - трябва да са въведени !");
		  }
		  else
			 {
			  report("* Админ <b>".$_SESSION['user']['username']."</b> редактира урок <a href='../?p=view&id=".$id."'>клип</a> !");
			  mysql_query("UPDATE `tutorials` SET `title`='$title', `desc`='$desc', `video-url`='$video', `image`='$image', `cat_id`='$cat', `files`='$files', `show`='$show' WHERE `id`='$id'");
			  ok ("Промените са направени успешно :)");
			 }
		 }
		?>