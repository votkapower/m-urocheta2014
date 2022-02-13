<?php
mysql_query("DELETE FROM `users` WHERE `id`='$id'");

if(mysql_error())
{
 echo  mysql_error();
}
else
	{
		 
		report("* Админ <b>".$_SESSION['user']['username']."</b> изтри потребител <b>$id</b> !");
		header("Location: ./?p=users");
		exit;
	}
