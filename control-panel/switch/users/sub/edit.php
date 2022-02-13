<?php
 $q = mysql_query("SELECT * FROM `users` WHERE `id`='$id'");
 $r = mysql_fetch_array($q);
?>
	<form method='post' action="">
		 Потребител: <br/>
		 <input name="username" value="<?php echo $r['username']; ?>" maxlength="70"/> <br/><br/>
		 
		 Парола: <br/>
		 <input name="password" type='password' value=""/> <br/><br/>
		 

		 Емейл: <br/>
		 <input name="email"  value="<?php echo $r['email']; ?>" maxlength="120"/> <br/><br/>
		 


		 Ранк: <br/>
		 <select name="rank" >
			<option value="user" <?php if($r['rank'] =='user'){ echo "selecnte";} ?>>потребител</option>
			<option value="admin" <?php if($r['rank'] =='admin'){ echo "selecnte";} ?>>АДМИН</option>
		 </select> <br/><br/>


		 Инфо: <br/>
		 <textarea name="desc" ><?php echo nl2br($r['desc']); ?></textarea> <br/><br/>

		 Сайт: <br/>
		 <input name="website"  value="<?php echo $r['website']; ?>" maxlength="120"/> <br/><br/>
		 

		 <button name="change-user">направи промените</button>
		</form>
		
		<?php
		 If(isset($_POST['change-user']))
		 {
		  $username = trim(htmlspecialchars($_POST['username']));
		  $password = trim(htmlspecialchars($_POST['password']));
		  $email = trim(htmlspecialchars($_POST['email']));
		  $rank = trim(htmlspecialchars($_POST['rank']));
		  $desc = trim(htmlspecialchars($_POST['desc']));
		  $web = trim(htmlspecialchars($_POST['website']));
		  
		  if( empty($username) OR empty($email))
		  {
		   error("Трябва поне ПОТРЕБИТЕЛСКОТО име и ИМЕЙЛА да са въведени !");
		  }
		  else
			 {
			   $extra= "";
			  if(!empty($passowrd)){ $extra = " `password`='$password', ";};
			  report("* Админ <b>".$_SESSION['user']['username']."</b> редактира потребител <b>$username</b> !");
			  mysql_query("UPDATE `users` SET `username`='$username', ".$extra." `email`='$email', `rank`='$rank', `desc`='$desc', `website`='$web' WHERE `id`='$id'");
			  ok ("Промените са направени успешно :)");
			 }
		 }
		?>