<?php
if($_SESSION['is-logged'] != true)
{
 header("Location: ./");
 exit;
}

$me = $_SESSION['user']['username'];
$my_tuts = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials` WHERE `author`='$me'"));
$my_tuts_are_waiting_approve = mysql_num_rows(mysql_query("SELECT `id` FROM `tutorials` WHERE `author`='$me' AND `show`='false'"));

?>
<h2>Опции</h2>

	<div align='center' style='padding:10px;background:#FFF;'>
	<?php
	 if($_SESSION['user']['rank'] == 'admin')
	 {
	?>
		<b><a href="./control-panel/" style='color:darkred;'>АДМИН ПАНЕЛ</a></b> |
    <?php
	}
	?>
		<b><a href="./?p=add-tutorial" style='color:green;'>Добави урок</a></b> |
		<a href="./?p=options&w=my-tuts">Moите уроци (<?php echo $my_tuts; ?>)</a> |
		<!-- <a href="./?p=options&w=not-approved">Уроци чакащи уробрение (<?php echo $my_tuts_are_waiting_approve; ?>)</a> | -->
		<a href="./?p=options&w=pms">Лични съобщения</a> | 
		<a href="./?p=settings">Настройки</a>
	</div>
	
	<?php
	 $w = trim(htmlspecialchars($_GET['w']));
	 
	 switch($w)
	 {
	  case "my-tuts":
	   include "sub/my-tuts.php";
	  break;
	  
	  case "not-approved":
	   include "sub/not-approved.php";
	  break;
	  
	  case "pms":
	   include "sub/pms.php";
	  break;

	 }
	?>