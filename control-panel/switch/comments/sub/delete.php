<?php
mysql_query("DELETE FROM `tutorials-comments` WHERE `id`='$id'");

if(mysql_error())
{
 echo  mysql_error();
}
else
	{
		report("* Админ <b>".$_SESSION['user']['username']."</b> изтри коментар: $id  !");
		header("Location: ./?p=comments");
		exit;
	}
