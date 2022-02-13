<?php

$me = $_SESSION['user']['username'];
$my_tuts_are_waiting_approve = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials` WHERE  `show`='false'"));

$new_comments = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials-comments` WHERE  `new`='true'"));
$tutorials = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials`"));
$tutorials_app = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials` WHERE `show`='false'"));
$catsnum = mysql_num_rows(mysql_query("SELECT `id` FROM `cats`"));

?>


	<div align='center' style='padding:10px;background:#FFF;'>
		 <a href="./">Начало</a> | 
		 <a href="./?p=add-page">Нова страница</a> | 
		 <a href="./?p=menu">Меню</a> | 
		 <a href="./?p=comments">Нови коментари (<?php echo $new_comments; ?>)</a> | 
		 <a href="./?p=users">Потребители</a> | <a href="./?p=tutorials">Уроци ( <?=$tutorials_app;?> / <?=$tutorials;?> )</a> |
		 <a href="./?p=cats">Категории (<?=$catsnum ;?>)</a>  |
		 <a href="../">КЪМ САЙТА >>></a>  
	
	</div>

	 
 <br />