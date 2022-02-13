<?php
 if($_SESSION['is-logged'] == true)
 {
  $me = $_SESSION['user']['username'];
  $sq = "SELECT `id` FROM `user-pms` WHERE `to-user`='$me' ";
  $allpm = mysql_num_rows(mysql_query($sq));
  $sq.= " AND `readed`='false' ";
  $newpm = mysql_num_rows(mysql_query($sq));
?>
Здр, <a href="./?p=profile&u=<?php echo $_SESSION['user']['username'];?>"><b><?php echo $_SESSION['user']['username'];?></b></a> | <a href="./?p=options&w=pms&s=new">ЛС ( <?=$newpm;?> / <?=$allpm;?>  )</a> | <a href="./?p=options">Опции</a> | <a href="./logout.php"><img src='./img/icons/blocked.png' width='10' border='0' alt="Изход" title="Изход"></a>
<?php
}
else 
	{
?>
	<a href="./?p=login">Вход</a> /
	<a href="./?p=register">Регистрация</a>
	
<?php
	}
?>