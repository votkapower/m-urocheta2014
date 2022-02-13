<?php
if($_SESSION['is-logged'] == true)
{
 report("<b style='color:darkred;'>Някой се опитва те хакне чрез ЗАБРАВЕНА парола ! </b>");
 header("Location: ./");
 exit;
}

?>
<div id="left-col">
<h2>Забравена парола</h2>
		 <form method='post' action="">
		 Имейл: <br/>
		 <input name="email"  value=""/> <br/><br/>
		 <button name="get-my-pw-by-email">Прати ми паролата</button><br/>
		
		</form>
		<?php
		if(isset($_POST['get-my-pw-by-email']))
		{
		  $email = trim(htmlspecialchars($_POST['email']));
		  $check = mysql_query("SELECT * FROM `users` WHERE  `email`='".$email."'");
		  if(mysql_num_rows($check) == 1)
		  {
		    
			$newPassword = randomid(6);
		  
		    $r = mysql_fetch_array($check);
			$subject = "Забравена парола / ".$SITE_TITLE;
			$message = "
			Здравей, ".$r['username']."
			
			Ти поиска да ти пратим паролата, но тъй като паролите в сайта се криптират(за да няма пробиви) и ние незнаeм каква ти е паролата. Затова ти сменихме паролата на: ".$newPassword."
			
			Сега може да се логнеш с тази парола и да си я смениш :)
			
			Поздрави,
			Екипа на M-Urocheta.
			
			";
			$me = $SITE_EMAIL; // емаил на сайта
			$header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n From: ".$me;
			mail($r['email'], '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_.$header);
			
			mysql_query("UPDATE `users` SET `password`='".md5($newPassword)."' WHERE `email`='".$r['email']."'");
			report("Пратихме нова парола на ".$r['username']." (някой я поиска от \"забравена парола\") IP: ".$_SERVER['REMOTE_ADDR']." в ".date("d.m.Y - H:iч."));
			ok("Готово! До няколко минути ще ти пратим инструкции на този имейл какво да правиш :)");
		  }
		  else
			 {
			  error("Упсс .. нямаме потребител с този имейл :( ");
			 }
		}
		?>
		<br/><br/>
		<br/><br/>
</div>
<div id="right-col">
		   Други: <br/><br/>
		   
			<div style='background:#fcfcfc;padding:10px;'><span style='color:#666;'>Още нямаш профил ?!</span> <br /> <a href="./?p=register">Регистрирай се :)</a></div>
			
			<br />
			
			<div style='background:#fcfcfc;padding:10px;'><a href="./?p=lostpw">Забравена парола</a></div>
			 
		
</div>
			<div class="clear"></div>