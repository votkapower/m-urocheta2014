<?php
$me = $_SESSION['user'];
?>
	<form method='post' action="">
	 
		 Нова парола: <br/>
		 <input name="pass" type='password'  /> <br/><br/>
		 
		 Повтори паролата: <br/>
		<input name="pass1" type='password'  /> <br/><br/>

		 
		 <button name="pwdo-change">Промени</button>
		 <br />
		 <?php
		 if(isset($_POST['pwdo-change']))
		 {
		  $pass = trim(htmlspecialchars($_POST['pass']));
		  $pass1 = trim(htmlspecialchars($_POST['pass1']));

		  
		  if( strlen($pass) < 3)
		  {
		   error("Паролата трябва да е по-голяма от 3 символа.");
		  }
		  else if( $pass != $pass1)
			  {
			   error("Двете пароли Не съвпадат, а трябва !");
			  }
			  else
				 {
					 mysql_query("UPDATE `users` SET `password`='$pass' WHERE `username`='".$me['username']."'");
					 ok("Готово! Промените ще влязат в сила от следващия път, когато си влезеш в профила :)");
				 }
		 }
		 ?>
		</form>