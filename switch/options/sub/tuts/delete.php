<?php
$q = mysql_query("SELECT * FROM `tutorials` WHERE `id`='$i' AND `author`='$me'");
$z = mysql_fetch_array($q);
$n = mysql_num_rows($q);

	if($n == 1)
	{
		report($author." си изтри урока -> <b>\"".$z['title']."\"</b> ;( ");
		mysql_query("DELETE FROM `tutorials`  WHERE `id`='".$z['id']."' AND `author`='$me'") or die(mysql_error());
		 ok("Готово ! Урока е редактиран успешно  :) ");
		 header("location: ./?p=options&w=my-tuts");
		 exit;
	}	
	else
	   {
	    error("Възникна грешка - съобщете на администратора !");
	   }
