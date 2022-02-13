<?php
mysql_query("DELETE FROM `cats` WHERE `id`='$id'");

if(mysql_error())
{
 echo  mysql_error();
}
else
	{	
		report("* Админ <b>".$_SESSION['user']['username']."</b> изтри категория: $id  !");
		header("Location: ./?p=cats");
		exit;
	}
