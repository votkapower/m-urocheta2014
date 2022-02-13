<?php
mysql_query("UPDATE `tutorials-comments` SET `new`='false'");

if(mysql_error())
{
 echo  mysql_error();
}
else
	{
		header("Location: ./?p=comments");
		exit;
	}
