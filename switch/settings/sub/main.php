<?php
$me = $_SESSION['user'];
?>
	<form method='post' action="">
	 
		 Емейл: <br/>
		 <input name="email"  value="<?php echo $me['email'];?>" maxlength="120"/> <br/><br/>
		 
		 Сайт: <br/>
		 <input name="site"  value="<?php echo $me['website'];?>" maxlength="120"/> <br/><br/>
		 
		 Години: <br/>
		 <input name="years"  value="<?php echo $me['years'];?>" maxlength="120"/> <br/><br/>
		 
		  Пол: <br/>
		 <select name="sex">
			<option value="1" <?php if( $me['sex'] == '1'){echo "selected";}?> >Момче</option>
			<option value="2" <?php if( $me['sex'] == '2'){echo "selected";}?>>Момиче</option>
		 </select><br/><br/>

		 
		 За мен: <br/>
		 <textarea name="desc" style='width:600px;height:340px;'><?php echo $me['desc'];?></textarea><br/><br/>
		 
		 
		 <button name="do-change">Промени</button>
		 <br />
		 <?php
		 if(isset($_POST['do-change']))
		 {
		  $email = trim(htmlspecialchars($_POST['email']));
		  $web = trim(htmlspecialchars($_POST['site']));
		  $years = trim(htmlspecialchars($_POST['years']));
		  $sex = trim(htmlspecialchars($_POST['sex']));
		  $desc = trim(htmlspecialchars($_POST['desc']));
		  
		  if( strlen($email) < 10)
		  {
		   error("Имейла тряба да е валиден, в случай, че си забравиш паролата.");
		  }
		  if( strlen($desc) > 1500)
		  {
		   error("Описанието ти е много дълго бе човекк ...");
		  }
		  else
			 {
				 mysql_query("UPDATE `users` SET `email`='$email', `website`='$web', `years`='$years', `sex`='$sex', `desc`='$desc' WHERE `username`='".$me['username']."'");
				 ok("Готово! Промените ще влязат в сила от следващия път, когато си влезеш в профила :)");
			 }
		 }
		 ?>
		</form>