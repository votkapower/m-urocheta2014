<?php
mysql_query("DELETE FROM `tutorials` WHERE `id`='$id'");

if(mysql_error())
{
 echo  mysql_error();
}
else
	{
		 report("* Админ <b>".$_SESSION['user']['username']."</b> изтри клип: $id !");
		header("Location: ./?p=tutorials");
		exit;
	}
