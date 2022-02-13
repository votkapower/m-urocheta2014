<?php
mysql_query("UPDATE `tutorials` SET `show`='true' WHERE `id`='$id'");



if(mysql_error())
{
 echo  mysql_error();
}
else
	{  
	
	  report("* Админ <b>".$_SESSION['user']['username']."</b> уробри <a href='../?p=view&id=".$id."'>клип</a> !");
		header("Location: ./?p=tutorials");
		exit;
	}
