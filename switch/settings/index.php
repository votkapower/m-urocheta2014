<?php
if($_SESSION['is-logged'] != true)
{
 header("Location: ./");
 exit;
}

?>
<h2>Настройки</h2>

	<div align='center' Style='padding:10px;background:#FFF;'>
		<b><a href="./?p=settings&w=main">Общи настройки</a></b> | <a href="./?p=settings&w=pass">Смени паролата </a> | <a href="./?p=settings&w=avatar">Смени аватара </a>
	</div>
	
	<?php
	 $w = trim(htmlspecialchars($_GET['w']));
	 
	 switch($w)
	 {
	  case "main":
	   include "sub/main.php";
	  break;
	  
	  case "avatar":
	   include "sub/avatar.php";
	  break;
	  
	  case "pass":
	   include "sub/pass.php";
	  break;

	 }
	?>