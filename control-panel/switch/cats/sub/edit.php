<?php
 $q = mysql_query("SELECT * FROM `cats` WHERE `id`='$id'");
 $r = mysql_fetch_array($q);
?>
	<form method='post' action="">
		 Име на категорията: <br/>
		 <input name="name" value="<?php echo $r['name']; ?>" maxlength="170"/> <br/><br/>
		 
		
		 <button name="change-user">направи промените</button>
		</form>
		
		<?php
		 If(isset($_POST['change-user']))
		 {
		  $name = trim(htmlspecialchars($_POST['name']));
		
		  
		  if( empty($name) )
		  {
		   error("Ако ще я променяш - напиши нещо !");
		  }
		  else
			 {
			  report("* Админ <b>".$_SESSION['user']['username']."</b> редактира категория: $id на $name !");
			  mysql_query("UPDATE `cats` SET `name`='$name' WHERE `id`='$id'");
			  ok ("Промените са направени успешно :)");
			 }
		 }
		?>