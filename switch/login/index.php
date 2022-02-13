<?php
if($_SESSION['is-logged'] == true)
{
 report("<b style='color:darkred;'>Някой се опитва да те хакне от страницата за логин !</b> ");
 header("Location: ./");
 exit;
}

?>
<div id="left-col">
<h2>Вход</h2>
		<form method='post' action="">
		 Потребител: <br/>
		 <input name="username" value=""/> <br/><br/>
		 Парола: <br/>
		 <input name="password" type='password' value=""/> <br/><br/>
		 <button name="log-me-in">Вход</button>
		</form>
		<?php
		if(isset($_POST['log-me-in']))
		{
		  $username = trim(htmlspecialchars($_POST['username']));
		  $password = trim(htmlspecialchars($_POST['password']));
		  $check = mysql_query("SELECT * FROM `users` WHERE `username`='$username' AND `password`='".md5($password)."'");
		  if(mysql_num_rows($check) == 1)
		  {
		    $r = mysql_fetch_array($check);
			$_SESSION['is-logged']=true;
			$_SESSION['user']=$r;
			header("Location: ./");
			exit;
		  }
		  else
			 {
			
			  report("Някой се опитва да си влезе в профила (<b>$username</b> - грешен потребител/парола). ");
			  error("Грешен потребител / парола.");
			 }
		}
		?>
</div>
<div id="right-col">
		   Други: <br/><br/>
		   
			<div style='background:#fcfcfc;padding:10px;'><span style='color:#666;'>Още нямаш профил ?!</span> <br /> <a href="./?p=register">Регистрирай се :)</a></div>
			
			<br />
			
			<div style='background:#fcfcfc;padding:10px;'><a href="./?p=lostpw">Забравена парола</a></div>
			 
		
</div>
			<div class="clear"></div>